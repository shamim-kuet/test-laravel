<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Config\Curl;
use App\View\Components\FlashMessages;
use App\Services\WeightDetailsService;
use Session;

class WeightDetailsController extends BaseController
{

    private $planService;

    use FlashMessages;

    public function __construct(WeightDetailsService $weightDetails)
    {
        $this->weightDetails = $weightDetails;
    }

    public function index(Curl $curl)
    {
        if (Session::get('token') != null) {
            if ((session()->get('role_id') == 34) || \Utility::checkPermission("weight_details.index")) {
                try {
                    $result = $this->weightDetails->index();
                    // dd($result);
                    if ($result['status'] == true) {
                        return view('admin.pages.weightdetails.index', [
                            'prefixname' => 'Admin',
                            'getResponse' => $result['data'],
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
            $result = $this->weightDetails->filter($data);

            return view('admin.pages.weightdetails.index', [
                'prefixname' => 'Admin',
                'title' => 'User Edit',
                'page_title' => 'User Edit',
                'getResponse' => $result['data'],
            ]);
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }

    public function create()
    {
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("weight_details.create")) {
            return view('admin.pages.weightdetails.create', [
                'prefixname' => 'Partner',
                'title' => 'Partner Create',
                'page_title' => 'Partner Create'
            ]);
        } else {
            return redirect('/');
        }
    }


    public function store(Request $request)
    {

        try {
            $data = $request->all();
            $result = $this->weightDetails->create($data);
            // dd($result);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('weight_details');
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
        if ((session()->get('role_id') == 34) || \Utility::checkPermission("weight_details.edit")) {
            try {
                $result = $this->weightDetails->edit($id);
                return view('admin.pages.weightdetails.edit', [
                    'prefixname' => 'Admin',
                    'title' => 'User Edit',
                    'page_title' => 'User Edit',
                    'weight_details' => $result['data'],
                ]);
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


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();

            $result = $this->weightDetails->update($data, $id);
            //dd($data);
            if ($result['status'] == true) {
                self::message('success', $result['message']);
                return redirect('weight_details');
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
