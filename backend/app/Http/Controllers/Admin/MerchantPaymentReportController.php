<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\MerchantPaymentReportService;
use App\Services\OrderService;
use App\Services\CommonService;
use Session;

class MerchantPaymentReportController extends BaseController
{

    private $merchantPaymentReportService, $orderService;

    use FlashMessages;

    public function __construct(MerchantPaymentReportService $merchantPaymentReportService, OrderService $orderService,  CommonService $commonService)
    {
        $this->merchantPaymentReportService = $merchantPaymentReportService;
        $this->orderService = $orderService;
        $this->commonService = $commonService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("paymentrequest.index")) {
                try {
                    $result = $this->merchantPaymentReportService->index();
                    $merchants = $this->commonService->getCommonData('merchant');
                    // dd($result);
                    if ($result['status'] == true) {
                        $getResponse = $result['data'];

                        return view('admin.pages.merchant_payment_report.invoice-list', [
                            'prefixname' => 'Admin',
                        ],compact('result','getResponse','merchants'));
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

    public function filter(Request $request, Curl $curl)
    {
        try {
            $data = $request->all();
            $result = $this->merchantPaymentReportService->filter($data);
            $merchants = $this->commonService->getCommonData('merchant');
            
            if ($result['status'] == true) {
                return view('admin.pages.merchant_payment_report.invoice-list', [
                    'prefixname' => 'Admin',
                    'merchants' => $merchants,
                    'getResponse' => $result['data'],
                ]);
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }

    public function detailsFilter(Request $request, Curl $curl)
    {
        try {
            $data = $request->all();
            $result = $this->merchantPaymentReportService->detailsFilter($data);
            $merchants = $this->commonService->getCommonData('merchant');
            $hubs = $this->commonService->getCommonData('hub');

            // dd($result);

            if ($result['status'] == true) {
                return view('admin.pages.merchant_payment_report.invoice-details', [
                    'prefixname' => 'Admin',
                    'hubs' => $hubs,
                    'merchants' => $merchants,
                    'getResponse' => $result['data'],
                ]);
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }

    public function details($id,Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("paymentrequest.index")) {
                try {
                    $result = $this->merchantPaymentReportService->details($id);
                    $merchants = $this->commonService->getCommonData('merchant');
                    $hubs = $this->commonService->getCommonData('hub');
                    // dd($result);
                    if ($result['status'] == true) {
                        $getResponse = $result['data'];

                        return view('admin.pages.merchant_payment_report.invoice-details', [
                            'prefixname' => 'Admin',
                        ],compact('result','getResponse','merchants','hubs'));
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
    public function allDetails(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("paymentrequest.index")) {
                try {
                    $result = $this->merchantPaymentReportService->alldetails();
                    $merchants = $this->commonService->getCommonData('merchant');
                    $hubs = $this->commonService->getCommonData('hub');
                    // dd($result);
                    if ($result['status'] == true) {
                        $getResponse = $result['data'];

                        return view('admin.pages.merchant_payment_report.invoice-details', [
                            'prefixname' => 'Admin',
                        ],compact('result','getResponse','merchants','hubs'));
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




}
