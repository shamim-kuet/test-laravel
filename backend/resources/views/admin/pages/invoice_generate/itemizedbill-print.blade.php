<!DOCTYPE html>
<html lang="en">

<head>
    <link href="print_style.css" rel="stylesheet" />
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
            padding: 5px 2px !important;
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

        table,
        th,
        td {
            font-size: 10px;
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
                        <img src="{{ $setting ? $setting->default_url : '' }}images/logo.png" alt="logo" style="display: block; margin: auto;" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12" style="width: 100%;">
                        <span class="heading_invoice">Itemized Bill</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 25px; align-items: center;">
                    <div class="col-lg-4" style="width: 40%;">
                        <table border="1" style="width: 85%;">
                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant ID</th>
                                <td style="font-size: 12px; text-align: center; font-weight: 700;">{{ $merchant->code }}</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant Name</th>
                                <td style="font-size: 12px; text-align: center; font-weight: 700;">{{ $merchant->name }}
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-8" style="width: 60%;">
                        <table border="1" style="width: 85%; margin-left: auto;">
                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Reference</th>
                                <td style="font-size: 12px; text-align: center; font-weight: 700;">
                                    02-03-2022-M-1-6720-201</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Date</th>
                                <td style="font-size: 12px; text-align: center; font-weight: 700;">02 March, 2022</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Period</th>
                                <td style="font-size: 12px; text-align: center; font-weight: 700;">01 March, 2022 to 01
                                    March, 2022</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Prepared By
                                </th>
                                <td style="font-size: 12px; text-align: center; font-weight: 700;">Sheikh Muntasir Safa
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br />

                <table width="100%" border="1">
                    <tr style="background: #d9e1f2;">
                        <th style="text-align: center;">SL No</th>
                        <th style="text-align: left;">Order ID</th>
                        <th style="text-align: left;">Merchant Ref</th>
                        <th style="text-align: left;">Pack Opt</th>
                        <th style="text-align: left;">Del. Opt</th>
                        <th style="text-align: center;">Price</th>
                        <th style="text-align: center;">Collection</th>
                        <th style="text-align: left;">Cust Dist</th>
                        <th style="text-align: center;">Charges</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: left;">Comment</th>
                    </tr>
                    @foreach ($data as $order)


                    <tr>
                        <td style="text-align: center;">{{ $loop->iteration }}</td>
                        <td style="text-align: left;">{{ $order->id }}</td>
                        <td style="text-align: left;">{{ $order->merchant_order_id }}</td>
                        <td style="text-align: left;"></td>
                        <td style="text-align: left;"></td>
                        <td style="text-align: right;">{{ $order->collectable_amount }}</td>
                        <td style="text-align: right;"></td>
                        <td style="text-align: left;"></td>
                        <td style="text-align: right;">{{ $order->plan->charge }}</td>
                        <td style="text-align: center;">{{ $order->status }}</td>
                        <td style="text-align: left;">{{ $order->delivery_note }}</td>
                    </tr>
                    @endforeach
                    {{-- <tr>
                        <td style="text-align: right;">2</td>
                        <td style="text-align: left;">090222-8843-A1-G1</td>
                        <td style="text-align: left;">9777</td>
                        <td style="text-align: left;">standard</td>
                        <td style="text-align: left;">regular</td>
                        <td style="text-align: right;">700</td>
                        <td style="text-align: right;">0</td>
                        <td style="text-align: left;">Narayanganj</td>
                        <td style="text-align: right;">0</td>
                        <td style="text-align: center;">Return</td>
                        <td style="text-align: left;">ভুল পণ্য ছিল</td>
                    </tr> --}}
                </table>

                <br />

                <table width="94%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td valign="top" style="width: 20%;">
                            <h6 style="margin-bottom: 0;">
                                <span
                                    style="text-decoration: dashed; padding-left: 100%; color: #000; border-bottom: 1px solid black;"></span>
                            </h6>
                            <h6 class="text-center" style="margin-top: 5px;">Signature and Seal</h6>
                        </td>

                        <td style="width: 60%; text-align: center;" align="center" valign="top">
                            <h6>
                                Any dispute must be notified in written within 15 days from the date of this
                                invoice.<br />
                                This is an electronic statement, does not require any signature
                            </h6>
                        </td>

                        <td style="width: 20%;" valign="top">
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
