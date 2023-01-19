<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\PaymentReuestService;
use App\Services\OrderService;
use App\Services\CommonService;
use Session;

class PaymentReuestController extends BaseController
{

    private $paymentrequestService, $orderService;

    use FlashMessages;

    public function __construct(PaymentReuestService $paymentrequestService, OrderService $orderService,  CommonService $commonService)
    {
        $this->paymentrequestService = $paymentrequestService;
        $this->orderService = $orderService;
        $this->commonService = $commonService;
    }


    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("paymentrequest.index")) {
                try {
                    $result = $this->paymentrequestService->index();
                    // dd($result);
                    if ($result['status'] == true) {
                        $result=$result['data'];

                        return view('admin.pages.payment_request.index', [
                            'prefixname' => 'Admin',
                        ],compact('result'));
                    } else {
                        self::message('error', 'Data not found');
                        return view('admin.pages.notfound');
                    }
                } catch (\Exception $exception) {
                    \Helper::handleException($exception);

                    self::message('error', 'Failed, Please try again');
                    return view('admin.pages.notfound');
                }
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

    // public function index()
    // {
        // if ((session()->get('role_id') == 34) || \Utility::checkPermission("paymentrequest.index")) {
        //     try {

                // return view('admin.pages.payment_request.index', compact('merchants', 'stores'));

        //     } catch (\Exception $exception) {
        //         \Helper::handleException($exception);

        //         self::message('error', 'Something wrong. Please check api, authentication or restart system');
        //         return redirect()->back();
        //     }
        // }else {
        //     return redirect('/');
        // }
    // }

    public function create()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("delivery.create")) {
            try {
                $merchants = $this->commonService->getCommonData('merchant');


                return view('admin.pages.payment_request.create', compact('merchants'));

            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            // dd($data);
            $result = $this->paymentrequestService->create($data);
            //dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect()->route('paymentrequest.index');
            } else {
                self::message('error', $result['message']);
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }
    public function show($id)
    {
        try {
            $data = $request->all();
            $result = $this->paymentrequestService->create($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('paymentrequest/index');
            } else {
                self::message('error', $result['message']);
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }


    }
    public function destroy($id, Curl $curl)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("paymentrequest.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'paymentrequest', $id, '', 'delete');
                if ($getResponse) {
                    self::message('success', 'Data Deleted successfully Done');
                    return redirect()->route('user.index');
                }
                self::message('error', 'Data failed on update');
                return redirect()->back();
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Failed, Please try again');
                return redirect()->back();
            }
        } else {
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }
}
