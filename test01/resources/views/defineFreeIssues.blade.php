<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   
    <title>Define Free Issues</title>
 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var dropdown = document.getElementById('pu_product');
            var input1 = document.getElementById('free_product');
    
            dropdown.addEventListener('change', function() {
                input1.value = dropdown.value;
            });
        });

            $(document).ready(function() {
                $('#pu_product').change(function() {
                    var selectedPrice = $(this).find(':selected').data('price');
                    var selectedCode = $(this).find(':selected').data('code');
                    $('#product_price').val(selectedPrice);
                    $('#product_code').val(selectedCode);
            });
        });

    </script>

</head>
<body class="container col-md-5">
    <br>
    <a href="/"><button class="btn btn-primary">Home page</button></a>
    <a href="{{route('freeIssues.view')}}"><button class="btn btn-info">View Free Issues page</button></a>
    <hr>
    <h1>DEFINE FREE ISSUES</h1>
    <hr>

    <form action="{{ route('addFreeIssue') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Free Issue Lablel</label>
            <input type="text" class="form-control" name="label" required>

            <label class="form-label">Type</label>
            <select name="type" id="type" class="form-control">
                <optgroup label="Select Type">
                <option value="" selected disabled hidden>Select Type</option>
                <option value="flat">Flat</option>
                <option value="multiple">Multiple</option>
            </select>

            <label class="form-label">Purchase Product</label>
            <select name="pu_product" class="form-control" id="pu_product" placeholder="Select Product" required>
                <optgroup label="Select Purchase Product">
                    <option value="" selected disabled hidden>Select Product</option>
                    @foreach ($products as $product)
                        @if(!in_array($product->product_name, $def_products))
                            <option value="{{ $product->productName }}" data-price="{{ $product->productPrice }}" data-code="{{ $product->product_code }}">{{ $product->productName }}</option>
                        @endif
                    @endforeach
            </select>

            <input type="hidden" name="product_price" value="{{ $product->productPrice }}">
            <input type="hidden" name="product_code" value="{{ $product->product_code }}">

            <label class="form-label">Free Product</label>
            <input type="text" class="form-control" name="free_product" id="free_product">

            <label class="from-label">Purchase Quantity</label>
            <input type="text" class="form-control" name="pu_quantity" id="pu_quantity" required>

            <label class="form-label">Free Quantity</label>
            <input type="text" class="form-control" name="free_quantity" id="free_quantity" required>

            <label class="form-label">Lower Limit</label>
            <input type="text" class="form-control" name="lower_limit" id="lower_limit" required>

            <label class="form-label">Upper Limit</label>
            <input type="text" class="form-control" name="upper_limit" id="upper_limit" required>
        </div>
        <input type="submit" value="ADD" class="btn btn-primary">
    </form>

</body>
</html>
