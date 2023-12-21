<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stock</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class="container col-md-5"><br>
    <h2>Update Stock</h2>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('stock.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" class="form-control" id="productName" name="productName" value="{{ old('productName', $task->productName) }}" readonly>
        </div>

        <div class="form-group">
            <label for="product_code">Product Code:</label>
            <input type="text" class="form-control" id="product_code" name="product_code" value="{{ old('product_code', $task->product_code) }}" readonly>
        </div>

        <div class="form-group">
            <label for="productPrice">Stock Balance:</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $task->stock) }}" readonly>
        </div>

        <div class="form-group">
            <label for="addStock">Add Stock:</label>
            <input type="number" class="form-control" id="addStock" name="addStock">
        </div>
            
        <button type="submit" class="btn btn-primary">Update Stock</button>
    </form>
</body>
</html>