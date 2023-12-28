<html>
<head>
    <title>Product Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <script>
        document.addEventListener("DOMContentLoaded", function() {
          // Get the "stock" input element
          var stockInput = document.getElementById("stock");
      
          // Get the "available_stock" input element
          var availableStockInput = document.getElementById("available_stock");
      
          // Add an event listener to the "stock" input for the "input" event
          stockInput.addEventListener("input", function() {
            // Assign the value of "stock" to "available_stock"
            availableStockInput.value = stockInput.value;
          });
        });
      </script>
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
            <input type="text" class="form-control" name="available_stock" id="available_stock" required style="display: none;">

        </div>  
            <input type="submit" value="ADD" class="btn btn-primary">

        </form> <br>
        
        @if(Session::has ('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get ('success')}}
        </div>
        @endif

        <form class="row g-3" action="{{route('import_product')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="col-auto">
                <input type="file" class="form-control" name="excel-file">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Upload Excel File</button>
            </div>
        </form>
    </div>
    </body>
</html>