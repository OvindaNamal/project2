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
        <thead class="thead-dark">
            <tr>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Total Balance</th>
                <th>All Orders</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customerBalances as $customer)
                <tr>
                    <td>{{ $customer->customer_name }}</td>
                    <td>{{ $customer->total_net_amount }}</td>
                    <td>{{ $customer->total_balance }}</td>
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