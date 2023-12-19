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
            <thead class="thead-dark">
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
                @foreach ($customerOrders as $order)
                    <tr>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>{{ $order->order_No }}</td>
                        <td>{{ $order->pu_product }}</td>
                        <td>{{ $order->product_price }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->amount }}</td>
                        <td>{{ $order->discount }}</td>
                        <td>{{ $order->amount - $order->discount }}</td>
                        <td>
                            <form action="{{ route('deleteOrder', ['id' => $order->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><b>Delete</b></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <button class="btn btn-info" onclick="window.print()">Print Order Sheet</button>
</body>
</body>
</html>