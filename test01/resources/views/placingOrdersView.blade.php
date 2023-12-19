

<html>
<head>
    <title>View Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>

<body class="container">
    <a href="/"><button class="btn btn-success">Home page</button></a>
    <a href="/placingOrder"><button class="btn btn-success">Go To Placing Order Page</button></a>

    <h2>Order Details</h2>
    <form class="mb-3">

        <div style="display: flex; flex-direction: row;">
      
            <div style="display: flex; flex-direction: column;">

                <div class="form-group;">
                    <label for="id">Order Number : </label>
                        @foreach($uniqueOrderNumber as $order)
                            <h5>{{ $order['order_No'] }}</h5>
                        @endforeach
                </div>


                <div class="form-group;">
                    <label for="name">Customer Name : </label>
                    @foreach($uniqueOrderNumber as $order)
                        <h5>{{ $order['customer_name'] }}</h5>
                    @endforeach
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

                    @foreach($orderNumber as $order)
                    <tr>
                        <td>{{$order["pu_product"]}}</td>
                        <td>{{$order["product_code"]}}</td>
                        <td>{{$order["product_price"]}}</td>
                        <td>{{$order["quantity"]}}</td>
                        <td>{{$order["free"]}}</td>
                        <td style="text-align: left;">{{$order["amount"]}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
                
            </table>

        </div>

        <div style="display: flex; flex-direction: column;">
            <h5>Net Amount : {{ $order->net_Amount}}.00</h5> <br>  
        </div> 
        <button class="btn btn-info" onclick="window.print()">Print Order Sheet</button> 
</body>
</html>