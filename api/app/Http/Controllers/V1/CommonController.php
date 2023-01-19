<?php

namespace App\Http\Controllers\V1;

use Carbon\Carbon;
use App\Models\Hub;
use App\Models\Plan;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Group;
use App\Models\Order;
use App\Models\Rider;
use App\Models\Store;
use App\Models\Banner;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Document;
use App\Models\Merchant;
use App\Models\Codcharge;
use App\Models\Complaint;
use App\Models\Employeeid;
use App\Models\Permission;
use App\Models\AssignPickup;
use App\Models\Deliverynote;
use App\Models\DocumentType;
use App\Models\MerchantPlan;
use App\Models\WeightDetail;
use Illuminate\Http\Request;
use App\Models\PaymentStatus;
use App\Models\DeliveryStatus;
use App\Models\DeliveryInvoice;
use App\Models\MerchantContact;
use App\Models\MerchantBusiness;
use App\Models\MerchantPayments;
use App\Models\DeliveryManagement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\DeliveryInvoiceDetails;
use App\Models\MerchantPaymentRequest;
use App\Http\Controllers\BaseController;
use App\Http\Resources\ComplaintResource;
use Symfony\Component\HttpFoundation\Response;

class CommonController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return ComplaintResource
     */

    /********************** Common service for merchant************************ */

    public function storeMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = Store::where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Store List', Response::HTTP_OK);
    }
    public function productMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = Product::orderBy('id', 'DESC')->where('merchant_id', $merchantId)->get();
        return $this->successResponse($data, 'Selected Product List', Response::HTTP_OK);
    }

    public function deliveryPlanMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = MerchantPlan::with('plan')->where('plan_type', 'delivery')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        // dd($data);
        return $this->successResponse($data, 'Selected Delivery Plan List', Response::HTTP_OK);
    }

    public function returnPlanMerchant()
    {
        $merchantId = auth('merchant')->id();
        $data = MerchantPlan::with('plan')->where('plan_type', 'return')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Return Plan List', Response::HTTP_OK);
    }

    public function riderMerchant()
    {
        $data = Rider::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Rider List', Response::HTTP_OK);
    }

    public function permission()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        // return $data;
        $responsedata = DB::table($data['tables'])->whereIn('id', $data['ids'])->update(['status' => $data['status']]);

        return $this->successResponse($responsedata, 'Successfully Updated', Response::HTTP_OK);
    }
    public function merchantRiderApp()
    {
        $data = Merchant::select('id', 'name')->orderBy('id', 'DESC')->get();

        return $this->successResponse($data, 'Selected Merchant List', Response::HTTP_OK);
    }

    public function merchant()
    {
        // $user = Auth::user();
        // $roleid = $user->user_type;
        $data = Merchant::where('status', 1)->orderBy('id', 'DESC')->get();
        /* if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Merchant::with('business')->where('status', 1)->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
        } else {
            $data = Merchant::with('business')->where('status', 1)->orderBy('id', 'DESC')->get();
        } */


        return $this->successResponse($data, 'Selected Merchant List', Response::HTTP_OK);
    }






    public function merchantFilter()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        $merchantid = json_decode(file_get_contents('php://input'), true);
        //return $merchantid;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Merchant::whereIn('id', $merchantid)->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
        } else {
            $data = Merchant::whereIn('id', $merchantid)->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse($data, 'Selected Merchant List', Response::HTTP_OK);
    }

    public function rider()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data = Rider::where('hub_id', '=', $hub->id)->where("status", 1)->orderBy('id', 'DESC')->get();
        } else {
            $data = Rider::where("status", 1)->orderBy('id', 'DESC')->get();
        }
        return $this->successResponse($data, 'Selected Rider List', Response::HTTP_OK);
    }

    public function hub()
    {
        $data = Hub::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Hub List', Response::HTTP_OK);
    }

    public function role()
    {
        $data = Role::whereNull('type')->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Role List', Response::HTTP_OK);
    }

    public function admin()
    {
        $data = Admin::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Admin List', Response::HTTP_OK);
    }

    public function store()
    {
        $data = Store::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Store List', Response::HTTP_OK);
    }

    public function product()
    {
        $data = Product::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Product List', Response::HTTP_OK);
    }

    public function documentType()
    {
        $data = DocumentType::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Document Type List', Response::HTTP_OK);
    }

    public function deliveryPlan()
    {
        $data = Plan::where('type', 'delivery')->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Delivery Plan List', Response::HTTP_OK);
    }

    public function returnPlan()
    {
        $data = Plan::where('type', 'return')->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Return Plan List', Response::HTTP_OK);
    }

    public function getDeliveryList()
    {
        $orderids = json_decode(file_get_contents('php://input'), true);

        $data = DeliveryManagement::with('merchant', 'rider', 'order')->whereIn('id', $orderids)->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Delivery List', Response::HTTP_OK);
    }

    public function getDeliveredOrderId(Request $request)
    {
        $data = DeliveryManagement::with('order:id,consignment_id')
            ->select('order_id')->where('status', 'Delivered')->orderBy('id', 'DESC')->get();

        if (count($data) > 0) {
            foreach ($data as $d) {
                $ids[] = strval($d->order->consignment_id);
            }
            return array_values($ids);
        } else {
            return ['No order id found'];
        }
    }


    public function getOrderId(Request $request)
    {
        $data = DeliveryManagement::with('order:id,consignment_id')
            ->select('order_id')->where('status', 14)->orderBy('id', 'DESC')->get();
        if (count($data) > 0) {
            foreach ($data as $d) {
                $ids[] = strval($d->order->consignment_id);
            }
            return array_values($ids);
        } else {
            return ['No order id found'];
        }
    }


    public function geAjaxData(Request $request)
    {
        $resdata = json_decode(file_get_contents('php://input'), true);
        $table = $resdata['table'];
        $id = $resdata['id'];
        $value = $resdata['value'];

        if ($table == 'upozila') {
            $orderByCol = 'upozila_name';
            $orderBy = 'ASC';
        } else {
            $orderByCol = $id;
            $orderBy = 'DESC';
        }


        $data = DB::table($table)->where($id, $value)->orderBy($orderByCol, $orderBy)->get();
        return $this->successResponse($data, $table, Response::HTTP_OK);
    }



    public function geLastUserData()
    {
        $data = Admin::select('employee_id')->where('employee_id', '!=', '')->orderBy('id', 'DESC')->first();
        return $this->successResponse($data, 'Last User', Response::HTTP_OK);
    }


    public function geUserData(Request $request)
    {
        $resdata = json_decode(file_get_contents('php://input'), true);
        $table = $resdata['table'];

        $data = DB::table($table)->get();
        return $this->successResponse($data, $table, Response::HTTP_OK);
    }

    public function cod()
    {
        $data = Codcharge::orderBy('id', 'DESC')->first();
        return $this->successResponse($data, 'Selected COD Charge', Response::HTTP_OK);
    }

    public function codlist()
    {
        $data = Codcharge::orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected COD Charge', Response::HTTP_OK);
    }

    public function changePassword()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $responsedata = DB::table($data['table_name'])->where('id', $data['table_id'])->update(['password' => Hash::make($data['newpassword'])]);
        return $this->successResponse($responsedata, 'Successfully Changed', Response::HTTP_OK);
    }



    public function district()
    {
        $data = District::orderBy('name', 'ASC')->get();
        return $this->successResponse($data, 'Selected district', Response::HTTP_OK);
    }

    public function upozila(Request $request)
    {
        $district = $request->district_id;
        $data = Upazila::select('id', 'district_id', 'name')->where('district_id', $district)->orderBy('upozila_name', 'ASC')->get();
        return $this->successResponse($data, 'Selected upozila', Response::HTTP_OK);
    }

    public function upazila()
    {
        $data = Upazila::select('id', 'district_id', 'name')->orderBy('name', 'ASC')->get();
        return $this->successResponse($data, 'Selected upozila', Response::HTTP_OK);
    }

    public function suburban()
    {
        $data = DB::table('upozila')->where('district_id', 26)->orderBy('upozila_name', 'ASC')->get();
        return $this->successResponse($data, 'suburban', Response::HTTP_OK);
    }



    public function export()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        $data = json_decode(file_get_contents('php://input'), true);

        if ($data['type'] == 'admin') {
            return Admin::cursor();
        } elseif ($data['type'] == 'partner') {
            return Partner::cursor();
        } elseif ($data['type'] == 'product') {
            //return Product::with('merchant', 'store')->orderBy('id', 'DESC')->get();
            $getData = new ProductController();

            $responseData = $getData->filter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'merchant') {
            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return Merchant::with('hub', 'business', 'contacts')->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
            } else {
                return Merchant::with('hub', 'business', 'contacts')->orderBy('id', 'DESC')->get();
            }
        } elseif ($data['type'] == 'order') {
            $getData = new OrderController();
            $responseData = $getData->filter($data['request'], 'csv');
            return $responseData;

            /* if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return Order::with('merchant', 'merchant.business', 'store', 'plan', 'returnplan', 'deliverStatus', 'district', 'upozila')->where('status', 25)->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->orderBy('id', 'DESC')->get();
            } else {
                return Order::with('merchant', 'merchant.business', 'store', 'plan', 'returnplan', 'deliverStatus', 'district', 'upozila')->where('status', 25)->orderBy('id', 'DESC')->get();
            } */

            // return Order::with('merchant', 'store', 'plan', 'returnplan')->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'group') {
            return Group::cursor();
        } elseif ($data['type'] == 'role') {
            return Role::cursor();
        } elseif ($data['type'] == 'permission') {
            return Permission::with('group')->get();
        } elseif ($data['type'] == 'plan') {
            return Plan::cursor();
        } elseif ($data['type'] == 'rider') {
            $user = Auth::user();
            $roleid = $user->user_type;

            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return Rider::with('hub')->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
            } else {
                return Rider::with('hub')->orderBy('id', 'DESC')->get();
            }
        } elseif ($data['type'] == 'store') {
            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return Store::with('merchant')->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->orderBy('id', 'DESC')->get();
            } else {
                return Store::with('merchant')->orderBy('id', 'DESC')->get();
            }
        } elseif ($data['type'] == 'pickup') {
            return AssignPickup::with('merchant', 'rider', 'order', 'order.plan', 'order.returnplan', 'deliverStatus:id,name')->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'delivery') {
            return DeliveryManagement::with('merchant', 'rider', 'order', 'order.plan', 'order.returnplan', 'deliverStatus:id,name')->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'cashRecivedList') {
            $user = Auth::user();
            $roleid = $user->user_type;

            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return DeliveryManagement::with('merchant', 'rider', 'order', 'order.plan', 'order.returnplan', 'deliverStatus:id,name')->where('status', 16)->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->orderBy('id', 'DESC')->get();
            } else {
                return DeliveryManagement::with('merchant', 'rider', 'order', 'order.plan', 'order.returnplan', 'deliverStatus:id,name')->where('status', 16)->orderBy('id', 'DESC')->get();
            }
        } elseif ($data['type'] == 'hub') {
            return Hub::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'merchantpayment') {
            return MerchantPayments::with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'paymentrequest') {
            return MerchantPaymentRequest::with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'banner') {
            return Banner::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'complaint') {
            $user = Auth::user();
            $roleid = $user->user_type;

            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return Complaint::with('merchant', 'merchant.business', 'rider')->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->orderBy('id', 'DESC')->get();
            } else {
                return Complaint::with('merchant', 'merchant.business', 'rider')->orderBy('id', 'DESC')->get();
            }
        } elseif ($data['type'] == 'document') {
            return Document::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'documenttype') {
            return DocumentType::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'deliverystatus') {
            return DeliveryStatus::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'paymentstatus') {
            return PaymentStatus::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'employeeid') {
            return Employeeid::with('role')->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'deliverynote') {
            return Deliverynote::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'codcharge') {
            return Codcharge::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'generalsetting') {
            // return "hello";
            return Setting::orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'invoicegenerate') {
            $user = Auth::user();
            $roleid = $user->user_type;

            $statuses = array(16, 17);
            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

                return DeliveryManagement::with('merchant', 'merchant.business')
                    ->whereHas("merchant", function ($subQuery) use ($hub) {
                        $subQuery->where("hub_id", "=", $hub->id);
                    })->whereIn('status', $statuses)
                    ->select(
                        'merchant_id',
                        DB::raw("SUM(received_amount) as total_received"),
                        DB::raw("SUM(delivery_charge) as total_deliverycharge"),
                        DB::raw("SUM(total_return_cost) as total_returncharge"),
                        DB::raw("SUM(cod_charge) as total_codcharge"),
                        DB::raw("COUNT(id) as total_order")
                    )
                    ->groupBy('merchant_id')->get();
            } else {
                return DeliveryManagement::with('merchant', 'merchant.business')
                    ->where('status', 16)
                    ->select(
                        'merchant_id',
                        DB::raw("SUM(received_amount) as total_received"),
                        DB::raw("SUM(delivery_charge) as total_deliverycharge"),
                        DB::raw("SUM(total_return_cost) as total_returncharge"),
                        DB::raw("SUM(cod_charge) as total_codcharge"),
                        DB::raw("COUNT(id) as total_order")
                    )
                    ->groupBy('merchant_id')->get();
            }
        } elseif ($data['type'] == 'invoicegenerate/generated') {
            return DeliveryInvoice::with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'merchantpayment') {
            $user = Auth::user();
            $roleid = $user->user_type;

            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return MerchantPayments::with('merchant', 'merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->orderBy('id', 'DESC')->get();
            } else {
                return MerchantPayments::with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
            }
        } elseif ($data['type'] == 'paymentrequest') {
            $user = Auth::user();
            $roleid = $user->user_type;



            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
                return MerchantPaymentRequest::with('merchant', 'merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->orderBy('id', 'DESC')->get();
            } else {
                return MerchantPaymentRequest::with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
            }
        } elseif ($data['type'] == 'merchantpaymentreport') {
            $user = Auth::user();
            $roleid = $user->user_type;
            $getData = new MerchantPaymentReportController();
            $responseData = $getData->filter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'merchantpayment_report_allDetails') {
            $user = Auth::user();
            $roleid = $user->user_type;
            $getData = new MerchantPaymentReportController();

            $responseData = $getData->detailsFilter($data['request'], 'csv');
            return $responseData;

            // if ($roleid == 29) {
            //     $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            //     return DeliveryInvoiceDetails::with('merchant','merchant.business','merchant.hub','order')->whereHas("merchant", function ($subQuery) use ($hub) {
            //         $subQuery->where("hub_id", "=", $hub->id);
            //     })->orderBy('id', 'DESC')->get();
            // } else {
            //     return DeliveryInvoiceDetails::with('merchant','merchant.business','merchant.hub','order')->orderBy('id', 'DESC')->get();

            // }
        } elseif ($data['type'] == 'rider_report') {
            $getData = new DeliveryController();
            $responseData = $getData->riderReportFilter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'rider_delivery_report') {
            $getData = new DeliveryController();
            $responseData = $getData->riderDeliveryReportFilter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'rider_pickup_report') {
            $user = Auth::user();
            $roleid = $user->user_type;
            $getData = new PickupController();
            $responseData = $getData->riderPickUpReportFilter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'invoicegenerated') {
            $getData = new InvoiceGenerateController();
            $responseData = $getData->filter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'invoicegenerate_list') {
            $getData = new InvoiceGenerateController();
            $responseData = $getData->listFilter($data['request'], 'csv');
            return $responseData;


            /* $user = Auth::user();
            $roleid = $user->user_type;

            if ($roleid == 29) {
                $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();

                return DeliveryInvoice::with('merchant', 'merchant.business')->whereHas("merchant", function ($subQuery) use ($hub) {
                    $subQuery->where("hub_id", "=", $hub->id);
                })->orderBy('id', 'DESC')->get();
            } else {
                return DeliveryInvoice::with('merchant', 'merchant.business')->orderBy('id', 'DESC')->get();
            } */
        } elseif ($data['type'] == 'hubDeliveryReport') {
            $getData = new DeliveryController();
            $responseData = $getData->hubDeliveryReportFilter($data['request'], 'csv');
            return $responseData;
        }
    }


    public function exportMerchant()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $merchantId = auth('merchant')->id();

        if ($data['type'] == 'product') {
            //return Product::with('store')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();

            $getData = new ProductController();

            $responseData = $getData->merchantFilter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'order') {
            $getData = new OrderController();
            $responseData = $getData->merchantFilter($data['request'], 'csv');
            return $responseData;
            // return Order::with('store', 'plan', 'returnplan')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'pickup') {
            $merchantId = auth('merchant')->id();
            return AssignPickup::with('merchant', 'rider', 'order', 'order.plan', 'order.returnplan', 'deliverStatus:id,name')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'delivery') {
            $merchantId = auth('merchant')->id();
            return DeliveryManagement::with('merchant', 'rider', 'order', 'order.plan', 'order.returnplan', 'deliverStatus:id,name')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'store') {
            return Store::with('merchant')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'complaint') {
            return Complaint::with('merchant', 'merchant.business', 'rider')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        } elseif ($data['type'] == 'merchantpaymentreport') {
            $getData = new MerchantPaymentReportController();
            $responseData = $getData->merchantFilter($data['request'], 'csv');
            return $responseData;
        } elseif ($data['type'] == 'merchantpayment_report_allDetails') {
            $getData = new MerchantPaymentReportController();
            $responseData = $getData->merchantDetailsFilter($data['request'], 'csv');
            return $responseData;

            // return DeliveryInvoiceDetails::with('merchant','merchant.business','merchant.hub','order')->where('merchant_id', $merchantId)->orderBy('id', 'DESC')->get();
        }
    }

    public function import()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if ($data['type'] == 'partner') {
            $responsedata = Partner::create([
                'legal_name' => $data['Name'],
                'company_email' => $data['Email'],
                'company_phone' => $data['Phone'],
                'company_name' => $data['Company Name'],
                'address' => $data['Address'],
                'contact_person_name' => $data['Contact Person Name'],
                'contact_person_phone' => $data['Contact Person Mobile'],
                'contact_person_email' => $data['Contact Person Email'],
                'subscription_type' => $data['Subscription Type'],
                'subscription_expiry' => $data['Expiry Date'],
            ]);
        } elseif ($data['type'] == 'order') {
            $getLastId = Order::orderBy('id', 'DESC')->first();

            if ($data['Merchant Name'] != '') {
                $merchant_id = MerchantBusiness::where('name', $data['Merchant Name'])->first()->merchant_id;
            }


            if ($getLastId != "") {
                $newConsignmentId = str_pad($getLastId->consignment_id + 1, 6, 0, STR_PAD_LEFT);
            } else {
                $newConsignmentId = str_pad(1, 6, 0, STR_PAD_LEFT);
            }
            $responsedata = Order::create([
                'store_id' => Store::Where('name', $data['Store Name'])->pluck('id')['0'],
                'partner_id' => 1,
                'merchant_id' => $merchant_id ? $merchant_id : null,
                'created_by' => $merchant_id ? $merchant_id : null,
                'consignment_id' => $newConsignmentId,
                'status' => 25,
                'time' => $data['Time'],
                'merchant_order_id' => $data['Merchant Order ID'],
                'payment_status' => $data['Payment Status'],
                'collectable_amount' => $data['Amount to be collect'],
                'delivery_date' => $data['Delivery date'],
                'customer_name' => $data['Customer Name'],
                'customer_mobile' => $data['Customer Mobile'],
                'customer_email' => $data['Customer Email'],
                'customer_address' => $data['Delivery Address'],
                'instruction' => $data['Special Instruction'],
                'partialdelivery' => $data['Partially delivery available'] == 'Yes' ? 1 : 0,
                'district' => $data['District'],
                'upozila' => $data['Upazila'],

                // 'delivery_plan_id' => Plan::Where('name', $data['Delivery Plan'])->where('type', 'delivery')->pluck('id')['0'],
                // 'return_plan_id' => Plan::Where('name', $data['Return Plan'])->where('type', 'return')->pluck('id')['0'],

            ]);
        } elseif ($data['type'] == 'admin') {
            $responsedata = Admin::create([
                'name' => $data['Name'],
                'email' => $data['Email'],
                'phone' => $data['Phone'],
                'username' => $data['Username'],
                'password' => Hash::make($data['Password']),
                'present_address' => $data['Present Address'],
                'permanent_address' => $data['Permanent Address'],
                'facebook' => $data['Facebook'],
                'twitter' => $data['Twitter'],
                'linkedin' => $data['Linkedin'],
                'github' => $data['Github'],
                'status' => $data['Status']
            ]);
        } elseif ($data['type'] == 'merchant') {
            // return $data;
            $responsedata = Merchant::create([
                'partner_id' => '1',
                'name' => $data['Name'],
                'email' => $data['Email'],
                'phone' => $data['Phone'],
                'username' => $data['Username'],
                'password' => Hash::make($data['Password']),
                'address' => $data['Merchant Address'],
                'emargency_contact' => $data['Emergency Contact'],
                'code' => $data['Code']
            ]);

            $lastmerchantid = $responsedata->id;


            MerchantBusiness::create([
                'partner_id' => '1',
                'name' => $data['Business Name'],
                'email' => $data['Business Email'],
                'phone' => $data['Business Contact'],
                'address' => $data['Business Address'],
                'emargency_contact' => $data['Business Emergency contact'],
                'hotline' => $data['Hotline'],
                'facebook' => $data['Facebook'],
                'twitter' => $data['Twitter'],
                'linkedin' => $data['Linkedin'],
                'youtube' => $data['Youtube'],
                'instagram' => $data['Instagram'],
                'merchant_id' =>  $lastmerchantid
            ]);

            MerchantContact::create([
                'partner_id' => '1',
                'name' => $data['Contact Person Name'],
                'email' => $data['Contact Person Email'],
                'phone' => $data['Contact Person Contact'],
                'address' => $data['Contact Person Address'],
                'emargency_contact' => $data['Contact Person Emergency contact'],
                'merchant_id' =>  $lastmerchantid
            ]);
        } elseif ($data['type'] == 'product') {
            if ($data['Merchant Name'] != "") {
                $merchant_id = Merchant::Where('name', $data['Merchant Name'])->first()->id;
            }

            if ($data['Store Name'] != "") {
                $storeId = Store::where('name', $data['Store Name'])->first()->id;
            }

            $responsedata = Product::create([
                'partner_id' => 1,
                'merchant_id' => $merchant_id ? $merchant_id : null,
                'store_id' => $storeId ? $storeId : null,
                'name' => $data['Product Name'],
                'subtitle' => $data['Subtitle'],
                'sku' => $data['SKU'],
                'price' => $data['Price'],
                'status' => $data['Status'] == "Active" ? 1 : 0
            ]);
        } elseif ($data['type'] == 'rider') {
            if ($data['Hub'] != "") {
                $hub_id = Hub::Where('name', $data['Hub'])->first()->id;
            }

            $responsedata = Rider::create([
                'partner_id' => 1,
                'hub_id' => $hub_id ? $hub_id : "",
                'name' => $data['Rider Name'],
                'employee_id' => $data['Employee ID'],
                'email' => $data['Email'],
                'username' => $data['Username'],
                'phone' => $data['Phone'],
                'emargency_contact' => $data['Emargency Contact'],
                'address' => $data['Address'],
                'joining_date' => $data['Joining date'],
                'enroll_date' => $data['Enroll Date'],
                'zone' => $data['Zone'],
                'area' => $data['Area'],
                'password' => Hash::make($data['Password']),
                'status' => $data['Status'] == "Active" ? 1 : 0
            ]);
        } elseif ($data['type'] == 'hub') {
            if ($data['Hub Admin'] != "") {
                $hub_admin_id = Admin::Where('name', $data['Hub Admin'])->first()->id;
            }

            $responsedata = Hub::create([
                'partner_id' => 1,
                'hub_location_id' => 1,
                'name' => $data['Hub Name'],
                'code' => $data['Code'],
                'email' => $data['Email'],
                'username' => $data['Username'],
                'phone' => $data['Phone'],
                'address' => $data['Hub Address'],
                'emargency_contact' => $data['Emargency Contact'],
                'status' => $data['Status'] == "Active" ? 1 : 0,
                'hub_admin_id' => $hub_admin_id ? $hub_admin_id : "",
            ]);
        }


        return $this->successResponse($responsedata, 'Successfully Changed', Response::HTTP_OK);
    }


    public function importMerchant()
    {
        // return Store::Where('name','Dorothy Chavez')->pluck('id')['0'];
        $data = json_decode(file_get_contents('php://input'), true);
        $merchantId = auth('merchant')->id();


        if ($data['type'] == 'order') {
            $getLastId = Order::orderBy('id', 'DESC')->first();
            if ($getLastId != "") {
                $newConsignmentId = str_pad($getLastId->consignment_id + 1, 6, 0, STR_PAD_LEFT);
            } else {
                $newConsignmentId = str_pad(1, 6, 0, STR_PAD_LEFT);
            }
            $responsedata = Order::create([
                'store_id' => Store::Where('name', $data['Store Name'])->pluck('id')['0'],
                'partner_id' => 1,
                'merchant_id' => $merchantId,
                'created_by' => $merchantId,
                'consignment_id' => $newConsignmentId,
                'status' => 25,
                'time' => $data['Time'],
                'merchant_order_id' => $data['Merchant Order ID'],
                'payment_status' => $data['Payment Status'],
                'collectable_amount' => $data['Amount to be collect'],
                'delivery_date' => $data['Delivery date'],
                'customer_name' => $data['Customer Name'],
                'customer_mobile' => $data['Customer Mobile'],
                'customer_email' => $data['Customer Email'],
                'customer_address' => $data['Delivery Address'],
                'instruction' => $data['Special Instruction'],
                'partialdelivery' => $data['Partially delivery available'] == 'Yes' ? 1 : 0,
                'district' => $data['District'],
                'upozila' => $data['Upazila'],

                // 'delivery_plan_id' => Plan::Where('name', $data['Delivery Plan'])->where('type', 'delivery')->pluck('id')['0'],
                // 'return_plan_id' => Plan::Where('name', $data['Return Plan'])->where('type', 'return')->pluck('id')['0'],

            ]);
        } elseif ($data['type'] == 'merchant') {
            $responsedata = Merchant::create([
                'name' => $data['Name'],
                'email' => $data['Email'],
                'phone' => $data['Phone'],
                'username' => $data['Username'],
                'password' => bcrypt($data['Password']),
                'address' => $data['Merchant Address'],
                'emargency_contact' => $data['Emergency contact'],
                'code' => $data['Code']
            ]);

            $lastmerchantid = $responsedata->id;


            MerchantBusiness::create([
                'name' => $data['Business Name'],
                'email' => $data['Business Email'],
                'phone' => $data['Business Contact'],
                'address' => $data['Business Address'],
                'emargency_contact' => $data['Business Emergency contact'],
                'hotline' => $data['Hotline'],
                'facebook' => $data['Facebook'],
                'twitter' => $data['Twitter'],
                'linkedin' => $data['Linkedin'],
                'youtube' => $data['Youtube'],
                'instagram' => $data['Instagram'],
            ]);

            MerchantContact::create([
                'name' => $data['Contact Person Name'],
                'email' => $data['Contact Person Email'],
                'phone' => $data['Contact Person Contact'],
                'address' => $data['Contact Person Address'],
                'emargency_contact' => $data['Contact Person Emergency contact']
            ]);
        } elseif ($data['type'] == 'product') {
            if ($data['Merchant Name'] != "") {
                $merchant_id = Merchant::Where('name', $data['Merchant Name'])->first()->id;
            }

            if ($data['Store Name'] != "") {
                $storeId = Store::where('name', $data['Store Name'])->first()->id;
            }

            $responsedata = Product::create([
                'partner_id' => 1,
                'merchant_id' => $merchant_id ? $merchant_id : null,
                'store_id' => $storeId ? $storeId : null,
                'name' => $data['Product Name'],
                'subtitle' => $data['Subtitle'],
                'sku' => $data['SKU'],
                'price' => $data['Price'],
                'status' => $data['Status'] == "Active" ? 1 : 0
            ]);
        } elseif ($data['type'] == 'rider') {
            if ($data['Hub'] != "") {
                $hub_id = Hub::Where('name', $data['Hub'])->first()->id;
            }

            $responsedata = Rider::create([
                'partner_id' => 1,
                'hub_id' => $hub_id ? $hub_id : "",
                'name' => $data['Rider Name'],
                'employee_id' => $data['Employee ID'],
                'email' => $data['Email'],
                'username' => $data['Username'],
                'phone' => $data['Phone'],
                'emargency_contact' => $data['Emargency Contact'],
                'address' => $data['Address'],
                'joining_date' => $data['Joining date'],
                'enroll_date' => $data['Enroll Date'],
                'zone' => $data['Zone'],
                'area' => $data['Area'],
                'password' => Hash::make($data['Password']),
                'status' => $data['Status'] == "Active" ? 1 : 0
            ]);
        }

        return $this->successResponse($responsedata, 'Successfully Changed', Response::HTTP_OK);
    }






    public function destroy()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        DB::table($data['tablename'])->where('id', $data['id'])->update(['deleted_at' => Carbon::now()]);
        return $this->successResponse($data['id'], 'Successfully Deleted', Response::HTTP_OK);
    }

    public function getMerchantPlan()
    {
        $requestdata = json_decode(file_get_contents('php://input'), true);

        if (count($requestdata) > 0) {
            foreach ($requestdata as $dpdata) {
                $deliveryPlanId[] = $dpdata['plan_id'];
                $merchantIds[] = $dpdata['merchant_id'];
            }
            //$data = Plan::where('type', 'delivery')->whereIn('id', $deliveryPlanId)->orderBy('id', 'DESC')->get();
            // $data .= Plan::where('type', 'delivery')->whereNotIn('id', $deliveryPlanId)->orderBy('id', 'DESC')->get();
            $data = Plan::where('type', 'delivery')->orderBy('id', 'DESC')->get();
        } else {
            $data = Plan::where('type', 'delivery')->orderBy('id', 'DESC')->get();
        }

        return $this->successResponse($data, 'Selected Delivery Plan List', Response::HTTP_OK);
    }


    public function merchantAjaxData()
    {
        $user = Auth::user();
        $roleid = $user->user_type;

        $merchantid = json_decode(file_get_contents('php://input'), true);

        if ($roleid == 29) {
            $hub = Hub::where('hub_admin_id', $user->id)->select("id")->first();
            $data['merchant'] = Merchant::with('deliveryplan', 'returnplan', 'hub:id,name')->whereIn('id', $merchantid)->where('hub_id', '=', $hub->id)->orderBy('id', 'DESC')->get();
        } else {
            $data['merchant'] = Merchant::with('deliveryplan', 'returnplan', 'hub:id,name')->whereIn('id', $merchantid)->orderBy('id', 'DESC')->get();
        }

        foreach ($merchantid as $mid) {
            $deliveryPlanIds = MerchantPlan::select('plan_id')->where('plan_type', 'delivery')->where('merchant_id', $mid)->get();
            $returnPlanIds = MerchantPlan::select('plan_id')->where('plan_type', 'return')->where('merchant_id', $mid)->get();

            $newdeliveryplan[$mid] = Plan::where('type', 'delivery')->whereNotIn('id', $deliveryPlanIds)->where('status', 1)->orderBy('id', 'ASC')->get();
            $newreturnplan[$mid] = Plan::where('type', 'return')->whereNotIn('id', $returnPlanIds)->where('status', 1)->orderBy('id', 'ASC')->get();
        }

        $data['newdeliveryplan'] = $newdeliveryplan;
        $data['newreturnplan'] = $newreturnplan;
        return $this->successResponse($data, 'Selected Merchant List', Response::HTTP_OK);
    }

    // public function getMerchantExistPlan()
    // {
    //     $requestdata = json_decode(file_get_contents('php://input'), true);

    //     $deliveryPlan = MerchantPlan::where('plan_type', 'delivery')->whereIn('merchant_id', $requestdata)->orderBy('id', 'DESC')->get();
    //     $returnPlan = MerchantPlan::where('plan_type', 'return')->whereIn('merchant_id', $requestdata)->orderBy('id', 'DESC')->get();

    //     return $deliveryPlan;

    //     foreach ($requestdata as $dpdata) {
    //         $deliveryPlanId[] = $dpdata['plan_id'];
    //         $merchantIds[] = $dpdata['merchant_id'];
    //     }
    //     //$data = Plan::where('type', 'delivery')->whereIn('id', $deliveryPlanId)->orderBy('id', 'DESC')->get();
    //     // $data .= Plan::where('type', 'delivery')->whereNotIn('id', $deliveryPlanId)->orderBy('id', 'DESC')->get();
    //     $data = Plan::where('type', 'delivery')->orderBy('id', 'DESC')->get();


    //     return $this->successResponse($data, 'Selected Delivery Plan List', Response::HTTP_OK);
    // }


    public function getPlanPrice()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $deliveryDistrictid =  $data['districtid'];
        $deliveryArea =  $data['area'];
        $merchant_id =  $data['merchant_id'];

        list($storeDistrictid, $storeArea) = explode('~', $data['storedata']);

        if ($deliveryDistrictid == $storeDistrictid) {
            if ($deliveryDistrictid == 26) {
                $suburbs = array(2638, 2672, 3330, 6758, 102, 103, 104, 106, 107, 109, 110, 111, 3332, 112, 113, 115);
                if (in_array($deliveryArea, $suburbs) && in_array($storeArea, $suburbs)) {
                    $location = 'Suburbs to Suburbs';
                } elseif (in_array($deliveryArea, $suburbs) && !in_array($storeArea, $suburbs)) {
                    $location = 'Inside Dhaka to Suburbs';
                } elseif (!in_array($deliveryArea, $suburbs) && in_array($storeArea, $suburbs)) {
                    $location = 'Suburbs to Inside Dhaka';
                } else {
                    $location = 'Inside Dhaka';
                }
            } else {
                $location = 'Outside Dhaka Same City';
            }
        } else {
            $location = 'Outside Dhaka';
        }

        $deliveryPlan = MerchantPlan::with('plan:id,percel_type,location,weight,time,charge')
            ->select('plan_id')
            ->where('plan_type', 'delivery')
            ->where('location', $location)
            ->where('merchant_id', $merchant_id)
            ->first();

        $returnPlan = MerchantPlan::with('plan:id,percel_type,location,weight,time,charge')
            ->select('plan_id')
            ->where('plan_type', 'return')
            ->where('location', $location)
            ->where('merchant_id', $merchant_id)
            ->first();

        $responsedata['deliveryPlan'] = $deliveryPlan;
        $responsedata['returnPlan'] = $returnPlan;

        return $this->successResponse($responsedata, 'Get Plan Data', Response::HTTP_OK);
    }






    public function getWeight()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $districtid =  $data['districtid'];
        $weight =  $data['weight'];
        $time =  $data['time'];
        //$totalAmount =  $data['totalAmount'];

        if ($time == 'Same Day Delivery') {
            $weightFlag = 'Same Day Delivery';
        } else {
            if ($districtid == 26) {
                $weightFlag = 'Inside Dhaka';
            } elseif ($districtid != 26) {
                $weightFlag = 'Outside Dhaka';
            }
        }


        $weightDetails = WeightDetail::select('increment_value', 'unit', 'after_weight')->where('plan_type', $weightFlag)->orderBy('id', 'desc')->first();

        if ($weightDetails != "") {
            $incremetnAmount = $weightDetails->increment_value;
            $after_weight = $weightDetails->after_weight;
            $unit = $weightDetails->unit;
            if ($weight > $after_weight) {
                $weights = $weight - $after_weight;
                $weightPrice =  ($unit * $incremetnAmount) * $weights;
            } else {
                $weights = $weight;
                $weightPrice = 0;
            }
        } else {
            $weightPrice = 0;
        }

        //$data = array('weightPrice'=>$weightPrice,'totalCosts'=>$totalAmount + $weightPrice);

        return $this->successResponse($weightPrice, 'Get Plan Data', Response::HTTP_OK);
    }

    public function ajaxCheckValidation()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $values =  $data['values'];
        $field =  $data['field'];
        $tablename =  $data['tablename'];

        $searchresults = DB::table($tablename)->where($field, $values)->count();
        if ($searchresults > 0) {
            echo 0;
        } else {
            echo 1;
        }
    }


    public function deliveryStatus()
    {
        $data = DeliveryStatus::where('type', 'delivery')->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected Delivery Status List', Response::HTTP_OK);
    }

    public function pickupStatus()
    {
        $data = DeliveryStatus::where('type', 'pickup')->orderBy('id', 'DESC')->get();
        return $this->successResponse($data, 'Selected pickup Status List', Response::HTTP_OK);
    }
}
