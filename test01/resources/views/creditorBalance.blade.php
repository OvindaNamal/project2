<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Creditor Balance</title>

    <style>

        tr:nth-child(even) {
          background-color: rgba(212, 212, 246, 0.4);
        }

    </style>   
</head>
<body class="container">
    <a href="/"><button class="btn btn-success">Home page</button></a><br>
    <h1>Creditor Balance</h1>

    <table class="table">
        <thead class="thead-dark" style="text-align: center;">
            <tr>
                <th>Customer Name</th>
                <th>Sub Total Amount</th>
                <th>Discount</th>
                <th>Total Amount</th>
                <th>Total Balance</th>
                <th>All Orders</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customerBalances as $customer)
                <tr>
                    {{-- <td>{{ \Carbon\Carbon::parse($customer->updated_at)->timezone('Asia/Colombo')->format('Y-m-d') }}</td> --}}
                    <td>{{ $customer->customer_name }}</td>
                    <td style="text-align: center;">{{ number_format($customer->total_net_amount,2) }}</td>
                    <td style="text-align: center;">{{ number_format($customer->total_discount,2) }}</td>
                    <td style="text-align: center;">{{ number_format($customer->total_amount,2) }}</td>
                    <td style="text-align: center;">{{ number_format($customer->total_balance,2) }}</td>
                    {{-- <td><a href="{{ route('allOrders.view', $customer->customer_name) }}"><b>View</b></a></td> --}}
                    <td>
                    <form action="{{ route('allOrders.view', $customer->customer_name) }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-primary">View</button>
                    </form>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>