<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

///////////////////// Applciation Key generate with random 32 digit. After making it should be add on .env file manually///////////////
$router->get('/key', function () {
    return \Illuminate\Support\Str::random(32);
});

$router->get('/', function () use ($router) {
    return $router->app->version();
});

require __DIR__.'/frontend.php';

$router->group(['prefix' => 'api'], function ($router) {
    $router->post('login', 'AuthController@login');

    $router->post('rider-register', 'RiderAuthController@register');
    $router->post('rider-update-profile', 'RiderAuthController@UpdateProfile');
    $router->post('rider_register_otp', 'RiderAuthController@riderRegisterOtp');
    $router->post('riderlogin', 'RiderAuthController@login');
    $router->post('riderforgetpassword', 'RiderAuthController@forgetpassword');
    $router->post('riderotpverifie', 'RiderAuthController@otpVerifie');
    $router->post('changepassword', 'RiderAuthController@changePassword');

    $router->get('riderhome', 'RiderAuthController@riderHomeInfo');
    $router->get('profile_info', 'RiderAuthController@profileInfo');
    $router->get('myledger', 'RiderAuthController@myLedger');
    $router->get('pickup_note', 'RiderAuthController@pickupNote');
    $router->get('delivery_note', 'RiderAuthController@deliveryNote');


    $router->group(['prefix' => 'merchant', 'namespace' => '\App\Http\Controllers\V1'], function () use ($router) {
        $router->get('district', 'CommonController@district');
        // $router->get('upozila', 'CommonController@upazila');
        $router->get('upozila', 'CommonController@upozila');
    });
});


/////////////////////////// Rider app routes ////////////////////////
/* $router->group(['prefix' => 'api','namespace' => '\App\Http\Controllers\V1','middleware' => 'auth:rider'], function () use ($router) {
    $router->get('pickuplist', 'PickupRiderController@pickuplist');
    $router->get('pickuplist_compleated', 'PickupRiderController@pickuplistcompleated');
    $router->post('pickupUpdate', 'PickupRiderController@pickupUpdate');
    $router->post('pickupUpdateQrCode', 'PickupRiderController@pickupUpdateQrCode');
    $router->post('partialpicked', 'PickupRiderController@partialPicked');
    $router->get('pickupreport', 'PickupRiderController@pickupreport');
    $router->get('deliverylist', 'DeliveryRiderController@deliverylist');
    $router->get('deliverylist_compleated', 'DeliveryRiderController@deliverylistcompleated');
    $router->post('singleOrderUpdate', 'DeliveryRiderController@singleOrderUpdate');
    $router->get('deliveryreport', 'DeliveryRiderController@deliveryreport');
    $router->post('partialdelivery', 'DeliveryRiderController@partialDelivery');
    $router->post('reshedule', 'DeliveryRiderController@reshedule');
    $router->get('common_merchant', 'CommonController@merchantRiderApp');
}); */


/////////////////////////// Merchant routes ////////////////////////

/* $router->group(['prefix' => 'api/merchant'], function () use ($router) {
    $router->post('merchantlogin', 'MerchantAuthController@login');
    $router->post('merchantlogout', 'MerchantAuthController@logout');
});
$router->group(['prefix' => 'api/merchant','namespace' => '\App\Http\Controllers\V1'], function () use ($router) {
    $router->post('signup', 'MerchantController@storeMerchant');
}); */

