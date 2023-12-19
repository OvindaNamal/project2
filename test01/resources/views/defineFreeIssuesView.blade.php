<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Free Issues</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container">
    <a href="/defineFreeIssues"><button class="btn btn-success">Add Free Issues</button></a>
    <h2>FREE ISSUES</h2>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Free Issue Label</th>
                <th>Type</th>
                <th>Purchase Product</th>
                <th>Free Product</th>
                <th>Puchase Quantity</th>
                <th>Free Quantity</th>
                <th>Lower Limit</th>
                <th>Upper Limit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($tasks as $task)
            <tr>
                <td>{{$task->id}}</td>
                <td>{{$task->label}}</td>
                <td>{{$task->type}}</td> 
                <td>{{$task->pu_product}}</td>
                <td>{{$task->free_product}}</td> 
                <td>{{$task->pu_quantity}}</td> 
                <td>{{$task->free_quantity}}</td>
                <td>{{$task->lower_limit}}</td> 
                <td>{{$task->upper_limit}}</td> 

                <td><a href="{{route('freeIssues.edit',$task->id)}}">Update</a></td>

            </tr>    
            @endforeach
        </tbody>

    </table>
</body>
</html>