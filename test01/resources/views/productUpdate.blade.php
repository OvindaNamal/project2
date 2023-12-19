<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container col-md-5">
    <h2>Edit Product</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('productReg.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" class="form-control" id="productName" name="productName" value="{{ old('productName', $task->productName) }}" required>
        </div>

        <div class="form-group">
            <label for="product_code">Product Code:</label>
            <input type="text" class="form-control" id="product_code" name="product_code" value="{{ old('product_code', $task->product_code) }}" required>
        </div>

        <div class="form-group">
            <label for="productPrice">Product Price:</label>
            <input type="number" class="form-control" id="productPrice" name="productPrice" value="{{ old('productPrice', $task->productPrice) }}" required>
        </div>

        <div class="form-group">
            <label for="expiryDate">Expiry Date:</label>
            <input type="date" class="form-control" id="expiryDate" name="expiryDate" value="{{ old('expiryDate', $task->expiryDate) }}" required>
        </div>

        <div class="form-group">
            <hr>
            <h1>DEFINE DISCOUNT</h1>
            <hr>

            <label class="form-label">Discount (%) </label>
            <input type="text" class="form-control" name="discount" id="discount" value="{{ old('discount', $task->discount) }}" required>
            </div>
            
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</body>
</html>