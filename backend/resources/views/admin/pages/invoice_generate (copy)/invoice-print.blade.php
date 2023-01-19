<!DOCTYPE html>
<html lang="en">

<head>
    <link href="{{ $setting ? $setting->default_url : '' }}assets/css/print_style.css" rel="stylesheet" />
    <link rel="apple-touch-icon" href="{{ $setting ? $setting->default_url : '' }}app-assets/images/ico/favicon.ico">
    <link rel="shortcut icon" type="image/x-icon" href="{{ $setting ? $setting->default_url : '' }}app-assets/images/ico/favicon.ico">
    <meta charset="utf-8" />

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}assets/css/paper.css" />
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}assets/css/normalize.css" />

    <!-- Set page size here: A5, A4 or A3 -->
    <!-- Set also "landscape" if you need -->
    <style>
        @page {
            size: A4 portrait;
            margin-top: 8px;
            margin-bottom: 10px;
            margin-left: 20px;
        }

    </style>
    <style>
        /* Three image containers (use 25% for four, and 50% for two, etc) */
        .column {
            float: left;
            padding: 5px;
        }

        /* Clear floats after image containers */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        table tbody tr td {
            padding: 2px !important;
            line-height: 1.35 !important;
            border-top: 1px solid #1c1c1b;
        }

        .heading_invoice {
            display: block;
            text-align: center;
            background: #d9e1f2;
            width: 275px;
            padding: 5px;
            margin: auto;
            font-weight: 600;
            margin-top: 10px;
        }

        @media print {
            .box-body {
                margin-top: 10px !important;
                margin-bottom: 10px;
            }
        }

    </style>

    <script>
        /*window.onload = function () {
                          window.print();
                           window.top.close();

                        }*/
    </script>
    <style>
        .center-me {
            font-size: 15px;
            margin: auto;
            height: 10px;
            max-width: 500px;
            margin: 75px auto 40px auto;
            display: flex;
        }

    </style>
</head>
<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4 portrait">
    <!-- Each sheet element should have the class "sheet" -->
    <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
    <section class="sheet" id="content-print">
        <style>
            table {
                /*border-collapse: unset !important;*/
            }

        </style>

        <div class="box-body" id="box_data" style="display: flex; padding: 5px 10px 0 10px; margin-bottom: -21px;">
            <div style="width: 100%; padding-right: 10px;" class="col-md-12">
                <div class="row">
                    <div class="col-lg-12" style="width: 100%;">
                        <img src="{{ $setting ? $setting->default_url : '' }}images/logo.png" alt="logo"
                            style="display: block; margin: auto;" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12" style="width: 100%;">
                        <span class="heading_invoice">Invoice</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 25px; align-items: center;">
                    <div class="col-lg-4" style="width: 40%;">
                        <table border="1" style="width: 85%;">
                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant ID</th>
                                <td style="font-size: 12px;">{{ $data->order->merchant_id }}</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant Name</th>
                                <td style="font-size: 12px;">Provati Courier Ltd</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-8" style="width: 60%;">
                        <table border="1" style="width: 85%; margin-left: auto;">
                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Invoice No.</th>
                                <td style="font-size: 12px;">{{ $data->invoice_no }}</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Invoice Date</th>
                                <td style="font-size: 12px;">{{ \Utility::commonDateFormate($data->invoice_date) }}</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Attempt</th>
                                <td style="font-size: 12px;">{{ $data->print_attempt }}</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Prepared By</th>
                                <td style="font-size: 12px;">{{ $data->created_by }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br />

                <table width="50%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="border-top: 0px;">
                            <table width="100%" border="1">
                                <tr style="background: rgba(217, 225, 242, 1);">
                                    <th class="text-center" colspan="2" style="width: 25%;">Delivery Information</th>
                                </tr>

                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">
                                        Consignment ID</th>
                                    <th>{{ $data->order->consignment_id }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Merchant
                                        Order ID</th>
                                    <th>{{ $data->order->merchant_order_id }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Invoice
                                        Amount</th>
                                    <th>{{ $data->order->collectable_amount }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Delivery
                                        Charge</th>
                                    <th>{{ $data->order->plan->charge }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Order
                                        Date</th>
                                    <th>{{ \Utility::commonDateFormate($data->order->created_at) }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Delivery
                                        Date</th>
                                    <th></th>
                                </tr>
                            </table>
                        </td>

                        <td style="border-top: 0px;">
                            <table width="100%" border="1">
                                <tr style="background: rgba(217, 225, 242, 1);">
                                    <th class="text-center" colspan="2" style="width: 25%;">Shipping Information</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Consumer
                                        Name</th>
                                    <th>{{ $data->order->customer_name }}</th>
                                </tr>

                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Address
                                    </th>
                                    <th>{{ $data->order->customer_address }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">
                                        Zone/City</th>
                                    <th>{{ $data->order->customer_zone }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Mobile
                                    </th>
                                    <th>{{ $data->order->customer_mobile }}</th>
                                </tr>
                                <tr>
                                    <th style="width: 5%; font-size: 12px; background: rgba(217, 225, 242, 1);">Email
                                        Address</th>
                                    <th>{{ $data->order->customer_email }}</th>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <br />
                @if (!empty($data->order->order_product))
                    <table width="100%" border="1px">
                        <tr style="background: rgba(217, 225, 242, 1);">
                            <th class="text-center">#</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total Amount</th>
                        </tr>
                        @php
                            $t_price = 0;
                            $t_quantity = 0;
                            $t_amount = 0;

                        @endphp



                        <tbody>
                            @foreach ($data->order->order_product as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->product->name }}</td>
                                    <td>{{ $product->product->sku }}</td>
                                    <td>{{ $product->product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->product->price * $product->quantity }}</td>
                                    @php
                                        $t_price += $product->product->price;
                                        $t_quantity += $product->quantity;
                                        $t_amount += $product->product->price * $product->quantity;
                                    @endphp
                                </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr style="background: rgba(217, 225, 242, 1);">
                                <td colspan="3" align="right" style="text-align: right;">Grand Total</td>
                                <td>{{ $t_price }}</td>
                                <td>{{ $t_quantity }}</td>
                                <td>{{ $t_amount }}</td>
                            </tr>
                        </tfoot>

                    </table>
                @endif
                <br />
                <table width="94%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="20%" valign="top">
                            <h6 style="margin-bottom: 0;">
                                <span
                                    style="text-decoration: dashed; padding-left: 100%; color: #000; border-bottom: 1px solid black;"></span>
                            </h6>
                            <h6 class="text-center" style="margin-top: 5px;">Signature and Seal</h6>
                        </td>
                        <td width="60%" valign="top">&nbsp;</td>
                        <td width="20%" valign="top">
                            <h6 style="margin-bottom: 0;">
                                <span
                                    style="text-decoration: dashed; padding-left: 100%; color: #000; border-bottom: 1px solid black;"></span>
                            </h6>
                            <h6 class="text-center" style="margin-top: 5px;">Signature and Seal</h6>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</body>

</html>
