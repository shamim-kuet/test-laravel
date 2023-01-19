<?php

namespace App\Http\Controllers\Admin;

use Utility;
use Validator;
use App\Config\Curl;
use App\Models\Admin;
use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\DeliveryStatus;
use App\Services\CommonService;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\View\Components\FlashMessages;
use App\Services\DeliveryStatusService;

class CommonController extends Controller
{
    use FlashMessages;

    private $commonService;
    private $deliverystatusService;

    public function __construct(CommonService $commonService, DeliveryStatusService $deliverystatusService)
    {
        $this->commonService = $commonService;
        $this->deliverystatusService = $deliverystatusService;
    }

    public function destroy(Request $request, Curl $curl)
    {
        $type = $request->deletetype;
        $data = $request->all();


        if ($type == 'single') {
            $getResponse = $curl->send('GET', 'common/delete', '', json_encode($data), 'delete');
            return $getResponse;
        }
    }


    public function changePassword(Request $request, Curl $curl)
    {
        //$table_name = $request->table_name;
        //$table_id  = $request->table_id;
        $data = $request->all();
        // dd($data);

        $getResponse = $curl->send('POST', 'common/changepassword', '', json_encode($data), 'delete');
        //dd($getResponse->message);

        if ($getResponse->success) {
            self::message('success', $getResponse->message);
            return redirect()->back();
        } else {
            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function prints(Request $request, Curl $curl)
    {
        $api = $request->api;
        $action = $request->action;
        if ($request->has('method') && !empty($request->has('method'))) {
            $method = $request->method;
            $requestData = $request->requestdata;
            $filterType = 'filter';
        } else {
            $method = 'GET';
            $requestData = '';
            $filterType = 'display';
        }

        $getResponse = $curl->send($method, $api, '', $requestData, $filterType);

        if ($api == 'admin') {
            $pagename = 'admin_print';
        } elseif ($api == 'partner') {
            $pagename = 'partner_print';
        } elseif ($api == 'merchant') {
            $pagename = 'merchant_print';
        } elseif ($api == 'product-filter') {
            $pagename = 'product_print';
        } elseif ($api == 'order-filter') {
            $pagename = 'order_print';
        } elseif ($api == 'pickup') {
            $pagename = 'pickup_print';
        } elseif ($api == 'delivery') {
            $pagename = 'delivery_print';
        } elseif ($api == 'delivery/deliveryCashRecivedList') {
            $pagename = 'cashRecivedList_print';
        } elseif ($api == 'reshedule-delivery') {
            $pagename = 'reshedule-delivery_print';
        } elseif ($api == 'role') {
            $pagename = 'role_print';
        } elseif ($api == 'permission') {
            $pagename = 'permission_print';
        } elseif ($api == 'plan') {
            $pagename = 'plan_print';
        } elseif ($api == 'rider') {
            $pagename = 'rider_print';
        } elseif ($api == 'store') {
            $pagename = 'store_print';
        } elseif ($api == 'hub') {
            $pagename = 'hub_print';
        } elseif ($api == 'banner') {
            $pagename = 'banner_print';
        } elseif ($api == 'complaint') {
            $pagename = 'complaint_print';
        } elseif ($api == 'document') {
            $pagename = 'document_print';
        } elseif ($api == 'documenttype') {
            $pagename = 'documenttype_print';
        } elseif ($api == 'deliverystatus') {
            $pagename = 'deliverystatus_print';
        } elseif ($api == 'paymentstatus') {
            $pagename = 'paymentstatus_print';
        } elseif ($api == 'employeeid') {
            $pagename = 'employeeid_print';
        } elseif ($api == 'deliverynote') {
            $pagename = 'deliverynote_print';
        } elseif ($api == 'codcharge') {
            $pagename = 'codcharge_print';
        } elseif ($api == 'generalsetting') {
            $pagename = 'generalsetting_print';
        } elseif ($api == 'group') {
            $pagename = 'group_print';
        } elseif ($api == 'merchantpaymentreport-filter') {
            $pagename = 'merchantpayment_report_print';
        } elseif ($api == 'merchantpaymentreportdetails-filter') {
            $pagename = 'merchantpayment_report_all_details_print';
        } elseif ($api == 'riderReport-filter') {
            $pagename = 'rider_report_print';
        } elseif ($api == 'riderDeliveryReport-filter') {
            $pagename = 'rider_delivery_report_print';
        } elseif ($api == 'riderPickUpReport-filter') {
            $pagename = 'rider_pickup_report_print';
        } elseif ($api == 'invoicegenerate-filter') {
            $pagename = 'invoice_generate_print';
        } elseif ($api == 'invoicegeneratelist-filter') {
            $pagename = 'invoicegenerate_list_print';
        } elseif ($api == 'hubDeliveryReport-filter') {
            $pagename = 'hub_delivery_report_print';
        } elseif ($api == 'merchantpayment') {
            $pagename = 'merchantpayment_print';
        } elseif ($api == 'paymentrequest') {
            $pagename = 'paymentrequest_print';
        }

        // dd($getResponse);
        if ($getResponse->success) {
            return view('admin.common.' . $pagename, compact('getResponse', 'action', 'api'));
        } else {
            return view('admin.pages.notfound');
        }
    }


    public function commonDownload(Request $req)
    {
        $getPath = base64_decode($req->path);
        $getFile = base64_decode($req->filename);

        $filePath = public_path($getPath.'/'. $getFile);
        $headers = ['Content-Type: application/octet-stream'];
        return response()->download($filePath, $getFile, $headers);
    }


    public function sampleFileDownload(Request $req)
    {
        $getFile = $req->file_names . '.csv';
        $filePath = public_path("samplefiles/" . $getFile);
        $headers = ['Content-Type: application/csv'];
        return response()->download($filePath, $getFile, $headers);
    }


    public function import(Request $req)
    {
        if ($req->hasFile('importfile')) {
            $validator = Validator::make(
                [
                    'file'      => $req->importfile,
                    'extension' => strtolower($req->importfile->getClientOriginalExtension()),
                ],
                [
                    'file'          => 'required',
                    'extension'      => 'required|in:csv,xlsx,xls',
                ]
            );

            $file = $req->file('importfile');

            $file->move(public_path('import-directory'), $file->getClientOriginalName());


            $files = $file->getClientOriginalName();

            $filename = pathinfo($files, PATHINFO_FILENAME);
            $extension = pathinfo($files, PATHINFO_EXTENSION);
            $importfiles = $filename . '.' . $extension;
            if ($extension == 'csv' || $extension == 'xlsx' || $extension == 'xls') {
                $path = public_path('import-directory') . '/' . $importfiles;

                if ($req->filetypes == 'admin') {
                    // $users = (new FastExcel)->import($path, function ($line) {

                    // 	if($line['Email']!=""){
                    // 		$checkExist = Admin::where('email',$line['Email'])->first();
                    // 		if($checkExist==''){
                    // 			if($line['Username']!=""){
                    // 				$username = implode('-',explode(' ',$line['Username']));
                    // 			}
                    // 			elseif($line['Email']!=""){
                    // 				list($first,$second) = explode('@',$line['Email']);
                    // 				$username = $first;
                    // 			}
                    // 			else{
                    // 				$username = '';
                    // 			}

                    // 			Admin::create([
                    // 				'name' => $line['Name'],
                    // 				'email' => $line['Email'],
                    // 				'phone' => $line['Phone'],
                    // 				'username' => $username,
                    // 				'password' => bcrypt($line['Password']),
                    // 				'present_address' => $line['Present Address'],
                    // 				'permanent_address' => $line['Permanent Address'],
                    // 				'facebook' => $line['Facebook'],
                    // 				'twitter' => $line['Twitter'],
                    // 				'linkedin' => $line['Linkedin'],
                    // 				'github' => $line['Github'],
                    // 				'status' => $line['Status']
                    // 			]);
                    // 		}
                    // 	}


                    // });

                    $users = (new FastExcel())->import($path, function ($line) {
                        $curl = new Curl();
                        $line['type'] = 'admin';
                        $response = $curl->send('POST', 'common/import', '', json_encode($line), 'filter');
                    });
                } elseif ($req->filetypes == 'partner') {
                    $users = (new FastExcel())->import($path, function ($line) {
                        $curl = new Curl();
                        $line['type'] = 'partner';
                        $response = $curl->send('POST', 'common/import', '', json_encode($line), 'filter');
                    });
                } elseif ($req->filetypes == 'merchant') {
                    $users = (new FastExcel())->import($path, function ($line) {
                        $curl = new Curl();
                        $line['type'] = 'merchant';
                        $response = $curl->send('POST', 'common/import', '', json_encode($line), 'filter');
                        //dd($response);
                    });
                } elseif ($req->filetypes == 'order') {
                    $users = (new FastExcel())->import($path, function ($line) {
                        $curl = new Curl();
                        $line['type'] = 'order';
                        // dd($line);
                        $response = $curl->send('POST', 'common/import', '', json_encode($line), 'filter');
                        // dd($response);
                    });
                } elseif ($req->filetypes == 'product') {
                    // dd($req->all());
                    $users = (new FastExcel())->import($path, function ($line) {
                        $curl = new Curl();
                        $line['type'] = 'product';
                        // dd($line);
                        $response = $curl->send('POST', 'common/import', '', json_encode($line), 'filter');
                        // dd($response);
                    });
                } elseif ($req->filetypes == 'rider') {
                    $users = (new FastExcel())->import($path, function ($line) {
                        $curl = new Curl();
                        $line['type'] = 'rider';
                        // dd($line);
                        $response = $curl->send('POST', 'common/import', '', json_encode($line), 'filter');
                        // dd($response);
                    });
                } elseif ($req->filetypes == 'hub') {
                    $users = (new FastExcel())->import($path, function ($line) {
                        $curl = new Curl();
                        $line['type'] = 'hub';
                        // dd($line);
                        $response = $curl->send('POST', 'common/import', '', json_encode($line), 'filter');
                        // dd($response);
                    });
                }

                return redirect()->back();
            } else {
                return redirect()->back()->with('error', 'Please select excel or csv file only');
            }
        } else {
            return redirect()->back()->with('error', 'Please select excel file');
        }
    }


    public function export(Request $req)
    {
        $datas = $req->all();
        $type = $req->type;
        $extension = $req->extension;

        if ($req->has('method') && !empty($req->has('method'))) {
            $method = $req->method;
        } else {
            $method = 'GET';
        }

        if ($type == 'admin') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'admin');
                $respose = $curl->send($method, 'common/export', '', json_encode($array), 'filter');
                foreach ($respose as $key => $user) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Name' => $user->name,
                        'Mobile' => $user->phone,
                        'Email' => $user->email,
                        'Present Address' => $user->present_address,
                        'Permanent Address' => $user->permanent_address,
                        'Status' => $user->status,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('admin_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'partner') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'partner');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                foreach ($respose as $key => $user) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Legal Name' => $user->legal_name,
                        'Company Name' => strtoupper($user->company_name),
                        'Company Email' => $user->company_email,
                        'Company Mobile' => $user->company_phone,
                        'Company Address' => $user->address,
                        'Contact Person Name' => $user->contact_person_name,
                        'Contact Person Mobile' => $user->contact_person_phone,
                        'Contact Person Email' => $user->contact_person_email,
                        'Subscription Type' => $user->subscription_type,
                        'Subscription Expiry Date' => $user->subscription_expiry,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('partner_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'pickup') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'pickup');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $pickup) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consaignment ID' => $pickup->consignment_id,
                        'Rider Name' => $pickup->rider ? $pickup->rider->name : '',
                        'Recipient Name' => @$pickup->order->customer_name,
                        'Recipient Number' => @$pickup->order->customer_mobile,
                        'District' => @$pickup->order->district->district_name,
                        'Thana' => @$pickup->order->upozila->upozila_name,
                        'Merchant Order ID' => @$pickup->order->merchant_order_id,
                        'Amount to be collect' => @$pickup->order->collectable_amount,
                        'Status' => @$pickup->deliver_status->merchant_status,
                    );
                    // dd($arrayval);
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('pickup_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'delivery') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'delivery');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $delivery) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consaignment ID' => @$delivery->order->consignment_id,
                        'Recipient Name' => @$delivery->order->customer_name,
                        'Recipient Phone' => @$delivery->order->customer_mobile,
                        'District' => @$delivery->order->district->district_name,
                        'Thana' => @$delivery->order->upozila->upozila_name,
                        'Merchant Name' => @$delivery->merchant->business->name,
                        'Rider Name' => @$delivery->rider->name,
                        'Merchant ID' => @$delivery->order->merchant_order_id,
                        'Amount to be collect' => @$delivery->order->collectable_amount,
                        'Received amount' => $delivery->received_amount,
                        'Delivery Charge' => @$delivery->order->delivery_charge,
                        'Return Charge' => @$delivery->order->total_return_cost,
                        'COD' => @$delivery->order->cod_charge,
                        'Weight Charge' => @$delivery->order->weight_charge,
                        'Status' => $delivery->deliver_status->name
                    );

                    // dd($arrayval);
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('delivery_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'cashRecivedList') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'cashRecivedList');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consaignment ID' => @$data->order->consignment_id,
                        'Recipient Name' => @$data->order->customer_name,
                        'Recipient Phone' => @$data->order->customer_mobile,
                        'District' => @$data->order->district->district_name,
                        'Thana' => @$data->order->upozila->upozila_name,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Rider Name' => @$data->rider->name,
                        'Merchant ID' => @$data->order->merchant_order_id,
                        'Amount to be collect' => @$data->order->collectable_amount,
                        'Received amount' => $data->received_amount,
                        'Delivery Charge' => @$data->order->delivery_charge,
                        'Return Charge' => @$data->order->total_return_cost,
                        'COD' => @$data->order->cod_charge,
                        'Weight Charge' => @$data->order->weight_charge,
                        'Status' => @$data->deliver_status->name,
                    );
                    // dd($arrayval);
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('cashRecivedList_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'merchant') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'merchant');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                //dd($respose);
                foreach ($respose as $key => $user) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Merchant Name' => $user->name,
                        'Code' => $user->code,
                        'Email' => $user->email,
                        'Contact' => $user->phone,
                        'Username' => $user->username,
                        'Contact' => $user->phone,
                        'Emargency Contact' => $user->emargency_contact,
                        'Enroll Date' => $user->enroll_date,
                        'Member Type' => $user->member_type,
                    );
                    //dd($arrayval);
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('merchant_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'product') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'product', 'request'=>$requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $product) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Merchant Name' => $product->merchant->name,
                        'Store Name' => strtoupper($product->store->name),
                        'Product Name' => $product->name,
                        'Subtitle' => $product->subtitle,
                        'SKU' => $product->sku,
                        'Price' => $product->price,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('product_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'order') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'order', 'request'=>$requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $order) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consignment ID' => $order->consignment_id,
                        'Store Name' => @$order->store->name,
                        'Recipient Name' => @$order->customer_name,
                        'Recipient Number' => @$order->customer_mobile,
                        'District' => @$order->district->district_name,
                        'Thana' => @$order->upozila->upozila_name,
                        'Merchant Order ID' => $order->merchant_order_id,
                        'Amount to be collect' => $order->collectable_amount,
                        'Delivery Charge' => $order->delivery_charge,
                        'Return Charge' => $order->total_return_cost,
                        'COD Charge' => $order->cod_charge
                    );
                    //dd($arrayval);
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('order_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'group') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'group');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                foreach ($respose as $key => $group) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Group Name' => $group->name,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('group_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'role') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'role');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);
                foreach ($respose as $key => $role) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Role Name' => $role->name,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('role_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'permission') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'permission');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);
                foreach ($respose as $key => $per) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Group Name' => $per->group->name,
                        'Permission Name' => $per->name,
                        'Route Name' => $per->guard_name,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('permission_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'plan') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'plan');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);
                foreach ($respose as $key => $plan) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Plan Name' => $plan->name,
                        'Code' => $plan->code,
                        'Plan Type' => $plan->type,
                        'Charge Amount' => $plan->charge,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('plan_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'rider') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'rider');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);
                foreach ($respose as $key => $rider) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Name' => $rider->name,
                        'Employee ID' => $rider->employee_id,
                        'Hub' => $rider->hub ? $rider->hub->name : "",
                        'Mobile' => $rider->phone,
                        'Email' => $rider->email,
                        'Address' => $rider->address,
                        'Username' => $rider->username,
                        'Emargency Contact' => $rider->emargency_contact,
                        'Joining Date' => $rider->joining_date,
                        'Enroll Date' => $rider->enroll_date,
                        'Zone' => $rider->zone,
                        'Area' => $rider->area,


                    );
                    // dd($arrayval);
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('rider_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'store') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'store');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);
                foreach ($respose as $key => $store) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Store Name' => $store->name,
                        'Merchant Name' => $store->merchant ? $store->merchant->name : "",
                        'Mobile' => $store->phone,
                        'Email' => $store->email,
                        'Store Address' => $store->address,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('store_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'hub') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'hub');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);


                foreach ($respose as $key => $hub) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Hub Name' => $hub->name,
                        'Code' => $hub->code,
                        'Hub Location' => $hub->name,
                        'Mobile' => $hub->phone,
                        'Email' => $hub->email,
                        'Address' => $hub->address,
                        'Username' => $hub->username,
                        'Emargency Contact' => $hub->emargency_contact,
                        'Contact Person Name' => $hub->contact_person_name,
                        'Contact Person Phone' => $hub->contact_person_phone,
                        'Contact Person Email' => $hub->contact_person_email,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('hub_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'merchantpayment') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'merchantpayment');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $hub) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Merchant Name' => $hub->merchant->business->name,
                        'Payment Method' => $hub->payment_method,
                        'Amount' => $hub->amount,
                        'Account Name' => $hub->account_name,
                        'Account Number' => $hub->account_number,
                        'Routing' => $hub->routing_no,
                        'Branch' => $hub->branch_no,
                        'Note' => $hub->remark,
                        'Payment Date' => $hub->payment_date,
                        'Entry Date' => $hub->created_at,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('merchantpayment_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'paymentrequest') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'paymentrequest');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $hub) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Merchant Name' => $hub->merchant->business->name,
                        'Payment Method' => $hub->payment_method,
                        'Amount' => $hub->amount,
                        'Account Name' => $hub->account_name,
                        'Account Number' => $hub->account_number,
                        'Routing' => $hub->routing_no,
                        'Branch' => $hub->branch_no,
                        'Note' => $hub->remark,
                        'Payment Date' => $hub->payment_date,
                        'Entry Date' => $hub->created_at,
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('paymentrequest_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'banner') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'banner');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $banner) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Banner Name' => $banner->name,
                        'Status' => $banner->status == '1' ? 'Active' : 'Inactive'
                    );
                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('banner_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'complaint') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'complaint');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $complaint) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Merchant Name' => $complaint->merchant->business->name,
                        'Rider Name' => $complaint->rider->name,
                        'Purpose' => $complaint->purpose,
                        'Message' => $complaint->message,
                        'Status' => $complaint->status == '1' ? 'Active' : 'Inactive'
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('complaint_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'document') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'document');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $document) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Document Name' => $document->name,
                        'User Type' => $document->user_type,
                        'User Name' => $document->user_id,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('document_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'documenttype') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'documenttype');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $documenttype) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Document Type' => $documenttype->name,
                        'Status' => $documenttype->status == '1' ? 'Active' : 'Inactive'
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('documenttype_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'deliverystatus') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'deliverystatus');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $deliverystatus) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Status in Admin Panel' => $deliverystatus->name,
                        'Status in Merchant Panel' => $deliverystatus->merchant_status,
                        'color' => $deliverystatus->color,
                        'Type' => $deliverystatus->type
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('deliverystatus_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'paymentstatus') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'paymentstatus');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $paymentstatus) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Payment Status' => $paymentstatus->name,
                        'Status' => $paymentstatus->status == '1' ? 'Active' : 'Inactive'
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('paymentstatus_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'employeeid') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'employeeid');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $employeeid) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Employee ID Prefix' => $employeeid->name,
                        'Role' => $employeeid->role->name,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('employeeid_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'deliverynote') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'deliverynote');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $deliverynote) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Delivery Note' => $deliverynote->name,
                        'Note type' => $deliverynote->type
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('deliverynote_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'codcharge') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'codcharge');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                // dd($respose);

                foreach ($respose as $key => $codcharge) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Percentage' => $codcharge->percentage
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('codcharge_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'generalsetting') {
            function usersGenerator()
            {
                $curl = new Curl();
                $array = array('type' => 'generalsetting');
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $generalsetting) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Site Name' => $generalsetting->site_name,
                        'Site Title' => $generalsetting->site_title,
                        'Copyright Message' => $generalsetting->copyright_message,
                        'Copyright Name' => $generalsetting->copyright_name,
                        'Copyright Url' => $generalsetting->copyright_url,
                        'Design Develop By Text' => $generalsetting->design_develop_by_text,
                        'Design Develop By Name' => $generalsetting->design_develop_by_name,
                        'Design Develop By Url' => $generalsetting->design_develop_by_url,
                        'Phone' => $generalsetting->phone,
                        'Email' => $generalsetting->email,
                        'Website Link' => $generalsetting->website_link,
                        'Default Url' => $generalsetting->default_url,
                        'Api Url' => $generalsetting->api_url
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('generalsetting_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'merchantpaymentreport') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'merchantpaymentreport', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Invoice No.' => $data->invoice_no,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Merchant Code' => @$data->merchant->code,
                        'Invoice Date' => $data->invoice_date,
                        'Delivery Charge' => $data->delivery_charge,
                        'COD Charge' => $data->cod_charge,
                        'Collection' => $data->collection,
                        'Total Order' => $data->totalorder,
                        'Return Charge' => $data->return_charge,
                        'Weight Charge' => $data->weight_charge,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('merchantpayment_report_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'merchantpayment_report_allDetails') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'merchantpayment_report_allDetails', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consignment Id' => @$data->order->consignment_id,
                        'Hub Name' => @$data->merchant->hub->name,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Merchant Code' => @$data->merchant->code,
                        'Collectable Amount' => @$data->order->collectable_amount,
                        'Delivery Charge' => @$data->order->delivery_charge,
                        'COD Charge' => @$data->order->cod_charge,
                        'Weight Charge' => @$data->order->weight_charge,
                        'Return Charge' => @$data->order->total_return_cost,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('merchantpayment_report_allDetails_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'rider_report') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'rider_report', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Rider Name' => @$data->rider->name,
                        'Received Amount' => @$data->total_received,
                        'Delivery Charge' => @$data->total_deliverycharge,
                        'Return Charge' => @$data->total_returncharge,
                        'COD Charge' => @$data->total_codcharge,
                        'Weight Charge' => @$data->total_weight_charge,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('rider_report_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'rider_delivery_report') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'rider_delivery_report', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');
                //                dd($respose);
                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consaignment ID' => @$data->order->consignment_id,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Rider Name' => @$data->rider->name,
                        'Recipient' => @$data->order->customer_name . "-" . @$data->order->customer_mobile,
                        'Merchant Order ID' => @$data->order->merchant_order_id,
                        'Collected' => @$data->received_amount,
                        'Delivery Charge' => @$data->delivery_charge,
                        'Return Charge' => @$data->total_return_cost,
                        'COD Charge' => @$data->cod_charge,
                        'Weight Charge' => @$data->weight_charge,
                        'Total Charge' => @$data->total_charge,
                        'Status' => @$data->deliver_status->name,
                        'Assigned Date' => @$data->assign_date,
                        'Delivery Date' => @$data->delivery_date,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('rider_delivery_report_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'rider_pickup_report') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'rider_pickup_report', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consaignment ID' => $data->consignment_id,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Rider Name' => @$data->rider->name,
                        'Recipient Name' => @$data->order->customer_name,
                        'Recipient Number' => @$data->order->customer_mobile,
                        'District' => @$data->order->district->district_name,
                        'Thana' => @$data->order->upozila->upozila_name,
                        'Merchant Order ID' => @$data->order->merchant_order_id,
                        'Amount to be collect' => @$data->order->collectable_amount,
                        'Status' => @$data->deliver_status->name,
                        'Remarks' => $data->note,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('rider_pickup_report_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'invoicegenerated') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }

                $curl = new Curl();
                $array = array('type' => 'invoicegenerated', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Merchant Code' => @$data->merchant ? $data->merchant->code : '',
                        'Total Order' => $data->total_order,
                        'Total Collection' => $data->total_received,
                        'Delivery Charge' => $data->total_deliverycharge,
                        'Return Charge' => $data->total_returncharge,
                        'COD Charge' => $data->total_codcharge,
                        'Weight Charge' => $data->total_weight_charge,
                        'Total Charge' => $data->total_charge,
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('invoice_generated_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'invoicegenerate_list') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }
                $curl = new Curl();
                $array = array('type' => 'invoicegenerate_list', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Invoice No' => $data->invoice_no,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Merchant Code' => @$data->merchant->code,
                        'Invoice Date' => $data->invoice_date
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('invoicegenerate_list_' . date('Y-m-d H-m-i') . '.' . $extension);
        } elseif ($type == 'hubDeliveryReport') {
            function usersGenerator()
            {
                if (request()->has('requestdata')) {
                    $requestData = request()->requestdata;
                } else {
                    $requestData = '';
                }
                $curl = new Curl();
                $array = array('type' => 'hubDeliveryReport', 'request' => $requestData);
                $respose = $curl->send('GET', 'common/export', '', json_encode($array), 'filter');

                foreach ($respose as $key => $data) {
                    $arrayval = array(
                        'SL' => $key + 1,
                        'Consaignment ID' => $data->order->consignment_id,
                        'Merchant Name' => @$data->merchant->business->name,
                        'Rider Name' => @$data->rider->name,
                        'Recipient' => @$data->order->customer_name . "-" . @$data->order->customer_mobile,
                        'Merchant Order ID' => @$data->order->merchant_order_id,
                        'Collected' => @$data->received_amount,
                        'Delivery Charge' => @$data->delivery_charge,
                        'Return Charge' => @$data->total_return_cost,
                        'COD Charge' => @$data->cod_charge,
                        'Weight Charge' => @$data->weight_charge,
                        'Total Charge' => @$data->total_charge,
                        'Status' => @$data->deliver_status->name,
                        'Assigned Date' => @$data->assign_date,
                        'Delivery Date' => @$data->delivery_date
                    );

                    yield $arrayval;
                }
            }
            return (new FastExcel(usersGenerator()))->download('hub_delivery_report_' . date('Y-m-d H-m-i') . '.' . $extension);
        }
    }




    public function permissions(Request $req, Curl $curl)
    {
        try {
            $approve_val = $req->approve_val;
            $valuearray = explode(',', $approve_val);

            $tablename = $req->tablename;
            $status = $req->status;
            $arrayuval =  array(
                'tables' => $tablename,
                'status' => $status,
                'ids' => $valuearray
            );
            // dd($arrayuval);
            $response = $curl->send('GET', 'common/permission', '', json_encode($arrayuval), 'update');
            //  dd($response);
            if ($response->success == true) {
                self::message('success', $response->message);
                return redirect()->back();
            } else {
                self::message('success', $response->message);
                return redirect()->back();
            }
        } catch (\Exception $exception) {
            \Helper::handleException($exception);

            self::message('error', 'Failed, Please try again');
            return redirect()->back();
        }
    }


    public function changeStatus(Request $req, Curl $curl)
    {
        $orderid = $req->orderid;
        $actions = $req->actions;

        $response = $curl->send('GET', 'common/getdeliverylist', '', json_encode($orderid), 'update');
        $statuses =  $curl->send('GET', 'common/delivery-status', '', '', 'display');
        //dd($response);
        return view('admin.pages.delivery.ajaxfile', compact('response', 'actions', 'statuses'));
    }


    public function assignHub(Request $req, Curl $curl)
    {
        $merchantid = $req->merchantid;
        $response = $curl->send('GET', 'common/merchantAjax', '', json_encode($merchantid), 'update');
        $newDeliveryPlan = (array) $response->data->newdeliveryplan;
        $newReturnPlan = (array) $response->data->newreturnplan;

        $hubinfo = $this->commonService->getCommonData('hub');
        $codinfo = $this->commonService->getCommonData('codlist');
        return view('admin.pages.merchant.ajaxfile', compact('response', 'newDeliveryPlan', 'newReturnPlan', 'codinfo', 'hubinfo'));
    }


    public function getOrderId(Request $req, Curl $curl)
    {
        $keyword = $req->keyword;
        $response = $curl->send('GET', 'common/getorderlist', '', $keyword, 'display');
        return $response;
    }


    public function getDeliveredOrderId(Request $req, Curl $curl)
    {
        $keyword = $req->keyword;
        $response = $curl->send('GET', 'common/getdeliveredorderlist', '', $keyword, 'display');
        return $response;
    }

    public function geAjaxData(Request $req, Curl $curl)
    {
        $input = $req->all();
        $response = $curl->send('GET', 'common/ajax', '', json_encode($input), 'filter');

        $str = '<select class="form-control" name="employeeid_prefix" required>';
        foreach ($response->data as $eid) {
            if ($response->message == "employeeid") {
                $str .= '<option value="' . $eid->name . '">' . $eid->name . '</option>';
            } else {
                $str .= '<option value="' . $eid->id . '">' . $eid->name . '</option>';
            }
        }
        $str .= '</select>';
        return $str;
    }

    public function geUserData(Request $req, Curl $curl)
    {
        $input = $req->all();
        $response = $curl->send('GET', 'common/ajaxuser', '', json_encode($input), 'filter');
        $str = '<select name="user_id" id="user_id" class="form-control">';
        foreach ($response->data as $eid) {
            $str .= '<option value="' . $eid->id . '">' . $eid->name . '</option>';
        }
        $str .= '</select>';
        $arrayDat = array('tablename' => ucfirst($response->message), 'data' => $str);
        return $arrayDat;
    }



    public function getCommonData(Request $req, Curl $curl)
    {
        $input = $req->all();
        $response = $curl->send('GET', 'common/ajax', '', json_encode($input), 'filter');

        if ($input['table'] == 'upozila') {
            return $this->getArea($response);
        } elseif ($input['table'] == 'stores') {
            return $this->getStoreId($response);
        }
    }

    public function getArea($response)
    {
        $str = '<select name="area" id="area" class="form-control select2" required onchange="getPlanPrice()">';
        foreach ($response->data as $eid) {
            $str .= '<option value="' . $eid->upozila_id . '">' . ucfirst(strtolower($eid->upozila_name)) . '</option>';
        }
        $str .= '</select>';
        return $str;
    }


    public function getStoreId($response)
    {
        $str = '<select name="store_id" id="store_id" class="form-control select2" required  onchange="getPlanPrice()">';
        foreach ($response->data as $eid) {
            $str .= '<option value="' . $eid->id . '" title="' . $eid->region . '~' . $eid->area . '">' . ucfirst(strtolower($eid->name)) . '</option>';
        }
        $str .= '</select>';
        return $str;
    }


    public function getPlanPrice(Request $req, Curl $curl)
    {
        $input = $req->all();
        $response = $curl->send('GET', 'common/planprice', '', json_encode($input), 'filter');
        //dd($response);
        if ($response->success) {
            return $response->data;
        } else {
            return 0;
        }
    }


    public function getWeight(Request $req, Curl $curl)
    {
        $input = $req->all();
        $response = $curl->send('GET', 'common/weightprice', '', json_encode($input), 'filter');

        if ($response->success) {
            return $response->data;
        } else {
            return 0;
        }
    }


    public function ajaxCheckValidation(Request $req, Curl $curl)
    {
        $input = $req->all();

        $response = $curl->send('GET', 'common/ajax-validation', '', json_encode($input), 'filter');
        return $response;
    }
}
