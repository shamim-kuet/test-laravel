<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\OrderService;
use App\Services\DeliveryStatusService;
use App\Services\CommonService;
use Session;

class OrderController extends BaseController
{

    private $orderService;

    use FlashMessages;

    public function __construct(OrderService $orderService, CommonService $commonService , DeliveryStatusService $deliverystatusService)
    {
        $this->orderService = $orderService;
        $this->commonService = $commonService;
        $this->deliverystatusService = $deliverystatusService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("order.index")) {
                try {
                    $result = $this->orderService->index();
                    $codcharge = $this->commonService->getCommonData('cod');
                    $status = $this->deliverystatusService->index();
                    $merchants = $this->commonService->getCommonData('merchant');

                    // dd($result);
                    if ($result['status'] == true) {
                        return view('admin.pages.order.index', [
                            'prefixname' => 'Admin',
                            'getResponse' => $result['data'],
                            'merchants'=> $merchants,
                            'status'=> $status['data'],
                            'codcharge' => $codcharge,
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

            $result = $this->orderService->filter($data);
            $codcharge = $this->commonService->getCommonData('cod');
            $status = $this->deliverystatusService->index();
            $merchants = $this->commonService->getCommonData('merchant');


            return view('admin.pages.order.index', [
                'prefixname' => 'Admin',
                'title' => 'User Edit',
                'page_title' => 'User Edit',
                'getResponse' => $result['data'],
                'merchants'=> $merchants,
                'status'=> $status['data'],
                'codcharge' => $codcharge,
            ]);
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }

    public function create()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("order.create")) {
            try {
                $merchants = $this->commonService->getCommonData('merchant');
                /// Get Rider Data
                $stores = $this->commonService->getCommonData('store');
                $products = $this->commonService->getCommonData('product');
                $deliveryPlan = $this->commonService->getCommonData('delivery-plan');
                $returnPlan = $this->commonService->getCommonData('return-plan');
                $district = $this->commonService->getCommonData('district');
                $upozila = $this->commonService->getCommonData('upozila');
               // dd($upozila);

                return view('admin.pages.order.create', compact('merchants', 'stores', 'products','deliveryPlan','returnPlan','district','upozila'));
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
            $result = $this->orderService->create($data);
           // dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('order');
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


    public function edit($id)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("order.edit")) {

            try {
                $merchants = $this->commonService->getCommonData('merchant');
                /// Get Rider Data
                $stores = $this->commonService->getCommonData('store');
                $products = $this->commonService->getCommonData('product');
                $deliveryPlan = $this->commonService->getCommonData('delivery-plan');
                $returnPlan = $this->commonService->getCommonData('return-plan');

                $result = $this->orderService->edit($id);
                $order = $result['data'];
                $district = $this->commonService->getCommonData('district');
                $upozila = $this->commonService->getCommonData('upozila');
                // dd($order);
                return view('admin.pages.order.edit', compact('merchants', 'stores', 'order', 'products','deliveryPlan','returnPlan','district','upozila'));
            } catch (\Exception $exception) {
                \Helper::handleException($exception);

                self::message('error', 'Something wrong. Please check api, authentication or restart system');
                return redirect()->back();
            }
        } else {
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {

        try {
            $data = $request->all();

            $result = $this->orderService->update($data, $id);

            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('order');
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



    public function show($id, Curl $curl)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("order.show")) {
            $getResponse = $curl->send('GET', 'order', $id, '', 'display');
            //dd($getResponse);
            return view('admin.pages.order.details', [
                'prefixname' => 'Admin',
                'title' => 'User Create',
                'page_title' => 'User Create',
                'user' => $getResponse->data,
            ]);
        } else {
            self::message('error', 'Failed, you dont have permission');
            return redirect()->back();
        }
    }
    public function destroy($id, Curl $curl)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("order.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'order', $id, '', 'delete');
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
