<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="KapaFoods">
    <meta name="author" content="NinosITSolution">
    <meta name="robots" content="noindex, nofollow">
    <style>
        .table-stripped thead th, .table-stripped tbody  td{
          border-bottom: 1px solid #ddd;
          text-align: left;
        }
        .table-stripped{
            width: 100%;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="block-content">
        <div class="row">
            <div class="col-6">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2"><p  style="margin-left: 90px">Kapa Foods India Pvt Ltd.,</p></th>
                            <th><p>Shipping Addess</p></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                               <div class="logo">
                                    <img src="{{ asset('web/img/logo.png')}}" width="75px"
                                         width="75px" alt="Kapa logo">
                                </div> 
                            </td>
                            <td>
                                <div class="contact ml-2">
                                    <li type="none" style="font-size:14px;">
                                        Email:<a href="mailto: hidelineshoes@gmail.com"> hidelineshoes@gmail.com</a>
                                    </li>
                                    <li type="none" style="font-size:14px;">
                                        Phone: +91 93453 81289
                                    </li>
                                    <li type="none" style="font-size:14px;">
                                        Hideland Shoes, #82(Old.No. 114/2),
                                    </li>
                                    <li type="none" style="font-size:14px;">
                                        Anna Salai, Nagalkeni
                                    </li>
                                    <li type="none" style="font-size:14px;">
                                        Chrompet, Chennai 600 044,
                                    </li>
                                    <li type="none" style="font-size:14px;">
                                        Tamilnadu, India
                                    </li>
                                </div>
                            </td>
                            <td>
                                <div style="margin-left: 140px">
                                    <li type="none" style="font-size:14px;">Customer Name: {{ $order->user ?? '' }},</li>
                                    <li type="none" style="font-size:14px;">{{ $order->shipping_address["door_number"]}}  {{ $order->shipping_address["area"] }},</li>
                                    <li type="none" style="font-size:14px;">{{ $order->shipping_address["city"]}},  {{ $order->shipping_address["state"]}},</li>
                                    <li type="none" style="font-size:14px;">{{ $order->shipping_address["country"] ." " . $order->shipping_address["pin_code"] }}</li>
                                    <br>
                                    <li type="none" style="font-size:14px;"><b>Email</b> <a href="mailto:{{ $order->transaction->email }}">{{ $order->transaction->email }}</a></li>
                                    <li type="none" style="font-size:14px;"><b>Phone</b> +91 {{ $order->transaction->mobile }}</li>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <b>Order Summary (OrderID {{ $order->order_id }})</b>
                <span><li type="none" style="font-size:14px;">Ordered Date: {{ $order->ordered_date }}</li>
                                    </span>
            </div>
            <br>
            <table class="table-stripped">
                <thead>
                    <tr>
                        <th style="font-size:15px;">Product</th>
                        <th style="font-size:15px;">Qty</th>
                        <th style="font-size:15px;">Selling Price (Rs.)</th>
                        <th style="font-size:15px;">Items</th>
                        <th style="font-size:15px;">Price (Rs.)</th>
                        <th style="font-size:15px;">Tax (%)</th>
                        <th style="font-size:15px;">Amount (Rs.)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->order_summary as $key => $summary)
                        <tr>
                            <td style="font-size:14px;">{{ $summary["product_name"] }}</td>
                            <td style="font-size:14px;">{{ $summary["weight"] }}</td>
                            <td style="font-size:14px;">{{ $summary["selling_price"]/$summary["items"] }}</td>
                            <td style="font-size:14px;">{{ $summary["items"] }}</td>
                            <td style="font-size:14px;">{{ $summary["selling_price"] }}</td>
                            <td style="font-size:14px;">{{ $summary["gst_tax"] }}</td>
                            <td style="font-size:14px;">{{ intval($summary["amount_after_tax"]) }}</td>
                            @php
                                $items[$key] = $summary["items"];
                                $amount[$key] = $summary["selling_price"];
                            @endphp
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>
        <hr>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <b>Overall</b>
                </div>
            </div>
            <div class="card-body">
                <table class="table-stripped">
                    <thead>
                        <tr>
                            <th style="font-size:14px;">Total Products</th>
                            <th style="font-size:14px;">Total Items</th>
                            <th style="font-size:14px;">Total Price (Rs.)</th>
                            <th style="font-size:14px;">Grant Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:14px;">{{ count($items) }}</td>
                            <td style="font-size:14px;">{{ array_sum($items) }}</td>
                            <td style="font-size:14px;">{{ array_sum($amount) }}</td>
                            <td style="font-size:14px;">{{ intval($order->transaction->ordered_price) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <b>Transaction Detail (TxnID {{ $order->transaction->txn_id }})</b>
                </div>
            </div>
            <div class="card-body">
                <table class="table-stripped">
                    <thead>
                        <tr>
                            <th style="font-size:14px;">Card Name</th>
                            <th style="font-size:14px;">Pay mode</th>
                            <th style="font-size:14px;">Bank Ref. No.</th>
                            <th style="font-size:14px;">Paid Status</th>
                            <th style="font-size:14px;">Paid Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:14px;">{{ $order->transaction->customer_name}}</td>
                            <td style="font-size:14px;">{{ $order->transaction->pay_mode }}</td>
                            <td style="font-size:14px;">{{ $order->transaction->bank_ref_num }}</td>
                            <td style="font-size:14px;">{{ $order->transaction->pay_status }}</td>
                            <td style="font-size:14px;">{{ intval($order->transaction->ordered_price) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/pages/jquery.js') }}"></script>
    <script src="{{ asset('js/oneui.app.js') }}"></script>        
</body>
</html>
