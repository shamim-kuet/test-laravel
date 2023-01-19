<?php
namespace App\Helpers;

class Helper
{
    public static function storagePath($filename)
    {
		$imagepath = asset('uploads/product/thumnail/jpg/'.$filename);
        echo $imagepath;
    }

	public static function isMobileDevice() {
		return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
		$_SERVER["HTTP_USER_AGENT"]);
	}


    public static function sendSms($phoneno, $messageBody)
	{
		// $params = [
		// 	"apikey" => "d23583bbd5258301",
		// 	"secretkey" => 'f9844d4f',
		// 	"content" => [
        //         "callerID" => '8801922002381',
        //         "toUser" => $phoneno, ///////////////////// User Phone Number
        //         "messageContent" => $messageBody
        //     ]
		// ];
		// $url = 'http://103.53.84.5:1222/sendtext';
		// $params = json_encode($params);

		// return Self::smsApi($url, $params);

        $url ="http://103.53.84.5:1222/sendtext?apikey=d23583bbd5258301&secretkey=f9844d4f&callerID=8801922002381&toUser=88".$phoneno."&messageContent=".$messageBody;
        return Self::smsApi($url);
	}

    public static function smsApi($url)
	{

        //return $url;
		$ch = curl_init(); // Initialize cURL
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		// 	'Content-Type: application/json',
		// 	'Content-Length: ' . strlen($params),
		// 	'accept:application/json'
		// ));

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response,true);
	}
}