/* $router->group(['prefix' => 'api/merchant','namespace' => '\App\Http\Controllers\V1','middleware' => 'auth:merchant'], function () use ($router) {
    //////////////// All Cash Handover api routes /////////////////////////////////
	$router->group(['prefix' => 'invoicegenerate'],function() use ($router) {
        $router->get('/generated', 'InvoiceGenerateController@generatedInvoiceMerchant');
        $router->get('/print/{id}', 'InvoiceGenerateController@printInvoice');
	});
    //////////////profile update
    $router->post('/profile_update', 'MerchantController@MerchantProfileUpdate');
    $router->get('/profile_edit/{id}', 'MerchantController@ProfileEdit');
    $router->get('/status_list', 'DeliveryStatusController@index');
    //////////////// All Product api routes /////////////////////////////////
    $router->group(['prefix' => 'product'],function() use ($router) {
        $router->get('/', 'ProductController@indexMerchant');
        $router->post('/store', 'ProductController@store');
        $router->get('/{id}', 'ProductController@showMerchant');
        $router->get('/{id}/edit', 'ProductController@edit');
        $router->post('/update/{id}', 'ProductController@update');
        $router->delete('/{id}', 'ProductController@destroy');
    });
    $router->group(['prefix' => 'order'],function() use ($router) {
		$router->get('/', 'OrderController@indexMerchant');
        $router->get('/parcel_tracking', 'OrderController@parcelTracking');
        $router->get('/delivery_list', 'OrderController@DeliveryList');
        $router->get('/accepted_list', 'OrderController@acceptedList');
        $router->get('/pending_list', 'OrderController@pendingList');
        $router->get('/in_transit_list', 'OrderController@InTransitList');
        $router->get('/delivered_list', 'OrderController@DeliveredList');
        $router->get('/returned_list', 'OrderController@ReturnedList');
        $router->get('/on_hold_list', 'OrderController@OnHoldList');
        $router->get('/common_order_details', 'OrderController@common_order_details');
        $router->post('/order_amount_update', 'OrderController@order_amount_update');
        $router->get('/home', 'OrderController@homeListMerchant');
        $router->get('/homenotify', 'OrderController@homeNotifyMerchant');
        $router->get('/homedeliveryinfo', 'OrderController@homedeliveryinfomerchant');
		$router->post('/store', 'OrderController@store_merchant');
		$router->get('/{id}', 'OrderController@showMerchant');
		$router->get('/{id}/edit', 'OrderController@edit');
		$router->post('/update/{id}', 'OrderController@update');
		$router->delete('/{id}', 'OrderController@destroy');
	});
    $router->get('/pickuplist', 'PickupRiderController@pickuplistMerchant');
	$router->get('/picked_unpicked_pickuplist', 'PickupRiderController@pickedUnpickedPickuplistMerchant');
    $router->group(['prefix' => 'pickup'],function() use ($router) {
		$router->get('/', 'PickupController@indexMerchant');
		$router->get('/newpickup', 'PickupController@newpickup');
		$router->post('/store', 'PickupController@store');
		$router->get('/{id}', 'PickupController@showMerchant');
		$router->get('/{id}/edit', 'PickupController@edit');
		$router->post('/update/{id}', 'PickupController@update');
		$router->delete('/{id}', 'PickupController@destroy');
	});
    $router->group(['prefix' => 'delivery'],function() use ($router) {
		$router->get('/', 'DeliveryController@indexMerchant');
		$router->get('/newdelivery', 'DeliveryController@newdelivery');
		$router->post('/store', 'DeliveryController@store');
		$router->get('/{id}', 'DeliveryController@showMerchant');
		$router->get('/{id}/edit', 'DeliveryController@edit');
		$router->post('/update', 'DeliveryController@update');
		$router->delete('/{id}', 'DeliveryController@destroy');
	});
    $router->group(['prefix' => 'store'],function() use ($router) {
		$router->get('/', 'StoreController@indexMerchant');
		$router->post('/store', 'StoreController@store');
		$router->get('/{id}', 'StoreController@showMerchant');
		$router->get('/{id}/edit', 'StoreController@edit');
		$router->post('/update/{id}', 'StoreController@update');
		$router->delete('/{id}', 'StoreController@destroy');
	});
    $router->group(['prefix' => 'complaint'],function() use ($router) {
		$router->get('/', 'ComplaintController@indexMerchant');
		$router->post('/store', 'ComplaintController@store');
		$router->get('/{id}', 'ComplaintController@showMerchant');
		$router->get('/{id}/edit', 'ComplaintController@edit');
		$router->post('/update/{id}', 'ComplaintController@update');
		$router->delete('/{id}', 'ComplaintController@destroy');
	});
    $router->group(['prefix' => 'merchantpayment_report'],function() use ($router) {
		$router->get('/', 'MerchantPaymentReportController@indexMerchant');
        $router->get('/{id}', 'MerchantPaymentReportController@detailsMerchant');
	});
    $router->get('merchantpayment_report_allDetails', 'MerchantPaymentReportController@allDetailsMerchant');
	$router->post('complaint-filter', 'ComplaintController@merchantFilter');
    $router->post('delivery-filter', 'DeliveryController@merchantFilter');
    $router->post('pickup-filter', 'PickupController@merchantFilter');
    $router->post('order-filter', 'OrderController@merchantFilter');
    $router->post('product-filter', 'ProductController@merchantFilter');
    $router->post('store-filter', 'StoreController@merchantFilter');
    $router->post('merchantpaymentreport-filter', 'MerchantPaymentReportController@merchantFilter');
	$router->post('merchantpaymentreportdetails-filter', 'MerchantPaymentReportController@merchantDetailsFilter');
    $router->get('complaint_puropse', 'ComplaintController@complaintPuropse');
    $router->group(['prefix' => 'districts'],function() use ($router) {
		$router->get('/', 'DistrictsController@index');
	});
    $router->group(['prefix' => 'upazillas'],function() use ($router) {
		$router->get('/', 'UpazillaController@index');
	});
	$router->group(['prefix' => 'common'],function() use ($router) {
		$router->get('planprice', 'CommonController@getPlanPrice');
		$router->get('weightprice', 'CommonController@getWeight');
		$router->get('ajax', 'CommonController@geAjaxData');
        $router->get('store', 'CommonController@storeMerchant');
        $router->get('product', 'CommonController@productMerchant');
        $router->get('delivery-plan', 'CommonController@deliveryPlanMerchant');
		$router->get('return-plan', 'CommonController@returnPlanMerchant');
        $router->get('rider', 'CommonController@riderMerchant');
        $router->get('/export', 'CommonController@exportMerchant');
        $router->post('/import', 'CommonController@importMerchant');
        $router->get('district', 'CommonController@district');
        $router->get('upozila', 'CommonController@upozila');
        $router->get('upazila', 'CommonController@upazila');
        $router->get('ajax-validation', 'CommonController@ajaxCheckValidation');
    });
    $router->group(['prefix' => 'paymentrequest'],function() use ($router) {
		$router->get('/', 'PaymentRequestController@indexMerchant');
		$router->post('/store', 'PaymentRequestController@storeMerchant');
		$router->get('/{id}', 'PaymentRequestController@show');
		$router->get('/{id}/edit', 'PaymentRequestController@edit');
		$router->post('/update', 'PaymentRequestController@update');
		$router->delete('/{id}', 'PaymentRequestController@destroy');
	});
}); */








