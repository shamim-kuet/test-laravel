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
                        <th>Consaignment ID</th>
                        <th>Merchant Name</th>
                        <th>Rider Name</th>
                        <th>Recipient</th>
                        <th>Merchant Order ID</th>
                        <th>Collected</th>
                        <th>Delivery Charge</th>
                        <th>Return Charge</th>
                        <th>COD Charge</th>
                        <th>Weight Charge</th>
                        <th>Total Charge</th>
                        <th>Status</th>
                        <th>Assigned Date</th>
                        <th>Delivery Date</th>
                    </tr>
                </thead>

                @php
                    $totalReceivedAmount = 0;
                    $totalDeliveryCharge = 0;
                    $totalReturnCost = 0;
                    $totalCodCharge = 0;
                    $totalWeightCharge = 0;
                    $totalCharge = 0;
                @endphp

                <tbody>
                    @if ($getResponse->data != '')
                        @foreach ($getResponse->data as $response)

                        @php
                            $totalReceivedAmount = $totalReceivedAmount + $response->received_amount;
                            $totalDeliveryCharge = $totalDeliveryCharge + $response->delivery_charge;
                            $totalReturnCost = $totalReturnCost + $response->total_return_cost;
                            $totalCodCharge = $totalCodCharge + $response->cod_charge;
                            $totalWeightCharge = $totalWeightCharge + $response->weight_charge;
                            $totalCharge = $totalCharge + $response->total_charge;
                        @endphp

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $response->order->consignment_id }}</td>
                        <td>{{ @$response->merchant->business->name }}</td>
                        <td>{{ @$response->rider->name }}</td>
                        <td>{!! @$response->order->customer_name.'</br>'.@$response->order->customer_mobile !!}</td>
                        <td>{{ @$response->order->merchant_order_id }}</td>
                        <td>{{ @$response->received_amount }}</td>
                        <td>{{ @$response->delivery_charge }}</td>
                        <td>{{ @$response->total_return_cost }}</td>
                        <td>{{ @$response->cod_charge }}</td>
                        <td>{{ @$response->weight_charge }}</td>
                        <td>{{ @$response->total_charge }}</td>
                        <td>
                            <button class="btn btn-xs"
                                style="background: {{ @$response->deliver_status->color }}; color: {{ @$response->deliver_status->font_color }}">{{ @$response->deliver_status->name }}</button>
                        </td>
                        <td>{{ \Utility::commonDateFormate($response->assign_date) }}</td>
                        <td>{{ \Utility::commonDateFormate($response->delivery_date) }}</td>
                    </tr>
                        @endforeach
                    @endif
                </tbody>
                <tr style="background: #c7c7c7; font-weight: bold">
                    <td align="right" colspan="6">Total</td>
                    <td align="center">{{ \Utility::number($totalReceivedAmount) }}</td>
                    <td align="center">{{ \Utility::number($totalDeliveryCharge) }}</td>
                    <td align="center">{{ \Utility::number($totalReturnCost) }}</td>
                    <td align="center">{{ \Utility::number($totalCodCharge) }}</td>
                    <td align="center">{{ \Utility::number($totalWeightCharge) }}</td>
                    <td align="center">{{ \Utility::number($totalCharge) }}</td>
                    <td align="right" colspan="3"></td>
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
