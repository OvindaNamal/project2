<html>
<head>
    <title>Order Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .page-break {
            page-break-after: always;
        }
    </style>
        
</head>


<body class="container">
    {{-- @if($selectedOrders) --}}
    {{-- @foreach($selectedOrders as $order) --}}
    {{-- @foreach($filteredOrders as $order) --}}
    {{-- @foreach ($orderDetails as $order) --}}
    @foreach($uniqueOrderNumber as $order)
        <h2>Order Details</h2>

        <form class="mb-3" method="POST" action="http://127.0.0.1:8000/placingOrderPdf">
            @csrf
            <div style="display: flex; flex-direction: row;">
                <div style="display: flex; flex-direction: column;">
                    <div class="form-group;">
                        <label for="id">Order Number : </label>
                        <h5>{{ $order['order_No'] }}</h5>
                    </div>

                    <div class="form-group;">
                        <label for="name">Customer Name : </label>
                        <h5>{{ $order['customer_name'] }}</h5>
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px;">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Free</th>
                            <th>Amount</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($uniqueOrderNumber as $item)
                            @if ($item['order_No'] == $order['order_No'])
                                <tr>
                                    <td>{{$item["pu_product"]}}</td>
                                    <td>{{$item["product_code"]}}</td>
                                    <td>{{$item["product_price"]}}</td>
                                    <td>{{$item["quantity"]}}</td>
                                    <td>{{$item["free"]}}</td>
                                    <td style="text-align: left;">{{$item["amount"]}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>

        <table>
            <tr><td><b>Sub Total Amount</b></td> <td>:</td> 
                <td style="text-align: right;"><b>{{ $order->net_Amount}}.00</b></td></tr>
            <tr style="border-bottom: 1px solid black;"><td><b>Discount</b></td> <td>:</td>          
                <td style="text-align: right;"><b>{{ $order->tot_discount}}.00</b></td></tr>
            <tr style="border-bottom: 3px solid black;"><td><b>Total Amount</b></td>  <td>:</td>     
                <td style="text-align: right;"><b>{{ $order->tot_Amount}}.00</b></td></tr>
        </table> <br>
        <div class="page-break"></div>
    @endforeach
    {{-- @endif --}}
</body>
</html>