$router->group(['middleware' => 'auth', 'prefix' => 'api'], function ($router) {
    $router->post('logout', 'AuthController@logout');
    $router->post('refresh', 'AuthController@refresh');
    $router->get('me', 'AuthController@me');
});

$router->group(['prefix' => 'api', 'namespace' => '\App\Http\Controllers\V1',  'middleware' => 'auth'], function () use ($router) {

    //////////////// All User api routes /////////////////////////////////
    $router->group(['prefix' => 'user'], function () use ($router) {
        $router->get('/', 'UserController@index');
        $router->post('/store', 'UserController@store');
        $router->get('/{id}', 'UserController@show');
        $router->get('/{id}/edit', 'UserController@edit');
        $router->put('/update/{id}', 'UserController@update');
        $router->delete('/{id}', 'UserController@destroy');
    });
    $router->group(['prefix' => 'districts'], function () use ($router) {
        $router->get('/', 'DistrictsController@index');
    });
    $router->group(['prefix' => 'upazillas'], function () use ($router) {
        $router->get('/', 'UpazillaController@index');
    });

    //////////////// All Filter routes api routes /////////////////////////////////
    $router->post('admin-filter', 'AdminController@filter');
    $router->post('partner-filter', 'PartnerController@filter');
    $router->post('merchant-filter', 'MerchantController@filter');
    $router->post('role-filter', 'RoleController@filter');
    $router->post('permission-filter', 'PermissionController@filter');
    $router->post('store-filter', 'StoreController@filter');
    $router->post('hublocation-filter', 'HubLocationController@filter');
    $router->post('hub-filter', 'HubController@filter');
    $router->post('rider-filter', 'RiderController@filter');
    $router->post('group-filter', 'GroupController@filter');
    $router->post('product-filter', 'ProductController@filter');
    $router->post('banner-filter', 'BannerController@filter');
    $router->post('complaint-filter', 'ComplaintController@filter');
    $router->post('pickup-filter', 'PickupController@filter');
    $router->post('riderPickUpReport-filter', 'PickupController@riderPickUpReportFilter');
    $router->post('riderDeliveryReport-filter', 'DeliveryController@riderDeliveryReportFilter');
    $router->post('hubDeliveryReport-filter', 'DeliveryController@hubDeliveryReportFilter');
    $router->post('plan-filter', 'PlanController@filter');
    $router->post('documenttype-filter', 'DocumentTypeController@filter');
    $router->post('document-filter', 'DocumentController@filter');
    $router->post('deliverystatus-filter', 'DeliveryStatusController@filter');
    $router->post('codcharge', 'CodChargeController@filter');
    $router->post('paymentstatus-filter', 'PaymentStatusController@filter');
    $router->post('user-filter', 'UserController@filter');
    $router->post('order-filter', 'OrderController@filter');
    $router->post('delivery-filter', 'DeliveryController@filter');
    $router->post('deliveryCashRecived-filter', 'DeliveryController@deliveryCashRecivedFilter');



    $router->post('riderReport-filter', 'DeliveryController@riderReportFilter');
    $router->post('employeeid-filter', 'EmployeeidController@filter');
    $router->post('codcharge-filter', 'CodChargeController@filter');
    $router->post('deliverynote-filter', 'DeliverynoteController@filter');
    $router->post('generalsetting-filter', 'GeneralSettingController@filter');
    $router->post('invoicegenerate-filter', 'InvoiceGenerateController@filter');
    $router->post('invoicegeneratelist-filter', 'InvoiceGenerateController@listFilter');
    $router->post('merchantpaymentreport-filter', 'MerchantPaymentReportController@filter');
    $router->post('merchantpaymentreportdetails-filter', 'MerchantPaymentReportController@detailsFilter');






    //////////////// All Common Data fetch api routes /////////////////////////////////
    $router->group(['prefix' => 'common'], function () use ($router) {

        $router->get('ajax-validation', 'CommonController@ajaxCheckValidation');
        $router->get('planprice', 'CommonController@getPlanPrice');
        $router->get('weightprice', 'CommonController@getWeight');
        $router->get('ajax', 'CommonController@geAjaxData');
        $router->get('ajaxuser', 'CommonController@geUserData');
        $router->get('lastuser', 'CommonController@geLastUserData');
        $router->get('permission', 'CommonController@permission');
        $router->get('merchant', 'CommonController@merchant');
        $router->get('merchantfilter', 'CommonController@merchantFilter');
        $router->get('merchantAjax', 'CommonController@merchantAjaxData');
        $router->get('hub', 'CommonController@hub');
        $router->get('role', 'CommonController@role');
        $router->get('rider', 'CommonController@rider');
        $router->get('hub', 'CommonController@hub');
        $router->get('store', 'CommonController@store');
        $router->get('admin', 'CommonController@admin');
        $router->get('product', 'CommonController@product');
        $router->get('document-type', 'CommonController@documentType');
        $router->get('merchant-delivery-plan', 'CommonController@getMerchantPlan');
        $router->get('delivery-plan', 'CommonController@deliveryPlan');
        $router->get('return-plan', 'CommonController@returnPlan');
        $router->get('getdeliverylist', 'CommonController@getDeliveryList');
        $router->get('getorderlist', 'CommonController@getOrderId');
        $router->get('getdeliveredorderlist', 'CommonController@getDeliveredOrderId');
        $router->get('cod', 'CommonController@cod');
        $router->get('codlist', 'CommonController@codlist');

        $router->get('district', 'CommonController@district');
        $router->get('upozila', 'CommonController@upazila');

        $router->get('suburban', 'CommonController@suburban');


        $router->get('delivery-status', 'CommonController@deliveryStatus');
        $router->get('pickup-status', 'CommonController@pickupStatus');


        //$router->get('merchant-exist-delivery-plan', 'CommonController@getMerchantExistPlan');


        $router->post('changepassword', 'CommonController@changePassword');

        $router->get('/export', 'CommonController@export');
        $router->post('/import', 'CommonController@import');
        $router->get('/delete', 'CommonController@destroy');
    });


    //////////////// All Admin api routes /////////////////////////////////
    $router->group(['prefix' => 'admin'], function () use ($router) {
        $router->get('/', 'AdminController@index');
        $router->post('/store', 'AdminController@store');
        $router->get('/{id}', 'AdminController@show');
        $router->get('/{id}/edit', 'AdminController@edit');
        $router->post('/update/{id}', 'AdminController@update');
        $router->delete('/{id}', 'AdminController@destroy');
    });

    //////////////// All Partner api routes /////////////////////////////////
    $router->group(['prefix' => 'partner'], function () use ($router) {
        $router->get('/', 'PartnerController@index');
        $router->post('/store', 'PartnerController@store');
        $router->get('/{id}', 'PartnerController@show');
        $router->get('/{id}/edit', 'PartnerController@edit');
        $router->post('/update/{id}', 'PartnerController@update');
        $router->delete('/{id}', 'PartnerController@destroy');
    });


    //////////////// All Merchant api routes /////////////////////////////////
    $router->group(['prefix' => 'merchant'], function () use ($router) {
        $router->get('/', 'MerchantController@index');
        $router->post('/store', 'MerchantController@store');
        $router->get('/{id}', 'MerchantController@show');
        $router->get('/{id}/edit', 'MerchantController@edit');
        $router->post('/update/{id}', 'MerchantController@update');
        $router->post('/hubassign', 'MerchantController@hubAssign');
        $router->delete('/{id}', 'MerchantController@destroy');
    });


    //////////////// All Rider api routes /////////////////////////////////
    $router->group(['prefix' => 'rider'], function () use ($router) {
        $router->get('/', 'RiderController@index');
        $router->post('/store', 'RiderController@store');
        $router->get('/{id}', 'RiderController@show');
        $router->get('/{id}/edit', 'RiderController@edit');
        $router->post('/update/{id}', 'RiderController@update');
        $router->delete('/{id}', 'RiderController@destroy');
    });


    //////////////// All Hub Location api routes /////////////////////////////////
    $router->group(['prefix' => 'hublocation'], function () use ($router) {
        $router->get('/', 'HubLocationController@index');
        $router->post('/store', 'HubLocationController@store');
        $router->get('/{id}', 'HubLocationController@show');
        $router->get('/{id}/edit', 'HubLocationController@edit');
        $router->post('/update/{id}', 'HubLocationController@update');
        $router->delete('/{id}', 'HubLocationController@destroy');
    });


    //////////////// All Hub api routes /////////////////////////////////
    $router->group(['prefix' => 'hub'], function () use ($router) {
        $router->get('/', 'HubController@index');
        $router->post('/store', 'HubController@store');
        $router->get('/{id}', 'HubController@show');
        $router->get('/{id}/edit', 'HubController@edit');
        $router->post('/update/{id}', 'HubController@update');
        $router->delete('/{id}', 'HubController@destroy');
    });


    //////////////// All Store api routes /////////////////////////////////
    $router->group(['prefix' => 'store'], function () use ($router) {
        $router->get('/', 'StoreController@index');
        $router->post('/store', 'StoreController@store');
        $router->get('/{id}', 'StoreController@show');
        $router->get('/{id}/edit', 'StoreController@edit');
        $router->post('/update/{id}', 'StoreController@update');
        $router->delete('/{id}', 'StoreController@destroy');
    });


    //////////////// All Role Group api routes /////////////////////////////////
    $router->group(['prefix' => 'group'], function () use ($router) {
        $router->get('/', 'GroupController@index');
        $router->get('/permission', 'GroupController@groupWithPermission');
        $router->post('/store', 'GroupController@store');
        $router->get('/{id}', 'GroupController@show');
        $router->get('/{id}/edit', 'GroupController@edit');
        $router->post('/update/{id}', 'GroupController@update');
        $router->delete('/{id}', 'GroupController@destroy');
    });


    //////////////// All Role api routes /////////////////////////////////
    $router->group(['prefix' => 'role'], function () use ($router) {
        $router->get('/', 'RoleController@index');
        $router->post('/store', 'RoleController@store');
        $router->get('/{id}', 'RoleController@show');
        $router->get('/{id}/edit', 'RoleController@edit');
        $router->post('/update/{id}', 'RoleController@update');
        $router->delete('/{id}', 'RoleController@destroy');
    });


    //////////////// All Permission api routes /////////////////////////////////
    $router->group(['prefix' => 'permission'], function () use ($router) {
        $router->get('/', 'PermissionController@index');
        $router->post('/store', 'PermissionController@store');
        $router->get('/{id}', 'PermissionController@show');
        $router->get('/{id}/edit', 'PermissionController@edit');
        $router->post('/update/{id}', 'PermissionController@update');
        $router->delete('/{id}', 'PermissionController@destroy');
    });
    //////////////All role Permission api routes////////////////////////////////////
    $router->group(['prefix' => 'role-permission'], function () use ($router) {
        $router->get('/', 'RoleHasPermissionController@index');
        $router->post('/store', 'RoleHasPermissionController@store');
        $router->post('/update/{id}', 'RoleHasPermissionController@update');
        $router->delete('/{id}', 'RoleHasPermissionController@destroy');
        $router->get('/permission/{id}', 'RoleHasPermissionController@permissions');
    });
    //////////////All role Permission api routes////////////////////////////////////

    //////////////// All Banner api routes /////////////////////////////////
    $router->group(['prefix' => 'banner'], function () use ($router) {
        $router->get('/', 'BannerController@index');
        $router->post('/store', 'BannerController@store');
        $router->get('/{id}', 'BannerController@show');
        $router->get('/{id}/edit', 'BannerController@edit');
        $router->post('/update/{id}', 'BannerController@update');
        $router->delete('/{id}', 'BannerController@destroy');
    });


    //////////////// All Complaint api routes /////////////////////////////////
    $router->group(['prefix' => 'complaint'], function () use ($router) {
        $router->get('/', 'ComplaintController@index');
        $router->post('/store', 'ComplaintController@store');
        $router->get('/{id}', 'ComplaintController@show');
        $router->get('/{id}/edit', 'ComplaintController@edit');
        $router->post('/update/{id}', 'ComplaintController@update');
        $router->delete('/{id}', 'ComplaintController@destroy');
    });
    $router->get('complaint_puropses', 'ComplaintController@complaintPuropse');


    //////////////// All Product api routes /////////////////////////////////
    $router->group(['prefix' => 'product'], function () use ($router) {
        $router->get('/', 'ProductController@index');
        $router->post('/store', 'ProductController@store');
        $router->get('/{id}', 'ProductController@show');
        $router->get('/{id}/edit', 'ProductController@edit');
        $router->post('/update/{id}', 'ProductController@update');
        $router->delete('/{id}', 'ProductController@destroy');
    });


    //////////////// All Plan api routes /////////////////////////////////
    $router->group(['prefix' => 'plan'], function () use ($router) {
        $router->get('/', 'PlanController@index');
        $router->post('/store', 'PlanController@store');
        $router->get('/{id}', 'PlanController@show');
        $router->get('/{id}/edit', 'PlanController@edit');
        $router->post('/update/{id}', 'PlanController@update');
        $router->delete('/{id}', 'PlanController@destroy');
    });

    //////////////// All Plan api routes /////////////////////////////////
    $router->group(['prefix' => 'weight_details'], function () use ($router) {
        $router->get('/', 'WeightDetailsController@index');
        $router->post('/store', 'WeightDetailsController@store');
        $router->get('/{id}', 'WeightDetailsController@show');
        $router->get('/{id}/edit', 'WeightDetailsController@edit');
        $router->post('/update/{id}', 'WeightDetailsController@update');
        $router->delete('/{id}', 'WeightDetailsController@destroy');
    });

    //////////////// All Product api routes /////////////////////////////////
    $router->group(['prefix' => 'order'], function () use ($router) {
        $router->get('/', 'OrderController@index');
        $router->get('/homedeliveryinfo', 'OrderController@homedeliveryinfo');
        $router->get('/home', 'OrderController@homeList');
        $router->get('/homenotify', 'OrderController@homeNotification');
        $router->post('/store', 'OrderController@store');
        $router->get('/{id}', 'OrderController@show');
        $router->get('/{id}/edit', 'OrderController@edit');
        $router->post('/update/{id}', 'OrderController@update');
        $router->delete('/{id}', 'OrderController@destroy');
    });
    //////////////// All Pickup api routes /////////////////////////////////
    $router->group(['prefix' => 'pickup'], function () use ($router) {
        $router->get('/', 'PickupController@index');
        $router->get('/newpickup', 'PickupController@newpickup');
        $router->post('/store', 'PickupController@store');
        $router->get('/{id}', 'PickupController@show');
        $router->get('/edit/{id}', 'PickupController@edit');
        $router->post('/update/{id}', 'PickupController@update');
        $router->delete('/{id}', 'PickupController@destroy');
        $router->get('/print/{id}', 'PickupController@printInvoice');
        $router->post('/reassign', 'PickupController@reassign');
    });


    $router->get('riderPickUpReport', 'PickupController@riderPickUpReport');
    $router->get('riderDeliveryReport', 'DeliveryController@riderDeliveryReport');
    $router->get('hubDeliveryReport', 'DeliveryController@hubDeliveryReport');

    //////////////// All delivery api routes /////////////////////////////////
    $router->group(['prefix' => 'delivery'], function () use ($router) {
        $router->get('/', 'DeliveryController@index');
        $router->get('/deliveryCashRecivedList', 'DeliveryController@deliveryCashRecivedList');
        $router->get('/hubAssignedList', 'DeliveryController@hubAssignedList');

        $router->get('/newdelivery', 'DeliveryController@newdelivery');
        $router->post('/store', 'DeliveryController@store');
        $router->get('/{id}', 'DeliveryController@show');
        $router->get('/{id}/edit', 'DeliveryController@edit');
        $router->post('/update', 'DeliveryController@update');
        $router->delete('/{id}', 'DeliveryController@destroy');
        $router->post('/reassign', 'DeliveryController@reassign');
    });

    $router->get('rider_report', 'DeliveryController@rider_report');

    //////////////// All delivery hub api routes /////////////////////////////////
    $router->group(['prefix' => 'deliveryhub'], function () use ($router) {
        $router->get('/', 'DeliveryHubController@index');
        $router->get('/newdelivery', 'DeliveryHubController@newdelivery');
        $router->post('/store', 'DeliveryHubController@store');
        $router->get('/{id}', 'DeliveryHubController@show');
        $router->get('/{id}/edit', 'DeliveryHubController@edit');
        $router->post('/update', 'DeliveryHubController@update');
        $router->delete('/{id}', 'DeliveryHubController@destroy');
        $router->post('/reassign', 'DeliveryHubController@reassign');
    });


    //////////////// All document api routes /////////////////////////////////
    $router->group(['prefix' => 'document'], function () use ($router) {
        $router->get('/', 'DocumentController@index');
        $router->post('/store', 'DocumentController@store');
        $router->get('/{id}', 'DocumentController@show');
        $router->get('/{id}/edit', 'DocumentController@edit');
        $router->post('/update', 'DocumentController@update');
        $router->delete('/{id}', 'DocumentController@destroy');
    });


    //////////////// All reshedule delivery api routes /////////////////////////////////
    $router->group(['prefix' => 'reshedule-delivery'], function () use ($router) {
        $router->get('/', 'ResheduleDeliveryController@index');
        $router->post('/store', 'ResheduleDeliveryController@store');
        $router->get('/{id}/edit', 'ResheduleDeliveryController@edit');
        $router->post('/update', 'ResheduleDeliveryController@update');
    });


    //////////////// All Cash Handover api routes /////////////////////////////////
    $router->group(['prefix' => 'cashhandover'], function () use ($router) {
        $router->get('/', 'CashHandoverController@index');
        $router->post('/store', 'CashHandoverController@store');
        $router->get('/{id}', 'CashHandoverController@show');
        $router->get('/{id}/edit', 'CashHandoverController@edit');
        $router->post('/update', 'CashHandoverController@update');
        $router->delete('/{id}', 'CashHandoverController@destroy');
    });

    //////////////// All Cash Handover api routes /////////////////////////////////
    $router->group(['prefix' => 'invoicegenerate'], function () use ($router) {
        $router->get('/', 'InvoiceGenerateController@index');
        $router->get('/generated', 'InvoiceGenerateController@generatedInvoice');
        $router->get('/edit/{id}', 'InvoiceGenerateController@editInvoice');
        $router->get('/print/{id}', 'InvoiceGenerateController@printInvoice');
        $router->get('/itemizedbill/{id}', 'InvoiceGenerateController@itemizedBill');
        $router->get('/billstatement/{id}', 'InvoiceGenerateController@billstatement');
        $router->get('/store', 'InvoiceGenerateController@store');
        $router->get('/save', 'InvoiceGenerateController@save');
    });


    //////////////// All Cash Handover api routes /////////////////////////////////
    $router->group(['prefix' => 'merchantpayment'], function () use ($router) {
        $router->get('/', 'MerchantPaymentController@index');
        $router->post('/store', 'MerchantPaymentController@store');
        $router->get('/{id}', 'MerchantPaymentController@show');
        $router->get('/{id}/edit', 'MerchantPaymentController@edit');
        $router->post('/update', 'MerchantPaymentController@update');
        $router->delete('/{id}', 'MerchantPaymentController@destroy');
    });

    $router->group(['prefix' => 'merchantpayment_report'], function () use ($router) {
        $router->get('/', 'MerchantPaymentReportController@index');
        $router->get('/{id}', 'MerchantPaymentReportController@details');
    });
    $router->get('merchantpayment_report_allDetails', 'MerchantPaymentReportController@allDetails');

    //////////////// All Cash Handover api routes /////////////////////////////////
    $router->group(['prefix' => 'paymentrequest'], function () use ($router) {
        $router->get('/', 'PaymentRequestController@index');
        $router->post('/store', 'PaymentRequestController@store');
        $router->get('/{id}', 'PaymentRequestController@show');
        $router->get('/{id}/edit', 'PaymentRequestController@edit');
        $router->post('/update', 'PaymentRequestController@update');
        $router->delete('/{id}', 'PaymentRequestController@destroy');
    });




    //////////////// All Hub Location api routes /////////////////////////////////
    $router->group(['prefix' => 'documenttype'], function () use ($router) {
        $router->get('/', 'DocumentTypeController@index');
        $router->post('/store', 'DocumentTypeController@store');
        $router->get('/{id}', 'DocumentTypeController@show');
        $router->get('/{id}/edit', 'DocumentTypeController@edit');
        $router->post('/update/{id}', 'DocumentTypeController@update');
        $router->delete('/{id}', 'DocumentTypeController@destroy');
    });




    //////////////// All Delivery Status api routes /////////////////////////////////
    $router->group(['prefix' => 'deliverystatus'], function () use ($router) {
        $router->get('/', 'DeliveryStatusController@index');
        $router->post('/store', 'DeliveryStatusController@store');
        $router->get('/{id}', 'DeliveryStatusController@show');
        $router->get('/{id}/edit', 'DeliveryStatusController@edit');
        $router->post('/update/{id}', 'DeliveryStatusController@update');
        $router->delete('/{id}', 'DeliveryStatusController@destroy');
    });
    $router->group(['prefix' => 'codcharge'], function () use ($router) {
        $router->get('/', 'CodChargeController@index');
        $router->post('/store', 'CodChargeController@store');
        $router->get('/{id}', 'CodChargeController@show');
        $router->get('/{id}/edit', 'CodChargeController@edit');
        $router->post('/update/{id}', 'CodChargeController@update');
        $router->delete('/{id}', 'CodChargeController@destroy');
    });

    ///////////////////suburbs routes//////////////////

    $router->group(['prefix' => 'suburbs'], function () use ($router) {
        $router->get('/', 'SuburbsController@index');
        $router->post('/store', 'SuburbsController@store');
        $router->get('/{id}', 'SuburbsController@show');
        $router->get('/{id}/edit', 'SuburbsController@edit');
        $router->post('/update/{id}', 'SuburbsController@update');
    });


    //////////////// All Payment Status api routes /////////////////////////////////
    $router->group(['prefix' => 'paymentstatus'], function () use ($router) {
        $router->get('/', 'PaymentStatusController@index');
        $router->post('/store', 'PaymentStatusController@store');
        $router->get('/{id}', 'PaymentStatusController@show');
        $router->get('/{id}/edit', 'PaymentStatusController@edit');
        $router->post('/update/{id}', 'PaymentStatusController@update');
        $router->delete('/{id}', 'PaymentStatusController@destroy');
    });

    //////////////// All Vehicle Type api routes /////////////////////////////////
    $router->group(['prefix' => 'subscriptiontype'], function () use ($router) {
        $router->get('/', 'SubscriptionTypeController@index');
        $router->post('/store', 'SubscriptionTypeController@store');
        $router->get('/{id}', 'SubscriptionTypeController@show');
        $router->get('/{id}/edit', 'SubscriptionTypeController@edit');
        $router->post('/update/{id}', 'SubscriptionTypeController@update');
        $router->delete('/{id}', 'SubscriptionTypeController@destroy');
    });


    //////////////// All Vehicle Type api routes /////////////////////////////////
    $router->group(['prefix' => 'generalsetting'], function () use ($router) {
        $router->get('/', 'GeneralSettingController@index');
        $router->post('/store', 'GeneralSettingController@store');
        $router->get('/{id}', 'GeneralSettingController@show');
        $router->get('/{id}/edit', 'GeneralSettingController@edit');
        $router->post('/update/{id}', 'GeneralSettingController@update');
        $router->delete('/{id}', 'GeneralSettingController@destroy');
    });


    //////////////// All Vehicle Type api routes /////////////////////////////////
    $router->group(['prefix' => 'vehicletype'], function () use ($router) {
        $router->get('/', 'VehicleTypeController@index');
        $router->post('/store', 'VehicleTypeController@store');
        $router->get('/{id}', 'VehicleTypeController@show');
        $router->get('/{id}/edit', 'VehicleTypeController@edit');
        $router->post('/update/{id}', 'VehicleTypeController@update');
        $router->delete('/{id}', 'VehicleTypeController@destroy');
    });


    //////////////// All Employeeid type api routes /////////////////////////////////
    $router->group(['prefix' => 'employeeid'], function () use ($router) {
        $router->get('/', 'EmployeeidController@index');
        $router->post('/store', 'EmployeeidController@store');
        $router->get('/{id}', 'EmployeeidController@show');
        $router->get('/{id}/edit', 'EmployeeidController@edit');
        $router->post('/update/{id}', 'EmployeeidController@update');
        $router->delete('/{id}', 'EmployeeidController@destroy');
    });


    //////////////// All Delivery Note api routes /////////////////////////////////
    $router->group(['prefix' => 'deliverynote'], function () use ($router) {
        $router->get('/', 'DeliverynoteController@index');
        $router->post('/store', 'DeliverynoteController@store');
        $router->get('/{id}', 'DeliverynoteController@show');
        $router->get('/{id}/edit', 'DeliverynoteController@edit');
        $router->post('/update/{id}', 'DeliverynoteController@update');
        $router->delete('/{id}', 'DeliverynoteController@destroy');
    });
});
