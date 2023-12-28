<html>
<head>
    <title>View Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="container"><br>
    <a href="/"><button  class="btn btn-primary">Home</button></a>
    <a href="/productReg"><button class="btn btn-success">Add Product</button></a>
    <a href="/placingOrder"><button class="btn btn-success">Placing Order Page</button></a>

    <h2>Stock View</h2>

    <table class="table table-bordered">
        <thead class="thead-dark" style="text-align: center;">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th style="text-align: center;">Product Code</th>
                <th style="text-align: center;">Stock</th>
                <th style="text-align: center;">Total Sold</th>
                <th style="text-align: center;">Total Free</th>
                <th style="text-align: center;">Stock Balance</th>
                <th>Update Stock</th>
            </tr>
        </thead>
        <tbody> 
            @foreach ($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{$task->productName}}</td>
                <td style="text-align: center;">{{$task->product_code}}</td> 
                <td style="text-align: center;">{{$task->stock}}</td>
                <td style="text-align: center;">{{$task->totalQuantity}}</td>
                <td style="text-align: center;">{{$task->totalFree}}</td>
                <td style="text-align: center;">{{$task->stockBalance}}</td>
                <td style="text-align: center;"><a href="{{route('stock.edit',$task->id)}}"><b>Add Stock</b></a></td>
            </tr>    
            @endforeach
        </tbody>
    </table>
</body>
</html>