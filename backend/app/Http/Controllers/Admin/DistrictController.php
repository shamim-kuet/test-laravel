<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use Session;

class DistrictController extends BaseController
{

    private $codchargeService;

    use FlashMessages;

    public $curl;


	public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }


    public function index(Curl $curl)
    {

        if (Session::get('token') != null) {

            try {
                $response = $this->curl->send('GET','districts','', '','display');
                // dd($response);
                if ($response->success == true) {
                    return view('admin.pages.district.index', [
                        'prefixname' => 'Admin',
                        'getResponse' => $response->data,
                    ]);
                } else {
                    self::message('error', 'Data not found');
                    return view('admin.pages.notfound');
                }
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Failed, Please try again');
                return view('admin.pages.notfound');
            }
        }
    }
}
