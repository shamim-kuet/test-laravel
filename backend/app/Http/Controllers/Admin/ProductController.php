<?php

namespace App\Http\Controllers\Admin;

use Helper;
use Utility;
use App\Config\Curl;
use Illuminate\Http\Request;
use App\Services\CommonService;
use App\Services\ProductService;
use App\View\Components\FlashMessages;
use App\Http\Controllers\BaseController;
use Session;

class ProductController extends BaseController
{

    private $productService;

    
    private $commonService;

    use FlashMessages;

    public function __construct(ProductService $productService, CommonService $commonService)
    {
        $this->productService = $productService;
        $this->commonService = $commonService;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || Utility::checkPermission("product.index")) {
                try {
                    $merchants = $this->commonService->getCommonData('merchant');
                    $result = $this->productService->index();
                    if ($result['status'] == true) {
                        return view('admin.pages.product.index', [
                            'prefixname' => 'Admin',
                            'getResponse' => $result['data'],
                            'merchants' => $merchants,
                        ]);
                    } else {
                        self::message('error', 'Data not found');
                        return view('admin.pages.notfound');
                    }
                } catch (\Exception $exception) {
                    Helper::handleException($exception);

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

            $result = $this->productService->filter($data);
            $merchants = $this->commonService->getCommonData('merchant');

            // dd($result);
            return view('admin.pages.product.index', [
                'prefixname' => 'Admin',
                'title' => 'User Edit',
                'page_title' => 'User Edit',
                'getResponse' => $result['data'],
                'merchants' => $merchants,
            ]);
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }

    public function create()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("product.create")) {
            try {
                $merchants = $this->commonService->getCommonData('merchant');
                /// Get Rider Data
                $stores = $this->commonService->getCommonData('store');
                return view('admin.pages.product.create', compact('merchants', 'stores'));
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
            //dd($data);
            $result = $this->productService->create($data);
        //    dd($result);
            if ($result->success == true) {
                self::message('success', $result->message);
                return redirect('product');
            } else {
                self::message('message', $result->success);
                // //dd($result->error);
                // foreach ($result->error as $error){
                //     dd($error);
                // }
                return redirect()->back()->with('errors', $result->error);
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("product.edit")) {

            try {
                $merchants = $this->commonService->getCommonData('merchant');
                /// Get Rider Data
                $stores = $this->commonService->getCommonData('store');
                $result = $this->productService->edit($id);
                $product = $result['data'];

                return view('admin.pages.product.edit', compact('merchants', 'stores', 'product'));
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

            $result = $this->productService->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('product');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("product.show")) {
            $getResponse = $curl->send('GET', 'product', $id, '', 'display');
            return view('admin.pages.product.details', [
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("product.destroy")) {
            try {
                $getResponse = $curl->send('DELETE', 'product', $id, '', 'delete');
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
