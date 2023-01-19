<!DOCTYPE html>
<html lang="en">

<head>
    <link href="print_style.css" rel="stylesheet" />
    <meta charset="utf-8" />
    <title>Invoice</title>

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
        .before {
            page-break-before: always;
        }
        .after {
            page-break-after: always;
        }
        .avoid {
            page-break-inside: avoid-all;
        }
        .center-me {
            font-size: 15px;
            margin: auto;
            height: 10px;
            max-width: 500px;
            margin: 75px auto 40px auto;
            display: flex;
        }
        .big {
            height: 10.9in;
            background-color: yellow;
            border: 1px solid black;
        }
    </style>

    <script>
        /*window.onload = function () {
      window.print();
       window.top.close();

    }*/
    </script>
</head>
<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4 portrait">
    <button onclick="getpdf()">Generate PDF
    <span id="spinner" style="display:none"><i class="fa-solid fa-spinner"></i></span> </button>

    <div id="getPdfId1">
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
                                        <td style="font-size: 12px; text-align: center;">{{ $data->merchant ? $data->merchant->code : '' }}</td>
                                    </tr>

                                    <tr>
                                        <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant Name</th>
                                        <td style="font-size: 12px; text-align: center;">{{ @$data->merchant->business->name }}</td>
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

                            //$totalCharges = $data->cod_charge + $data->delivery_charge;
                        @endphp
                        <table width="50%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="border-top: 0px;">
                                    <table width="100%" border="1">
                                        <tr style="background: rgba(217, 225, 242, 1);">
                                            <th class="text-center" colspan="5" style="width: 50%; padding: 8px !important;">Orders and Delivery Charges</th>
                                        </tr>

                                        <tr height="30">
                                            <th style="text-align: center;">Delivery Charges</th>
                                            <th style="text-align: center;">Return Charges</th>
                                            <th style="text-align: center;">Weight Charges</th>
                                        </tr>

                                        <tfoot>
                                            <tr style="background: rgba(217, 225, 242, 1)">
                                            <td style="text-align: right;">{{ $data->delivery_charge }}</td>
                                            <td style="text-align: right;">{{ $data->return_charge }}</td>
                                            <td style="text-align: right;">{{ $data->weight_charge  }}</td>

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
                                            <th style="text-align: center;">Total Order</th>
                                            <th style="text-align: center;">Total Collected</th>
                                            <th style="text-align: center;">COD Charge</th>
                                        </tr>


                                        <tfoot>
                                            <tr style="background: rgba(217, 225, 242, 1)">
                                            <td style="text-align: right;">{{ $data->totalorder }}</td>
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
                                        <th class="text-center" colspan="2" style="width: 50%; padding: 8px !important;">Amount (BDT)</th>
                                    </tr>

                                    <tr>
                                        <th style="background: rgba(217, 225, 242, 1); font-size: 12px; width: 50%;">Total Delivery Charges</th>
                                        <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->delivery_charge) }}</td>
                                    </tr>
                                    <tr>
                                        <th style="background: rgba(217, 225, 242, 1); font-size: 12px; width: 50%;">Total Return Charges</th>
                                        <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->return_charge) }}</td>
                                    </tr>

                                    <tr>
                                        <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total COD Charges</th>
                                        <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->cod_charge) }}</td>
                                    </tr>

                                    <tr>
                                        <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Weight Charges</th>
                                        <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->weight_charge) }}</td>
                                    </tr>

                                    <tr>
                                        <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Charges</th>
                                        <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->total_charge) }}</td>
                                    </tr>


                                    <tr>
                                        <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Total Charges Deducted</th>
                                        <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->total_charge) }}</td>
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
                                        <td style="font-size: 12px; text-align: right;">{{ \Utility::numberFormatting($data->collection - $data->total_charge) }}</td>
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
</div>
    <!----- ------------------------------------- Order List---------------------------------------------- ----->
    <div id="getPdfId2">
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
                                    <td style="font-size: 12px; text-align: center;">{{ $data->merchant ? $data->merchant->code : '' }}</td>
                                </tr>

                                <tr>
                                    <th style="background: rgba(217, 225, 242, 1); font-size: 12px;">Merchant Name</th>
                                    <td style="font-size: 12px; text-align: center;">{{ @$data->merchant->business->name }}</td>
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
                            <th style="padding:5px;" align="center">Order Info</th>
                            <th style="padding:5px;" align="center">Invoice Type</th>
                            <th style="padding:5px;" align="center">Merchant Order Id</th>
                            <th style="padding:5px;" align="center">Collected Amount</th>
                            <th style="padding:5px;" align="center">COD</th>
                            <th style="padding:5px;" align="center">Delivery Charge</th>
                            <th style="padding:5px;" align="center">Return Charge</th>
                            <th style="padding:5px;" align="center">Weight Charge</th>
                            <th style="padding:5px;" align="center">Total Charge</th>
                            <th style="padding:5px;" align="center">Paid Out</th>
                        </tr>

                        @php
                            $totalCollectedAmount = 0;
                            $totalCod = 0;
                            $totalDelivery = 0;
                            $totalRDelivery = 0;
                            $totalWCharge = 0;
                            $totalCharge = 0;
                            $totalPaidOut = 0;
                        @endphp


                        @foreach ($data->invoice_details as $order)
                        @php
                            $totalCollectedAmount = $totalCollectedAmount + $order->order->delivery_management->received_amount;
                            $totalCod = $totalCod + $order->order->delivery_management->cod_charge;
                            $paidout = $order->order->delivery_management->received_amount - $order->order->delivery_management->total_charge;

                            $dCharge = $order->order->delivery_management->delivery_charge;
                            $rCharge = $order->order->delivery_management->total_return_cost;
                            $wCharge = $order->order->delivery_management->weight_charge;

                            $totalDelivery = $totalDelivery +  $dCharge;
                            $totalRDelivery = $totalRDelivery +  $rCharge;
                            $totalWCharge = $totalWCharge +  $wCharge;
                            $totalCharge = $totalCharge + $order->order->delivery_management->total_charge;
                            $totalPaidOut = $totalPaidOut + $paidout;
                        @endphp
                                <tr>
                                <td style="text-align: center;">Invoice for Order:{{ $order->order->consignment_id." ".$order->order->customer_name." phone:".$order->order->customer_mobile." thana- ".@$order->order->upozila->upozila_name ." ".@$order->order->district->district_name}}</td>
                                <td align="center">{{ $order->statuses->name }}</td>
                                <td align="center">{{ $order->order->merchant_order_id }}</td>
                                <td align="center">{{ $order->order->delivery_management->received_amount }}</td>
                                <td align="center">{{ $order->order->delivery_management->cod_charge }}</td>
                                <td align="center"> {{ $dCharge }}</td>
                                <td align="center"> {{ $rCharge }}</td>
                                <td align="center"> {{ $wCharge }}</td>
                                <td align="center">{{ $order->order->delivery_management->total_charge }}</td>
                                <td align="center">{{ $paidout  }}</td>
                            </tr>


                        @endforeach

                        <tr bgcolor="#ccc">
                            <td align="right" colspan="3">Total</td>
                            <td align="center">{{ \Utility::number($totalCollectedAmount) }}</td>
                            <td align="center">{{ \Utility::number($totalCod) }}</td>
                            <td align="center">{{ \Utility::number($totalDelivery) }}</td>
                            <td align="center">{{ \Utility::number($totalRDelivery) }}</td>
                            <td align="center">{{ \Utility::number($totalWCharge) }}</td>
                            <td align="center">{{ \Utility::number($totalCharge) }}</td>
                            <td align="center">{{ \Utility::number($totalPaidOut) }}</td>
                        </tr>

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
            let spinner = document.getElementById('spinner');
            spinner.style.display = 'inline';
            for(let inc = 1; inc <=2; inc ++){
                // console.log(inc);
                const element = document.getElementById('getPdfId'+inc);
                let cTime = Math.floor(Date.now() / 1000);
                let pdfFileName;
                if(inc==1){
                 pdfFileName = "summery_invoice_"+cTime+".pdf";
                }
                else{
                 pdfFileName = "details_invoice_"+cTime+".pdf";
                }
                var opt = {
                    //margin:       0,
                    margin: [0, -0.20],
                    filename:     pdfFileName,
                    enableLinks:  false,
                    //pagebreak:    { mode: 'avoid-all' },
                    // pagebreak:    pagebreak,
                    pagebreak: {avoid: 'section'},
                    image:        { type: 'jpeg', quality: 0.98 },
                    //html2canvas:  { scale: 2 },
                    html2canvas:  { scale: 2, logging: true, dpi: 192, letterRendering: true },
                    jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
                };

                html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
                var totalPages = pdf.internal.getNumberOfPages();
                    for (var i = 1; i <= totalPages; i++) {
                        pdf.setPage(i);
                        pdf.setFontSize(20);
                        pdf.setTextColor("#eaeaea");
                        pdf.text(pdf.internal.pageSize.getWidth(), pdf.internal.pageSize.getHeight(), "Header Content here");
                        //pdf.addImage("img.png", 'JPEG', pdf.internal.pageSize.getWidth() - 1.1, pdf.internal.pageSize.getHeight() - 0.25, 1, 0.2);
                        //divided by 2 to go center
                        pdf.text('Page ' + i + ' of ' + totalPages, pdf.internal.pageSize.getWidth()/2,
                        pdf.internal.pageSize.getHeight()/ 2);
                        //pdf.text(pdf.internal.pageSize.getWidth() - 5, pdf.internal.pageSize.getHeight() - 0.1, "Footer Content here");
                       // pdf.addImage("img.png", 'JPEG', pdf.internal.pageSize.getWidth() - 1.1, pdf.internal.pageSize.getHeight() - 0.25, 1, 0.2);
                    }
                }
                ).save();
            }

            spinner.style.display = 'none';
        }
</script>
</body>
</html>
