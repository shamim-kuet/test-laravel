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
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Account Name</th>
                        <th>Account Number</th>
                        <th>Routing No</th>
                        <th>Branch No</th>
                        <th>Note</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($getResponse->data != '')
                        @foreach ($getResponse->data as $response)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ @$response->merchant->business->name }}</td>
                                <td>{{ $response->payment_method }}</td>
                                <td>{{ $response->amount }}</td>
                                <td>{{ $response->account_name }}</td>
                                <td>{{ $response->account_number }}</td>
                                <td>{{ $response->routing_no }}</td>
                                <td>{{ $response->branch_no }}</td>
                                <td>{{ $response->remark }}</td>
                                <td>
                                    @if ($response->status == '1')
                                        <button class="btn btn-success btn-sm">Active</button>
                                    @elseif($response->status == '0')
                                        <button class="btn btn-warning btn-sm">Inactive</button>
                                    @endif
                                </td>
                                <td>{{ \Utility::commonDateFormate($response->payment_date) }}</td>
                                <td>{{ \Utility::commonDateFormate($response->created_at) }}</td>
                                <td>{{ \Utility::commonDateFormate($response->updated_at) }}</td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>

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
