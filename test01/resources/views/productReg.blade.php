<html>
<head>
    <title>Product Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
    <body>
        <br>
    <div class="container col-md-5">
    <a href="/"><button  class="btn btn-primary">Home</button></a>
    <a href="{{route('productReg.view')}}"><button  class="btn btn-primary">View All Products</button></a>
    <a href="{{route('productStock.view')}}"><button  class="btn btn-primary">Stock</button></a>
    <hr>
    <h1>PRODUCT REGISTRATION</h1>
    <hr>
    
        <form method="POST" action="{{route('productReg.store')}}">
            @csrf
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" class="form-control" name="productName" required>

            <label class="form-label">Product Code</label>
            <input type="text" class="form-control" name="product_code" required>

            <label class="form-label">Price</label>
            <input type="text" class="form-control" name="productPrice" required>

            <label class="form-label">Expiry Date</label>
            <input type="date" class="form-control" name="expiryDate" required>

            <hr>
            <h3>DEFINE DISCOUNT & STOCK</h3>
            <hr>

            <label class="form-label">Discount (%) </label>
            <input type="text" class="form-control" name="discount" id="discount" required>

            <label class="form-label">Stock</label>
            <input type="text" class="form-control" name="stock" id="stock" required>
        </div>  
            <input type="submit" value="ADD" class="btn btn-primary">
        </form>
    </div>
    </body>
</html>