<!DOCTYPE html>
<html lang="en">

<head>
    <link href="print_style.css" rel="stylesheet" />
    <meta charset="utf-8" />

    <!-- Load paper.css for happy printing -->
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}assets/css/paper.css" />
    <link rel="stylesheet" href="{{ $setting ? $setting->default_url : '' }}assets/css/normalize.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        @page {
            size: A4 portrait;
            margin-top: 8px;
            margin-bottom: 10px;
            margin-left: 20px;
        }
        body {
            height:29.7cm;
            width:21cm;
            margin:auto;
            background:#ddd;
            padding:10px;
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
    <button onclick="getpdf()">Generate PDF</button>

    <div id="getPdfId">
        <section class="sheet" id="content-print">
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
                                    <td style="font-size: 12px; text-align: center;">{{ $data->merchant->code }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant Name</th>
                                    <td style="font-size: 12px; text-align: center;">{{ $data->merchant->name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-8" style="width: 60%;">
                            <table border="1" style="width: 85%; margin-left: auto;">
                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Reference</th>
                                    <td style="font-size: 12px; text-align: center;">{{ $data->invoice_no}}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Date</th>
                                    <td style="font-size: 12px; text-align: center;">{{ \Utility::dateFormatting($data->invoice_date) }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Period</th>
                                    <td style="font-size: 12px; text-align: center;">{{ \Utility::dateFormatting($data->invoice_date) }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Prepared By</th>
                                    <td style="font-size: 12px; text-align: center;">{{ $data->admin->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br />

                    @php
                    $data->cod_charge=empty($data->cod_charge)? 0 : $data->cod_charge;
                    $data->delivery_charge=empty($data->delivery_charge)? 0 : $data->delivery_charge;

                        $totalCharges = $data->cod_charge + $data->delivery_charge;
                    @endphp
                    <table width="50%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="border-top: 0px;">
                                <table width="100%" border="1">
                                    <tr style="background: rgba(217, 225, 242, 1);">
                                        <th class="text-center" colspan="5" style="width: 50%; padding: 8px !important;">Orders and Delivery Charges</th>
                                    </tr>

                                    <tr height="30">
                                        {{-- <th style="text-align: center;">Total Orders</th>
                                        <th style="text-align: center;">Deliver</th>
                                        <th style="text-align: center;">Return</th>
                                        <th style="text-align: center;">Partial</th> --}}
                                        <th style="text-align: center;">Delivery Charges</th>
                                    </tr>

                                    <tfoot>
                                        <tr style="background: rgba(217, 225, 242, 1)">
                                        {{-- <td style="text-align: right;">{{ empty($data->totalorder)? 0 : $data->totalorder}}</td>
                                        <td style="text-align: right;">0</td>
                                        <td style="text-align: right;">0</td>
                                        <td style="text-align: right;">0</td> --}}
                                        <td style="text-align: right;">{{ $data->delivery_charge }}</td>

                                        </tr>
                                    </tfoot>

                                </table>
                            </td>

                            <td style="border-top: 0px;">
                                <table width="100%" border="1">
                                    <tr style="background: rgba(217, 225, 242, 1);">
                                        <th class="text-center" colspan="6" style="width: 50%; padding: 8px !important;">Collection & COD Charges</th>
                                    </tr>

                                    <tr height="30">
                                        <th style="text-align: center;">Total Collectable</th>
                                        <th style="text-align: center;">Total Collection</th>
                                        <th style="text-align: center;">COD Charge</th>
                                    </tr>


                                    <tfoot>
                                        <tr style="background: rgba(217, 225, 242, 1)">
                                        <td style="text-align: right;">{{ $data->collection }}</td>
                                        <td style="text-align: right;">{{ $data->collection }}</td>
                                        <td style="text-align: right;">{{ $data->cod_charge }}</td>
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
                                    <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->collection) }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-lg-4" style="width: 45%;">
                            <table border="1" style="width: 95%;">
                                <tr style="">
                                    <th class="text-center" colspan="2" style="width: 50%; padding: 8px !important;">Amount(BDT)</th>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px; width: 50%;">Total Delivery Charges</th>
                                    <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->delivery_charge) }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total COD Charges</th>
                                    <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->cod_charge) }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Charges</th>
                                    <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($totalCharges) }}</td>
                                </tr>


                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Charges Deducted</th>
                                    <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($totalCharges) }}</td>
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
                                    <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->collection - $totalCharges) }}</td>
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

    <!----- ------------------------------------- Order List---------------------------------------------- ----->
        <section class="sheet" id="content-print">
            <div class="box-body" id="box_data" style="display: flex; padding: 5px 10px 0 10px; margin-bottom: -21px;">
                <div style="width: 100%; padding-right: 10px;" class="col-md-12">
                    <div class="row">
                        <div class="col-lg-12" style="width: 100%;">
                            <img src="{{ $setting ? $setting->default_url : '' }}images/logo.png" alt="logo" style="display: block; margin: auto;" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" style="width: 100%;">
                            <span class="heading_invoice">Itemized Details</span>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 25px; align-items: center;">
                        <div class="col-lg-4" style="width: 40%;">
                            <table border="1" style="width: 85%;">
                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant ID</th>
                                    <td style="font-size: 12px; text-align: center;">{{ $data->merchant->code }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant Name</th>
                                    <td style="font-size: 12px; text-align: center;">{{ $data->merchant->name }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-8" style="width: 60%;">
                            <table border="1" style="width: 85%; margin-left: auto;">
                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Reference</th>
                                    <td style="font-size: 12px; text-align: center;">{{ $data->invoice_no}}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Date</th>
                                    <td style="font-size: 12px; text-align: center;">{{ \Utility::dateFormatting($data->invoice_date) }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Period</th>
                                    <td style="font-size: 12px; text-align: center;">{{ \Utility::dateFormatting($data->invoice_date) }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Statement Prepared By</th>
                                    <td style="font-size: 12px; text-align: center;">{{ $data->admin->name }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br />

                    <table width="100%" border="1">
                        <tr style="background: #d9e1f2;">
                            <th style="padding:5px;" align="center">SL No</th>
                            <th style="padding:5px;" align="center">Consignment ID</th>
                            <th style="padding:5px;" align="center">Package Details</th>
                            <th style="padding:5px;" align="center">Collectable Amount</th>
                            <th style="padding:5px;" align="center">Total Collected</th>
                            <th style="padding:5px;" align="center">Customer Details</th>
                            <th style="padding:5px;" align="center">Status</th>
                            <th style="padding:5px;" align="center">Comment</th>
                        </tr>

                        @foreach ($data->invoice_details as $order)
                            <tr>
                                <td style="text-align: center;">{{ $loop->iteration }}</td>
                                <td align="center">{{ $order->order->consignment_id }}</td>
                                <td align="center">{{ $order->order->package_description }}</td>
                                <td align="center">{{ $order->order->collectable_amount }}</td>
                                <td align="center">{{ $order->order->delivery_management->received_amount }}</td>
                                <td align="center">{!! $order->order->customer_name.
                                '<br>'.$order->order->customer_mobile.'<br>'.$order->order->customer_address !!}</td>
                                <td align="center">{{ $order->status }}</td>
                                <td align="center">{{ $order->order->delivery_note }}</td>
                            </tr>
                        @endforeach

                    </table>

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
    </div>
    <script>
        function getpdf(){
                //const element = document.querySelector('body');
                const element = document.getElementById('getPdfId');
                var opt = {
                    //margin:       0,
                    margin: [0, -0.20],
                    filename:     'invoice.pdf',
                    enableLinks:  false,
                    pagebreak:    { mode: 'avoid-all' },
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
                };

                html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
                var totalPages = pdf.internal.getNumberOfPages();
                    // for (var i = 1; i <= totalPages; i++) {
                    //     pdf.setPage(i);
                    //     pdf.setFontSize(20);
                    //     pdf.setTextColor("#ff0000");
                    //     pdf.text(pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight(), "Header Content here");
                    //     pdf.addImage("img.png", 'JPEG', pdf.internal.pageSize.getWidth() - 1.1, pdf.internal.pageSize.getHeight() - 0.25, 1, 0.2);
                    //     //divided by 2 to go center
                    //     pdf.text('Page ' + i + ' of ' + totalPages, pdf.internal.pageSize.getWidth()/2,
                    //     pdf.internal.pageSize.getHeight()/ 2);
                    //     pdf.text(pdf.internal.pageSize.getWidth() - 5, pdf.internal.pageSize.getHeight() - 0.1, "Footer Content here");
                    //     pdf.addImage("img.png", 'JPEG', pdf.internal.pageSize.getWidth() - 1.1, pdf.internal.pageSize.getHeight() - 0.25, 1, 0.2);

                    // }
                }
                ).save();
        }
</script>
</body>
</html>
