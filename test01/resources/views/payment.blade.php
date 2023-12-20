<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creditor Balance & Payment</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var payInput = document.getElementById('pay');
            var balanceInput = document.getElementById('balance');
            var delayTimer;

            payInput.addEventListener('input', function () {
                clearTimeout(delayTimer);
                delayTimer = setTimeout(function() {
                    updateBalance();
                }, 1000); // Adjust the delay time (in milliseconds) as needed
            });

            function updateBalance() {
                var balance = parseFloat(balanceInput.value) || 0;
                var pay = parseFloat(payInput.value) || 0;
                balance = balance - pay;
                balanceInput.value = balance;
            }
        });
    </script>

</head>
<body class="container"><br>
    <a href="/"><button class="btn btn-success">Home page</button></a>
    <h1>Creditor Payment</h1><hr>

        <form action="{{ route('payment.update', $uniqueOrderNumber[0]['order_No']) }}" method="POST">
        
            @csrf
            @method('PUT')

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
                        <td style="text-align: right;">{{number_format($order["product_price"],2)}}</td>
                        <td>{{$order["quantity"]}}</td>
                        <td>{{$order["free"]}}</td>
                        <td style="text-align: right;">{{number_format($order["amount"],2)}}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
                
            </table>

        </div><hr>

        <div style="display: flex; flex-direction: column;">
            <h5>Sub Total Amount : {{number_format ($order->net_Amount,2)}}</h5> <br> 
        </div>
        <table >
            <tr><td><h5>Discount</h5></td><td><input type="text" name="tot_discount" id="tot_discount" value="{{number_format($order->tot_discount,2)}}"  class="form-control" readonly></td></tr>
            <tr><td><h5>Total Amount</h5></td><td><input type="text" name="Tot_Amount" id="Tot_Amount" value="{{number_format($order->tot_Amount,2)}}"  class="form-control" readonly></td></tr>
            <tr><td><h5>Balance</h5></td><td><input type="text" name="balance" id="balance" value="{{number_format($order->balance,2)}}"  class="form-control" readonly></td></tr>
            <tr><td><h5>Payment</h5></td><td><input type="text" name="pay" id="pay"  class="form-control" placeholder="0.00"></td></tr>
        </table> <br> 
        <button type="submit" class="btn btn-primary">Pay</button>
        <button class="btn btn-info" onclick="window.print()">Print Order Sheet</button> 
    </form>
</body>
</html>