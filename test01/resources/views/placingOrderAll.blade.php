<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>All Orders for {{ $customerOrders->first()->customer_name ?? 'Customer' }}</title>

    <style>

        tr:nth-child(even) {
          background-color: rgba(150, 212, 212, 0.4);
        }
        
        th:nth-child(even),td:nth-child(even) {
          background-color: rgba(150, 212, 212, 0.168);
        }
    </style>      
</head>
<body class="container">
    <a href="/"><button class="btn btn-success">Home page</button></a><br>

    <h1>{{ $customerOrders->first()->customer_name ?? 'Customer' }}'s All Orders</h1>

    @if ($customerOrders->isEmpty())
        <p>No orders found for this customer.</p>
    @else
        <table class="table">
            <thead class="thead-dark" style="text-align: center;">
                <tr>
                    <th>Date</th>
                    <th>Order Number</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Sub Tot. Amount</th>
                    <th>Discount (Rs.)</th>
                    <th>Total Amount</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                    $totalDiscount = 0;
                    $totalAmount = 0;
                @endphp
                @foreach ($customerOrders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td style="text-align: center;">{{ $order->order_No }}</td>
                        <td>{{ $order->pu_product }}</td>
                        <td style="text-align: right;">{{ $order->product_price }}.00</td>
                        <td style="text-align: center;">{{ $order->quantity }}</td>
                        <td style="text-align: right;">{{ $order->amount }}.00</td>
                        <td style="text-align: right;">{{ $order->discount }}.00</td>
                        <td style="text-align: right;">{{ $order->amount - $order->discount }}.00</td>
                        <td>
                            <form action="{{ route('deleteOrder', ['id' => $order->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><b>Delete</b></button>
                            </form>
                        </td>
                    </tr>
                    @php
                        $subtotal += $order->amount;
                        $totalDiscount += $order->discount;
                        $totalAmount += ($order->amount - $order->discount);
                    @endphp
                @endforeach
            </tbody>
        </table>

        <table>
            <tr><td><b>Sub Total Amount</b></td> <td>:</td> 
                <td style="text-align: right;"><b>{{ $subtotal}}.00</b></td></tr>
            <tr style="border-bottom: 1px solid black;"><td><b>Discount</b></td> <td>:</td>          
                <td style="text-align: right;"><b>{{ $totalDiscount}}.00</b></td></tr>
            <tr style="border-bottom: 3px solid black;"><td><b>Total Amount</b></td>  <td>:</td>     
                <td style="text-align: right;"><b>{{ $totalAmount}}.00</b></td></tr>
        </table> <br>
    @endif
    <button class="btn btn-info" onclick="window.print()">Print Order Sheet</button>
</body>
</body>
</html>