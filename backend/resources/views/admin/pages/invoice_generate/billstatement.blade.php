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
            font-size: 12px;
        }

        table tr td {
            font-weight: 700;
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
                        <span class="heading_invoice">Collection & Bill Statement</span>
                    </div>
                </div>

                <div class="row" style="margin-top: 25px; align-items: center;">
                    <div class="col-lg-4" style="width: 40%;">
                        <table border="1" style="width: 85%;">
                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant ID</th>
                                <td style="font-size: 12px; text-align: center;">{{ $merchant->code }}</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant Name</th>
                                <td style="font-size: 12px; text-align: center;">{{ $merchant->name }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-8" style="width: 60%;">
                        <table border="1" style="width: 85%; margin-left: auto;">
                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Reference</th>
                                <td style="font-size: 12px; text-align: center;">02-03-2022-M-1-6720-201</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Date</th>
                                <td style="font-size: 12px; text-align: center;">02 March, 2022</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Period</th>
                                <td style="font-size: 12px; text-align: center;">01 March, 2022 to 01 March, 2022</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Prepared By</th>
                                <td style="font-size: 12px; text-align: center;">Sheikh Muntasir Safa</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br />

                @php
                    $total_order=0;
                    $total_delivery_charge=0;
                    foreach($data as $order){
                        $total_order++;
                        $total_delivery_charge+=$order->plan->charge;

                    }
                @endphp
                <table width="50%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="border-top: 0px;">
                            <table width="100%" border="1">
                                <tr style="background: rgba(217, 225, 242, 1);">
                                    <th class="text-center" colspan="5" style="width: 50%; padding: 8px !important;">Orders and Delivery Charges</th>
                                </tr>

                                <tr>
                                    <th style="text-align: center;">Total Orders</th>
                                    <th style="text-align: center;">Deliver</th>
                                    <th style="text-align: center;">Return</th>
                                    <th style="text-align: center;">Partial</th>
                                    <th style="text-align: center;">Delivery Charges</th>
                                </tr>

                                <tr>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                </tr>

                                <tr>
                                    <td style="text-align: right;">{{ $total_order }}</td>
                                    <td style="text-align: right;">5</td>
                                    <td style="text-align: right;">46</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">{{ $total_delivery_charge }}</td>
                                </tr>

                                <tfoot>
                                    <tr style="background: rgba(217, 225, 242, 1)">
                                      <td style="text-align: right;">{{ $total_order }}</td>
                                      <td style="text-align: right;">5</td>
                                      <td style="text-align: right;">46</td>
                                      <td style="text-align: right;">0</td>
                                      <td style="text-align: right;">{{ $total_delivery_charge }}</td>

                                    </tr>
                                </tfoot>

                            </table>
                        </td>

                        <td style="border-top: 0px;">
                            <table width="100%" border="1">
                                <tr style="background: rgba(217, 225, 242, 1);">
                                    <th class="text-center" colspan="6" style="width: 50%; padding: 8px !important;">Collection & CoD Commission</th>
                                </tr>

                                <tr>
                                    <th style="text-align: center;">Total Collection</th>
                                    <th style="text-align: center;">Cash Collection</th>
                                    <th style="text-align: center;">Card/Other</th>
                                    <th style="text-align: center;">CoD from Cash</th>
                                    <th style="text-align: center;">CoD from Card/Other</th>
                                    <th style="text-align: center;">Total CoD</th>
                                </tr>

                                <tr>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;">0</td>
                                </tr>

                                <tr>
                                    <td style="text-align: right;">15,412</td>
                                    <td style="text-align: right;">15,412</td>
                                    <td style="text-align: right;"></td>
                                    <td style="text-align: right;">0</td>
                                    <td style="text-align: right;"></td>
                                    <td style="text-align: right;">0</td>
                                </tr>
                                <tfoot>
                                    <tr style="background: rgba(217, 225, 242, 1)">
                                      <td style="text-align: right;">15,412</td>
                                      <td style="text-align: right;">15,412</td>
                                      <td style="text-align: right;"></td>
                                      <td style="text-align: right;">0</td>
                                      <td style="text-align: right;"></td>
                                      <td style="text-align: right;">0</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </td>
                    </tr>
                </table>

                <br />

                <div class="row" style="">
                    <div class="col-lg-4" style="width: 25%;">
                        <table border="1" style="width: 90%;">
                            <tr style="">
                                <th class="text-center" colspan="2" style="width: 50%; padding: 8px !important;">Amount(BDT)</th>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Collection</th>
                                <td style="font-size: 12px; text-align: right;">22,351</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4" style="width: 45%;">
                        <table border="1" style="width: 95%;">
                            <tr style="">
                                <th class="text-center" colspan="2" style="width: 50%; padding: 8px !important;">Amount(BDT)</th>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px; width: 18%;">Total Delivery Charges</th>
                                <td style="font-size: 12px; text-align: right;">{{ $total_delivery_charge }}</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total CoD Commission</th>
                                <td style="font-size: 12px; text-align: right;">0</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Charges</th>
                                <td style="font-size: 12px; text-align: right;">2,900</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Discount/Adjustment</th>
                                <td style="font-size: 12px; text-align: right;">0</td>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Charges Deducted</th>
                                <td style="font-size: 12px; text-align: right;">2,900</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-4" style="width: 30%;">
                        <table border="1" style="width: 100%;">
                            <tr style="">
                                <th class="text-center" colspan="2" style="width: 50%; padding: 8px !important;">Amount(BDT)</th>
                            </tr>

                            <tr>
                                <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Net Payable to Merchant</th>
                                <td style="font-size: 12px; text-align: right;">22,351</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br />

                <table width="94%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td valign="top" style="width: 20%;">
                            <h6 style="margin-bottom: 0;">
                                <span style="text-decoration: dashed; padding-left: 100%; color: #000; border-bottom: 1px solid black;"></span>
                            </h6>
                            <h6 class="text-center" style="margin-top: 5px;">Signature and Seal</h6>
                        </td>

                        <td style="width: 60%; text-align: center;" align="center" valign="top">
                            <h6>
                                Any dispute must be notified in written within 15 days from the date of this invoice.<br />
                                This is an electronic statement, does not require any signature
                            </h6>
                        </td>

                        <td style="width: 20%;" valign="top">
                            <h6 style="margin-bottom: 0;">
                                <span style="text-decoration: dashed; padding-left: 100%; color: #000; border-bottom: 1px solid black;"></span>
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
