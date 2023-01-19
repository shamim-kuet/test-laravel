<?php

/** @var \Laravel\Lumen\Routing\Router $router */


$router->group(['prefix' => 'api/frontend', 'namespace' => 'frontend\v1'], function ($router) {

    /** Example resource routes */
    $router->get('example', 'ExampleApiController@index');

    /** Banner api routes */
    $router->get('banners', 'HomeController@banners');

    /** Category related resource routes */
    $router->get('categories', 'CategoryController@index');
    $router->get('sub-categories', 'CategoryController@subCategories');
    $router->get('sub-categories-with-sub-sub-categories', 'CategoryController@subCategoryWithSubSubCategory');
    $router->get('categories-with-sub-categories-with-sub-sub-categories', 'CategoryController@categoryWithSubCategoryWithSubSubCategory');

    /** Product related apis */
    $router->get('products', 'ProductController@index');
    $router->get('recent-arrival-products', 'ProductController@recentArrivalProducts');

    $router->get('/product/{code}/{slug}', 'HomeController@product'); // not yet

    /** Location related apis */
    $router->get('cities', 'LocationController@cities');
    $router->get('states', 'LocationController@states');
    $router->get('countries', 'LocationController@countries');

    $router->get('/division', 'AddressController@division'); // not yet
    $router->get('/district', 'AddressController@district'); // not yet
    $router->get('/area', 'AddressController@area'); // not yet

    $router->post('otp', 'AuthController@Otp'); // not yet
    $router->post('login', 'AuthController@login'); // not yet
    $router->post('profile_update', 'AuthController@profileUpdate'); // not yet

    /** Menu api for all pages */
    $router->get('menus', 'HomeController@menus');

    /* **** Content api for specific page according to menu ******/
    $router->get('/content', 'HomeController@content');

    /* **** Home page content api for homepage page ******/
    $router->get('/homecontent', 'HomeController@homeContents');

    /* **** Category wise prodcut api for homepage ******/
    $router->get('/categoryProducts', 'HomeController@categoryProducts');

    /* **** New order checkout api ******/
    $router->post('/checkout', 'CheckoutController@checkout');

    /* **** Shipping address entry api ******/
    $router->post('/shipping', 'CheckoutController@shipping');

    /* **** Customer order list api ******/
    $router->get('/order-list', 'CheckoutController@orderlist');

    /* **** Order details api with order id inside customer panel ******/
    $router->get('/order_details/{id}', 'CheckoutController@singleOrdeDetails');

    /* **** Order log and order tracking api inside customer panel ******/
    $router->get('/order_log', 'CheckoutController@orderLog');

    $router->get('/address', 'AddressController@index');
    $router->post('/address', 'AddressController@store');
    $router->post('/update_address', 'AddressController@update');
    $router->get('/delete_address', 'AddressController@delete');
});



