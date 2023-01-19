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
                        <th>Recipient Name</th>
                        <th>Recipient Phone</th>
                        <th>District</th>
                        <th>Thana</th>
                        <th>Merchant Name</th>
                        <th>Rider Name</th>
                        <th>Merchant ID</th>
                        <th>Amount to be collect</th>
                        <th>Received amount</th>
                        <th>Delivery Charge</th>
                        <th>Return Charge</th>
                        <th>COD</th>
                        <th>Weight Charge</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @php
                    $total_collectable_amount = 0;
                    $total_received_amount = 0;
                    $total_delivery_charge = 0;
                    $total_total_return_cost = 0;
                    $total_cod_charge = 0;
                    $total_weight_charge = 0;
                @endphp
                <tbody>
                    @if ($getResponse->data != '')
                        @foreach ($getResponse->data as $response)
                            @php
                                $total_collectable_amount = $total_collectable_amount + $response->order->collectable_amount;
                                $total_received_amount = $total_received_amount + $response->received_amount;
                                $total_delivery_charge = $total_delivery_charge + $response->order->delivery_charge;
                                $total_total_return_cost = $total_total_return_cost + $response->order->total_return_cost;
                                $total_cod_charge = $total_cod_charge + $response->order->cod_charge;
                                $total_weight_charge = $total_weight_charge + $response->order->weight_charge;
                            @endphp
                            <tr id="tablerow{{ $response->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$response->order->consignment_id }}</td>
                                <td>{{ @$response->order->customer_name }}</td>
                                <td>{{ @$response->order->customer_mobile }}</td>
                                <td>{{ @$response->order->district->district_name }}</td>
                                <td>{{ @$response->order->upozila->upozila_name }}</td>
                                <td>{{ @$response->merchant->business->name }}</td>
                                <td>{{ @$response->rider->name }}</td>
                                <td>{{ @$response->order->merchant_order_id }}</td>
                                <td>{{ @$response->order->collectable_amount }}</td>
                                <td>{{ $response->received_amount }}</td>
                                <td>{{ @$response->order->delivery_charge }}</td>
                                <td>{{ @$response->order->total_return_cost }}</td>
                                <td>{{ @$response->order->cod_charge}}</td>
                                <td>{{ @$response->order->weight_charge}}</td>
                                <td>{{ @$response->deliver_status->name }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tr style="background: #c7c7c7; font-weight: bold">
                    <td align="right" colspan="9">Total</td>
                    <td align="center">{{ \Utility::number($total_collectable_amount) }}</td>
                    <td align="center">{{ \Utility::number($total_received_amount) }}</td>
                    <td align="center">{{ \Utility::number($total_delivery_charge) }}</td>
                    <td align="center">{{ \Utility::number($total_total_return_cost) }}</td>
                    <td align="center">{{ \Utility::number($total_cod_charge) }}</td>
                    <td align="center">{{ \Utility::number($total_weight_charge) }}</td>
                    <td align="right" colspan="1"></td>
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
