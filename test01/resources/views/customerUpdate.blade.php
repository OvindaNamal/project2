<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container col-md-5">
    <h2>Edit Customer</h2>

    <form action="{{route('customer.update', $task->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="customerName">Customer Name:</label>
            <input type="text" class="form-control" id="customerName" name="customerName" value="{{ old('customerName', $task->customerName) }}" required>
        </div>

        <div class="form-group">
            <label for="customerCode">Customer Code:</label>
            <input type="text" class="form-control" id="customerCode" name="customerCode" value="{{ old('customerCode', $task->customerCode) }}" required>
        </div>

        <div class="form-group">
            <label for="Address">Customer Address:</label>
            <input type="text" class="form-control" id="Address" name="Address" value="{{ old('Address', $task->Address) }}" required>
        </div>

        <div class="form-group">
            <label for="contact">Customer Contact:</label>
            <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $task->contact) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Customer Details</button>
    </form>
    
</body>
</html>