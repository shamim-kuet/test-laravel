<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print</title>
    <style>
        .tablestr {
            color: #333;
            border: none;
            font-size: 11px;
            background: #fff;
        }

        .tablestr th {
            font-size: 12px;
            padding: 6px;
            text-align: center;
            color: #fff;
            background: #666;
            font-weight: bold;
            font-family: Sans-Serif, serif;
            border: none;
        }

        .tablestr td {
            border: 1px solid #666;
            font-size: 12px;
            padding: 5px;
            text-align: center;
            color: #000;
            font-family: Sans-Serif, serif;
            margin: 0;
            font-weight: normal;
        }

        page {
            background: #fff;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
        }

        page[size="A4"] {
            width: 100%;
            height: auto;
            background: #fff;
        }

        page[size="A4"][layout="portrait"] {
            width: 100%;
            /* height: 21cm;  */
            height: auto;
            background: #fff;
        }
    </style>
</head>

<body style="background:#fff">
    <page size="A4" layout="portrait">
        <div style="width:100%; height:auto; page-break-before: auto; page-break-after: auto; background:#fff">
            <table class="tablestr" border="1" width="100%" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Merchant Name</th>
                        <th>Merchant Code</th>
                        <th>Total Order</th>
                        <th>Total Collection</th>
                        <th>Delivery Charge</th>
                        <th>Return Charge</th>
                        <th>COD Charge</th>
                        <th>Weight Charge</th>
                        <th>Total Charge</th>
                    </tr>
                </thead>

                @php
                    $total_received_amount = 0;
                    $total_delivery_charge = 0;
                    $total_total_return_cost = 0;
                    $total_cod_charge = 0;
                    $total_weight_charge = 0;
                    $total_charge = 0;
                @endphp

                <tbody>
                    @if ($getResponse->data != '')
                        @php $i=0; @endphp

                        @foreach ($getResponse->data as $response)

                            @php
                            $i++;
                            $totalRetCharge = $response->total_returncharge;
                            $totalDelCharge = $response->total_deliverycharge;
                            @endphp

                            @php
                            $total_received_amount = $total_received_amount + $response->total_received;
                            $total_delivery_charge = $total_delivery_charge + $totalDelCharge;
                            $total_total_return_cost = $total_total_return_cost + $totalRetCharge;
                            $total_cod_charge = $total_cod_charge + $response->total_codcharge;
                            $total_weight_charge = $total_weight_charge + $response->total_weight_charge;
                            $total_charge = $total_charge + $response->total_charge;
                            @endphp

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$response->merchant->business->name }}</td>
                                <td>{{ @$response->merchant ? $response->merchant->code : '' }}</td>
                                <td>{{ $response->total_order }}</td>
                                <td>{{ $response->total_received }}</td>
                                <td>{{ $totalDelCharge }}</td>
                                <td>{{ $totalRetCharge }}</td>
                                <td>{{ $response->total_codcharge }}</td>
                                <td>{{ $response->total_weight_charge }}</td>
                                <td>{{ $response->total_charge }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tr style="background: #c7c7c7; font-weight: bold">
                    <td align="right" colspan="4">Total</td>
                    <td align="center">{{ \Utility::number($total_received_amount) }}</td>
                    <td align="center">{{ \Utility::number($total_delivery_charge) }}</td>
                    <td align="center">{{ \Utility::number($total_total_return_cost) }}</td>
                    <td align="center">{{ \Utility::number($total_cod_charge) }}</td>
                    <td align="center">{{ \Utility::number($total_weight_charge) }}</td>
                    <td align="center">{{ \Utility::number($total_charge) }}</td>
                </tr>
            </table>
        </div>
    </page>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        function getPrint() {
            window.print();
        }

        function getPdf() {
            //html2pdf().from(url).save();
            const element = document.querySelector('body');
            const opt = {
                filename: '{{ $api }}' + '.pdf',
                margin: 2,
                image: {
                    type: 'jpeg',
                    quality: 0.9
                },
                jsPDF: {
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            // New Promise-based usage:
            html2pdf().set(opt).from(element).save();
            // Old monolithic-style usage:
            //html2pdf(element, opt);
        }
    </script>
    @if ($action == 'pdf')
        <script>
            window.onload = getPdf;
        </script>
    @else
        <script>
            window.onload = getPrint;
        </script>
    @endif
</body>

</html>
