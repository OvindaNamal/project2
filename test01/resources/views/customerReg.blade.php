<html>
<head>
    <title>Customer Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
    <body class="container col-md-5">
        <br>
    <a href="/"><button  class="btn btn-primary">Home</button></a>
    <hr>
    <h1>CUSTOMER REGISTRATION</h1>
    <hr>
        
    <form method="POST" action="{{route('customerReg.store')}}" >
        @csrf
        <div class="mb-3">
            <label class="form-label">Customer Name</label>
            <input type="text" class="form-control" name="customerName" required>
            
            <label class="form-label">Customer Code</label>
            <input type="text" class="form-control" name="customerCode" required>
            
            <label class="form-label">Customer Address</label>
            <input type="text" class="form-control" name="Address" required>

            <label class="form-label">Customer contact</label>
            <input type="text" class="form-control" name="contact" required>
        </div>
            <input type="submit" value="ADD" class="btn btn-primary">
        </form>

    <a href="{{route('customer.view')}}">View All Customer Details</a>
    </body>
</html>