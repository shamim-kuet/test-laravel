<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

Route::get('login', 'HomeController@showlogin')->name('login');
Route::post('login', 'HomeController@login');
Route::post('logout', 'HomeController@logout')->name('logout');


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::namespace('Admin')->group(function () {
    //Route::group(['namespace' => 'Admin',  'middleware' => 'guest'], function (){
    //manage user
    Route::prefix('common')->group(function () {
        Route::get('/ajax', 'CommonController@geAjaxData')->name('common.ajax');
        Route::get('/ajaxuser', 'CommonController@geUserData')->name('common.ajaxuser');
        Route::get('/delete', 'CommonController@destroy')->name('common.destroy');
        Route::any('/masterdelete', 'CommonController@deletedata');
        Route::any('/permissions', 'CommonController@permissions');
        Route::get('/changestatus', 'CommonController@changeStatus');
        Route::get('/hubassign', 'CommonController@assignHub');
        Route::post('/changepassword', 'CommonController@changePassword')->name('common.changepassword');
        Route::get('/getorderid', 'CommonController@getOrderId')->name('ajax.orderid');
        Route::get('/getdelivredorderid', 'CommonController@getDeliveredOrderId')->name('ajax.delivredorderid');

        ///////////////// Export/Import/Downlaod ////////////////////////////////////
        Route::get('/print', 'CommonController@prints')->name('common.print');
        Route::get('/export', 'CommonController@export')->name('common.export');
        Route::post('/import', 'CommonController@import')->name('common.import');
        Route::get('/samplefiledownload', 'CommonController@sampleFileDownload')->name('common.samplefiledownload');
        Route::get('/commondownload', 'CommonController@commonDownload')->name('common.commondownload');
    });


    //////////////////// User Informatoion/////////////////////
    Route::resource('user', 'Auth\UserController')->except('update');
    Route::post('user/update/{id}', 'Auth\UserController@update')->name('user.update');
    Route::any('user-filter', 'Auth\UserController@filter')->name('user.filter');

    //////////////////// Partner/Company Information Informatoion/////////////////////
    Route::resource('partner', 'PartnerController')->except('update');
    Route::post('partner/update/{id}', 'PartnerController@update')->name('partner.update');
    Route::any('partner-filter', 'PartnerController@filter')->name('partner.filter');


    //////////////////// Merchant Information Informatoion/////////////////////
    Route::resource('merchant', 'MerchantController')->except('update');
    Route::post('merchant/update/{id}', 'MerchantController@update')->name('merchant.update');
    Route::post('merchant/hubassign', 'MerchantController@hubAssign')->name('merchant.hubassign');
    Route::any('merchant-filter', 'MerchantController@filter')->name('merchant.filter');


    //////////////////// Rider Informatoion/////////////////////
    Route::resource('rider', 'RiderController')->except('update');
    Route::post('rider/update/{id}', 'RiderController@update')->name('rider.update');
    Route::any('rider-filter', 'RiderController@filter')->name('rider.filter');


    //////////////////// Store Informatoion/////////////////////
    Route::resource('store', 'StoreController')->except('update');
    Route::post('store/update/{id}', 'StoreController@update')->name('store.update');
    Route::any('store-filter', 'StoreController@filter')->name('store.filter');

    //////////////////// Hub Location Informatoion/////////////////////
    Route::resource('hublocation', 'HubLocationController')->except('update');
    Route::post('hublocation/update/{id}', 'HubLocationController@update')->name('hublocation.update');
    Route::any('hublocation-filter', 'HubLocationController@filter')->name('hublocation.filter');

    //////////////////// Hub Informatoion/////////////////////
    Route::resource('hub', 'HubController')->except('update');
    Route::post('hub/update/{id}', 'HubController@update')->name('hub.update');
    Route::any('hub-filter', 'HubController@filter')->name('hub.filter');

    //////////////////// Role Group Informatoion/////////////////////
    Route::resource('group', 'GroupController')->except('update');
    Route::post('group/update/{id}', 'GroupController@update')->name('group.update');
    Route::any('group-filter', 'GroupController@filter')->name('group.filter');


    //////////////////// Role Informatoion/////////////////////
    Route::resource('role', 'RoleController')->except('update');
    Route::post('role/update/{id}', 'RoleController@update')->name('role.update');
    Route::any('role-filter', 'RoleController@filter')->name('role.filter');

    //////////////////// Permission Informatoion/////////////////////
    Route::resource('permission', 'PermissionController')->except('update');
    Route::post('permission/update/{id}', 'PermissionController@update')->name('permission.update');
    Route::any('permission-filter', 'PermissionController@filter')->name('permission.filter');

    //////////////////// Role Permission Informatoion/////////////////////
    Route::resource('role-permission', 'RolePermissionController')->except('update');
    Route::post('role-permission/update/{id}', 'RolePermissionController@update')->name('role-permission.update');
    Route::any('role-permission-filter', 'RolePermissionController@filter')->name('role-permission.filter');

    //////////////////// Banner Informatoion/////////////////////
    Route::resource('banner', 'BannerController')->except('update');
    Route::post('banner/update/{id}', 'BannerController@update')->name('banner.update');
    Route::any('banner-filter', 'BannerController@filter')->name('banner.filter');


    //////////////////// Complaint Informatoion/////////////////////
    Route::resource('complaint', 'ComplaintController')->except('update');
    Route::post('complaint/update/{id}', 'ComplaintController@update')->name('complaint.update');
    Route::any('complaint-filter', 'ComplaintController@filter')->name('complaint.filter');

    //////////////////// Product Informatoion/////////////////////
    Route::resource('product', 'ProductController')->except('update');
    Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
    Route::any('product-filter', 'ProductController@filter')->name('product.filter');

    //////////////////// Assign Pickup Informatoion/////////////////////
    Route::resource('plan', 'PlanController')->except('update');
    Route::post('plan/update/{id}', 'PlanController@update')->name('plan.update');
    Route::any('plan-filter', 'PlanController@filter')->name('plan.filter');



    Route::resource('weight_details', 'WeightDetailsController')->except('update');
    Route::post('weight_details/update/{id}', 'WeightDetailsController@update')->name('weight_details.update');
    Route::any('weight_details-filter', 'WeightDetailsController@filter')->name('weight_details.filter');

    //////////////////// Merchant Order Entry Informatoion/////////////////////
    Route::resource('order', 'OrderController')->except('update');
    Route::post('order/update/{id}', 'OrderController@update')->name('order.update');
    Route::any('order-filter', 'OrderController@filter')->name('order.filter');


    //////////////////// Assign Pickup Informatoion/////////////////////
    Route::resource('pickup', 'PickupController')->except('update');
    Route::post('pickup/update/{id}', 'PickupController@update')->name('pickup.update');
    Route::post('pickup/reassign', 'PickupController@reassign')->name('pickup.reassign');
    //Route::get('pickup/reshedule', 'PickupController@reschedule')->name('pickup.reschedule');
    //Route::post('pickup/reshedule', 'PickupController@reschedule')->name('pickup.reschedule');
    Route::any('pickup-filter', 'PickupController@filter')->name('pickup.filter');
    Route::get('pickup/print/{id}', 'PickupController@print')->name('pickup.print');

    Route::get('rider_pickup_report', 'PickupController@riderPickUpReport')->name('rider.pickup.report');
    Route::post('rider_pickup_report-filter', 'PickupController@riderPickUpReportFilter')->name('rider_pickup_report.filter');

    Route::get('rider_delivery_report', 'DeliveryController@riderDeliveryReport')->name('rider.delivery.report');
    Route::post('rider_delivery_report-filter', 'DeliveryController@riderDeliveryReportFilter')->name('rider_delivery_report.filter');

    Route::get('hub_delivery_report', 'DeliveryController@HubDeliveryReport')->name('hub.delivery.report');
    Route::post('hub_delivery_report-filter', 'DeliveryController@HubDeliveryReportFilter')->name('hub_delivery_report.filter');

    //////////////////// Assign delivery hub Informatoion/////////////////////
    Route::resource('deliveryhub', 'DeliveryHubController')->except('update');
    Route::post('deliveryhub/update', 'DeliveryHubController@update')->name('deliveryhub.update');
    Route::post('deliveryhub/reassign', 'DeliveryHubController@reassign')->name('deliveryhub.reassign');
    Route::any('deliveryhub-filter', 'DeliveryHubController@filter')->name('deliveryhub.filter');


    Route::get('rider_report', 'DeliveryController@rider_report')->name('rider_report');
    Route::post('rider_report-filter', 'DeliveryController@rider_reportFilter')->name('rider_report.filter');

    //////////////////// Assign delivery Informatoion/////////////////////
    Route::resource('delivery', 'DeliveryController')->except('update');
    Route::get('deliveryCashRecivedList', 'DeliveryController@deliveryCashRecivedList')->name('deliveryCashRecivedList');
    Route::get('hubAssignedList', 'DeliveryController@hubAssignedList')->name('hubAssignedList');

    Route::any('deliveryCashRecived-filter', 'DeliveryController@deliveryCashRecivedFilter')->name('deliveryCashRecived.filter');
    Route::post('delivery/update', 'DeliveryController@update')->name('delivery.update');
    Route::post('delivery/reassign', 'DeliveryController@reassign')->name('delivery.reassign');
    Route::any('delivery-filter', 'DeliveryController@filter')->name('delivery.filter');

    Route::get('reschedule-delivery', 'RescheduleDeliveryController@create')->name('delivery.reschedule');
    Route::post('reschedule-delivery', 'RescheduleDeliveryController@store')->name('delivery.reschedule');


    Route::resource('cashhandover', 'CashHandoverController')->except('update');
    Route::post('cashhandover/update', 'CashHandoverController@update')->name('cashhandover.update');
    Route::any('cashhandover-filter', 'CashHandoverController@filter')->name('cashhandover.filter');

    Route::get('invoicegenerate', 'InvoiceGenerateController@index')->name('invoicegenerate.index');
    Route::get('invoicegenerate/list', 'InvoiceGenerateController@generatedInvoice')->name('invoicegenerate.list');
    Route::any('invoicegeneratelist-filter', 'InvoiceGenerateController@listFilter')->name('invoicegeneratelist.filter');

    Route::post('invoicegenerate/save', 'InvoiceGenerateController@saveInvoice')->name('invoicegenerate.save');

    Route::get('invoicegenerate/edit/{id}', 'InvoiceGenerateController@edit')->name('invoicegenerate.edit');
    Route::get('invoicegenerate/print/{id}', 'InvoiceGenerateController@print')->name('invoicegenerate.print');
    Route::get('invoicegenerate/store', 'InvoiceGenerateController@store')->name('invoicegenerate.store');
    Route::any('invoicegenerate-filter', 'InvoiceGenerateController@filter')->name('invoicegenerate.filter');

    Route::get('itemizedbill/list', 'ItemizedBillController@ItemizedBill')->name('itemizedbill.list');
    Route::get('itemizedbill/print/{id}', 'ItemizedBillController@print')->name('itemizedbill.print');
    Route::get('billstatement/print/{id}', 'ItemizedBillController@billstatement')->name('billstatement.print');

    Route::resource('merchantpayment', 'MerchantPaymentController')->except('update');
    Route::post('merchantpayment/update', 'MerchantPaymentController@update')->name('merchantpayment.update');
    Route::any('merchantpayment-filter', 'MerchantPaymentController@filter')->name('merchantpayment.filter');

    Route::get('merchantpaymentreport', 'MerchantPaymentReportController@index')->name('merchantpaymentreport.index');
    Route::get('merchantpaymentreport/{id}', 'MerchantPaymentReportController@details')->name('merchantpaymentreport.details');
    Route::get('merchantpaymentreport_all_details', 'MerchantPaymentReportController@allDetails')->name('merchantpaymentreport.allDetails');
    Route::any('merchantpaymentreport-filter', 'MerchantPaymentReportController@filter')->name('merchantpaymentreport.filter');
    Route::any('merchantpaymentreportdetails-filter', 'MerchantPaymentReportController@detailsFilter')->name('merchantpaymentreportdetails.filter');


    //////////////////// Payment Request Informatoion/////////////////////
    Route::resource('paymentrequest', 'PaymentReuestController')->except('update');
    Route::post('paymentrequest/update', 'PaymentReuestController@update')->name('paymentrequest.update');
    Route::any('paymentrequest-filter', 'PaymentReuestController@filter')->name('paymentrequest.filter');

    //////////////////// Document Type Informatoion/////////////////////
    Route::resource('documenttype', 'DocumentTypeController')->except('update');
    Route::post('documenttype/update/{id}', 'DocumentTypeController@update')->name('documenttype.update');
    Route::any('documenttype-filter', 'DocumentTypeController@filter')->name('documenttype.filter');

    //////////////////// Document Type Informatoion/////////////////////
    Route::resource('deliverystatus', 'DeliveryStatusController')->except('update');
    Route::post('deliverystatus/update/{id}', 'DeliveryStatusController@update')->name('deliverystatus.update');
    Route::any('deliverystatus-filter', 'DeliveryStatusController@filter')->name('deliverystatus.filter');

    //////////////////// codcharge Informatoion/////////////////////
    Route::resource('codcharge', 'CodChargeController')->except('update');
    Route::post('codcharge/update/{id}', 'CodChargeController@update')->name('codcharge.update');
    Route::any('codcharge-filter', 'CodChargeController@filter')->name('codcharge.filter');
    Route::get('district', 'DistrictController@index')->name('district.index');
    Route::get('upazilla', 'UpazillaController@index')->name('upazilla.index');
    //////////////////// Suburbs Informatoion/////////////////////
    Route::resource('suburbs', 'SuburbsController')->except('update');
    Route::post('suburbs/update/{id}', 'SuburbsController@update')->name('suburbs.update');


    ///////////////// Document Type Informatoion/////////////////////
    Route::resource('paymentstatus', 'PaymentStatusController')->except('update');
    Route::post('paymentstatus/update/{id}', 'PaymentStatusController@update')->name('paymentstatus.update');
    Route::any('paymentstatus-filter', 'PaymentStatusController@filter')->name('paymentstatus.filter');

    ///////////////// Subscription Type Informatoion/////////////////////
    Route::resource('subscriptiontype', 'PaymentStatusController')->except('update');
    Route::post('subscriptiontype/update/{id}', 'PaymentStatusController@update')->name('subscriptiontype.update');
    Route::any('subscriptiontype-filter', 'PaymentStatusController@filter')->name('subscriptiontype.filter');


    ///////////////// Document Type Informatoion/////////////////////
    Route::resource('generalsetting', 'GeneralSettingController')->except('update');
    Route::post('generalsetting/update/{id}', 'GeneralSettingController@update')->name('generalsetting.update');
    Route::any('generalsetting-filter', 'GeneralSettingController@filter')->name('generalsetting.filter');


    ///////////////// Document Type Informatoion/////////////////////
    Route::resource('vehicletype', 'PaymentStatusController')->except('update');
    Route::post('vehicletype/update/{id}', 'PaymentStatusController@update')->name('vehicletype.update');
    Route::any('vehicletype-filter', 'PaymentStatusController@filter')->name('vehicletype.filter');


    ///////////////// Employee ID Informatoion/////////////////////
    Route::resource('employeeid', 'EmployeeidController')->except('update');
    Route::post('employeeid/update/{id}', 'EmployeeidController@update')->name('employeeid.update');
    Route::any('employeeid-filter', 'EmployeeidController@filter')->name('employeeid.filter');

    ///////////////// Delivery/Pickup Note Informatoion/////////////////////
    Route::resource('deliverynote', 'DeliverynoteController')->except('update');
    Route::post('deliverynote/update/{id}', 'DeliverynoteController@update')->name('deliverynote.update');
    Route::any('deliverynote-filter', 'DeliverynoteController@filter')->name('deliverynote.filter');


    //////////////////// Document Information Informatoion/////////////////////
    Route::resource('document', 'DocumentController')->except('update');
    Route::post('document/update/{id}', 'DocumentController@update')->name('document.update');
    Route::any('document-filter', 'DocumentController@filter')->name('document.filter');

    //Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


    Route::get('getCommonData', 'CommonController@getCommonData')->name('getajaxdata');
    Route::get('getPlanPrice', 'CommonController@getPlanPrice')->name('getPlanPrice');
    Route::get('getWeight', 'CommonController@getWeight')->name('getWeight');

    Route::get('ajaxCheckValidation', 'CommonController@ajaxCheckValidation')->name('ajaxCheckValidation');
});
