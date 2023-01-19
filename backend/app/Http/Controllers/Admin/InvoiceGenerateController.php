<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\InvoiceGenerateService;
use App\Services\OrderService;
use App\Services\CommonService;
use Session;

class InvoiceGenerateController extends BaseController
{
    use FlashMessages;

    private $invoicegenerateService;
    private $orderService;

    public function __construct(InvoiceGenerateService $invoicegenerateService, OrderService $orderService, CommonService $commonService)
    {
        $this->invoicegenerateService = $invoicegenerateService;
        $this->orderService = $orderService;
        $this->commonService = $commonService;
    }

    public function index()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("delivery.create")) {
            try {
                $riders = $this->commonService->getCommonData('rider');
                $result = $this->invoicegenerateService->index();
                $merchants = $this->commonService->getCommonData('merchant');
                // dd($result);

                if (isset($result['status']) && $result['status'] == true) {
                    $getResponse = $result['data'];
                    return view('admin.pages.invoice_generate.index', compact('riders', 'getResponse', 'merchants'));
                } else {
                    self::message('error', 'Something wrong. Please check api, authentication or restart system');
                    return redirect()->back();
                }
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }

    public function filter(Request $request, Curl $curl)
    {
        try {
            $data = $request->all();

            $riders = $this->commonService->getCommonData('rider');
            $result = $this->invoicegenerateService->filter($data);
            $merchants = $this->commonService->getCommonData('merchant');
            // dd($result);

            if (isset($result['status']) && $result['status'] == true) {
                return view('admin.pages.invoice_generate.index', [
                    'riders' => $riders,
                    'getResponse' => $result['data'],
                    'merchants' => $merchants,
                ]);
            } else {
                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function listFilter(Request $request, Curl $curl)
    {
        try {
            $data = $request->all();

            $riders = $this->commonService->getCommonData('rider');
            $result = $this->invoicegenerateService->listFilter($data);
            $merchants = $this->commonService->getCommonData('merchant');
            // dd($result);

            if (isset($result['status']) && $result['status'] == true) {
                return view('admin.pages.invoice_generate.invoice-list', [
                    'riders' => $riders,
                    'getResponse' => $result['data'],
                    'merchants' => $merchants,
                ]);
            } else {
                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function generatedInvoice()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("delivery.create")) {
            try {
                $riders = $this->commonService->getCommonData('rider');
                $result = $this->invoicegenerateService->generatedInvoice();
                $merchants = $this->commonService->getCommonData('merchant');

                if (isset($result['status']) && $result['status'] == true) {
                    $getResponse = $result['data'];
                    return view('admin.pages.invoice_generate.invoice-list', compact('riders', 'getResponse', 'merchants'));
                } else {
                    self::message('error', 'Something wrong. Please check api, authentication or restart system');
                    return redirect()->back();
                }
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }
    public function print($id)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("invoicegenerate.print")) {
            try {
                $result = $this->invoicegenerateService->printInvoice($id);
                // dd($result);

                if (isset($result['status']) && $result['status'] == true) {
                    $data = $result['data'];
                    return view('admin.pages.invoice_generate.invoice-print', compact('data'));
                } else {
                    self::message('error', 'Something wrong. Please check api, authentication or restart system');
                    return redirect()->back();
                }
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }


    public function edit($id)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("invoicegenerate.print")) {
            try {
                $result = $this->invoicegenerateService->editInvoice($id);
                // dd($result);

                if (isset($result['status']) && $result['status'] == true) {
                    $getResponse  = $result['data'];
                    // dd($getResponse);
                    return view('admin.pages.invoice_generate.invoice-edit', compact('getResponse'));
                } else {
                    self::message('error', 'Something wrong. Please check api, authentication or restart system');
                    return redirect()->back();
                }
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } else {
            return redirect('/');
        }
    }



    public function saveInvoice(Request $request)
    {
        // dd($request->all());
        try {
            $data = $request->all();
            // dd($data);
            $result = $this->invoicegenerateService->save($data);
            // dd($result);
            self::message('success', $result->message);
            return redirect()->back();
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $result = $this->invoicegenerateService->create($data);
            // dd($result);
            return $result;
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }
}
