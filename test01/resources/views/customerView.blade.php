<html>
<head>
    <title>View customer Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body class="container">
<a href="/customerReg"><button  class="btn btn-success">Add customer</button></a>
     <h2>Customer Details</h2>

<table class="table table-bordered">
    <thead class="thead-dark" style="text-align: center;">
        <tr>
        <th>ID</th>
        <th>Customer Name</th>
        <th>Customer Code</th>
        <th>Customer Address</th>
        <th>Contact</th>
        <th>Action</th>
    </tr>

    </thead>
    <tbody> 
       @foreach ($tasks as $task)
        <tr>
            <td>{{$task->id}}</td>
            <td>{{$task->customerName}}</td>
            <td>{{$task->customerCode}}</td>
            <td>{{$task->Address}}</td>
            <td>{{$task->contact}}</td>

            <td><a href="{{route('customer.edit',$task->id)}}" >Update</a></td>
        </tr>  
       @endforeach
                       
    </tbody>
</table>
</body>
</html>