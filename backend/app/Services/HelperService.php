<?php

namespace App\Services;

use App\Facades\HttpClient\HttpCallable;
use Carbon\Carbon;
use Exception;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

/**
 *
 */
class HelperService
{
    /**
     * @return bool
     */
    public static function isProduction(): bool
    {
        return in_array(env('APP_ENV'), ['production', 'local']);
    }

    /**
     * @param \Exception $e
     * @param null $msg
     * @param false $isLog
     * @return mixed|string
     */
    public static function exceptionLine(\Exception $e, $msg = null, $isLog = false)
    {
        if ($isLog) {
            return 'Line: ' . $e->getLine() . ' File: ' . $e->getFile() . ' => ' . $e->getMessage();
        }

        if (!self::isProduction()) {
            return $e->getMessage();
        }

        return $msg ?? 'Unknown exception';
    }

    /**
     * @return Repository|Application|mixed
     */
    public static function apiBaseUrl()
    {
        return config('app.api_base_url');
    }

    /**
     * @param $response
     * @return mixed
     */
    public static function parseApiResponse($response)
    {
        $res = json_decode($response->contents, true);
        if (isset($res['status_code'])) {
            if ($res['status_code'] == 401) {
                self::redirect_now('/logout');
            }
        }
        return $res;
    }

    /**
     * Redirect the user no matter what. No need to use a return
     * statement. Also avoids the trap put in place by the Blade Compiler.
     *
     * @param string $url
     * @param int $code http code for the redirect (should be 302 or 301)
     */
    public static function redirect_now($url, $code = 302)
    {
        try {
            \App::abort($code, '', ['Location' => $url]);
        } catch (\Exception $exception) {
            // the blade compiler catches exceptions and rethrows them
            // as ErrorExceptions :(
            //
            // also the __toString() magic method cannot throw exceptions
            // in that case also we need to manually call the exception
            // handler
            $previousErrorHandler = set_exception_handler(function () {
            });
            restore_error_handler();
            call_user_func($previousErrorHandler, $exception);
            die;
        }
    }

    /**
     * @param $image_path
     * @param string|null $base_url
     * @return string
     */
    public static function imageUrl($image_path, string $base_url = HttpCallable::BASEURL): string
    {

        $base_url = explode('/', $base_url);
		
        array_pop($base_url);
        array_pop($base_url);
        $base_url = implode('/', $base_url);
        if (is_null($image_path))
            return $base_url . '/assets/img/default.png';
        else {
            //remote path
            if (preg_match("/(http|https|ftp|ftps)\:\/\//", $image_path) > 0) {
                return $image_path;
            } //file path
            else {
                return $base_url . $image_path;
            }
        }
    }

    /**
     * @return string
     */
    public function requestFromData(): string
    {
        return 'Alesha Lms Front End';
    }

    /**
     * @param $date
     * @return string
     * @throws \Exception
     */
    public function convertDateTimeToDate($date): string
    {
        $createDate = Carbon::parse($date);
        return $createDate->format('Y-m-d');
    }

    /**
     *
     */
    public function clearSession()
    {

    }

    public static function stringShorten(string $text, int $length = 20, $dots = 'true')
    {
        $text = strip_tags(html_entity_decode($text));
        if ($dots == 'true') {
            return (strlen($text) > $length) ? substr($text, 0, $length) . ' ...' : $text;
        } else {
            return (strlen($text) > $length) ? substr($text, 0, $length) : $text;
        }
    }

    /**
     * @param Carbon $start
     * @param Carbon $end
     * @return string|null
     */
    public static function getTimeRangeHuman(Carbon $start, Carbon $end): ?string
    {
        $duration = $end->diff($start)->format('%d-%h-%i');
        $durationArray = explode("-", $duration);
        $range = "";
        if ($durationArray[0] > 0)
            $range .= $durationArray[0] . ' day(s) ';
        if ($durationArray[1] > 0)
            $range .= $durationArray[1] . ' hour(s) ';
        if ($durationArray[2] > 0)
            $range .= $durationArray[2] . ' minute(s) ';

        return $range;
    }

    /**
     * @param $exception
     * @return void
     * @throws Exception
     */
    public static function handleException($exception)
    {
        \Log::error($exception->getMessage());

        //TODO ADD REDIRECT TO PREVIOUS URL
    }

    /**
     * @param $number
     * @return string
     */
    public static function formatStaticsNumbers($number): string
    {
        $numberLimiter = self::numberSplitter($number);

        $HTML = '<h3><span class="counter">';

        $HTML .= $numberLimiter[0];
        $HTML .= '</span>';
        $HTML .= $numberLimiter[1] . '+';
        $HTML .= '</h3>';

        return $HTML;
    }

    /**
     * @param $number
     * @return array
     */
    protected static function numberSplitter($number): array
    {
        //greater then 1000
        if ($number > 1000 && $number <= 1000000)
            return [round(($number / 1000), 2), 'K'];

        else if ($number > 1000000 && $number <= 1000000000)
            return [round(($number / 1000000), 2), 'M'];
        else
            return [$number, ''];
    }


    public static function getPercentage($input, $max)
    {
        if ($max == 0)
            return 0;
        else {
            $result = ($input / $max) * 100;
            return $result;
        }
    }


    /**
     * @param $regularPrice
     * @param $discountPrice
     * @return float
     */
    public static function getDiscountRate($regularPrice, $discountPrice): float
    {
        $discountRate = self::getPercentage($discountPrice, $regularPrice);
        return 100 - $discountRate;
    }
}
