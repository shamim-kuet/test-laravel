<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\MerchantPaymentService;
use App\Services\OrderService;
use App\Services\CommonService;
use Session;

class MerchantPaymentController extends BaseController
{

    private $merchantpaymentService, $orderService;

    use FlashMessages;

    public function __construct(MerchantPaymentService $merchantpaymentService, OrderService $orderService,  CommonService $commonService)
    {
        $this->merchantpaymentService = $merchantpaymentService;
        $this->orderService = $orderService;
        $this->commonService = $commonService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("paymentrequest.index")) {
                try {
                    $result = $this->merchantpaymentService->index();
                    // dd($result);
                    if ($result['status'] == true) {
                        $result=$result['data'];

                        return view('admin.pages.merchant_payment.index', [
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


    public function create()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("delivery.create")) {
            try {
                $merchants = $this->commonService->getCommonData('merchant');


                return view('admin.pages.merchant_payment.create', compact('merchants'));

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
            $result = $this->merchantpaymentService->create($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect()->route('merchantpayment.index');
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
}
