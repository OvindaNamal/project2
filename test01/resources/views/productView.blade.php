<html>
<head>
    <title>View Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="container">
    <a href="/productReg"><button class="btn btn-success">Add Product</button></a>
    <h2>Product View</h2>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Price</th>
                <th>Discount (%)</th>
                <th>Expiry Date</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody> 
            @foreach ($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{$task->productName}}</td>
                <td>{{$task->product_code}}</td> 
                <td>{{$task->productPrice}}</td>
                <td>{{$task->discount}}</td> 
                <td>{{$task->expiryDate}}</td> 

                <td><a href="{{route('productReg.edit',$task->id)}}">Update</a></td>
                <td><a href="{{route('productReg.delete',$task->id)}}">Delete</a></td>
            </tr>    
            @endforeach
        </tbody>
    </table>
</body>
</html>