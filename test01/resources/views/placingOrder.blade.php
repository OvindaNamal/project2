
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Placing Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    $(document).ready(function () {
        document.addEventListener('DOMContentLoaded', function () {
            var dropdown = document.getElementById('pu_product');
            var input1 = document.getElementById('free_product');

            dropdown.addEventListener('change', function () {
                input1.value = dropdown.value;
            });
        });


        let dynamicTableCounter = 1;
        var tot_Amount = 0;
        var tot_discount = 0;
        var net_Amount = 0; // mean sub total amount
        var balance = 0;
        var namee;
        var selectedCode;
        var selectedDiscount;
        var multyFree;

        // Event listener for changes in the product select
        $(document).on('change', '.product-select', function () {
            var selectedOption = $(this).find(':selected');
            var selectedPrice = selectedOption.data('price');
            selectedCode = selectedOption.data('code');
            selectedDiscount = selectedOption.data('discount'); 
            namee = selectedOption.data('name');
            
            // Find the closest row and update the related fields
            var row = $(this).closest('tr');
            row.find('.product-code').val(selectedCode);
            row.find('.product-price').val(selectedPrice);
            //row.find('.discount').val(selectedDiscount);
            

            // Trigger the input event to calculate the amount and update net_Amount
            row.find('.quantity').trigger('input');
        });

        // Event listener for changes in the quantity input
        $(document).on('input', '.quantity', function () {
            var quantity = $(this).val();
            var productPrice = $(this).closest('tr').find('.product-price').val();
            var discount = $(this).closest('tr').find('.discount').val();


            // Calculate the amount for the current row
            var amount = quantity * productPrice;
            $(this).closest('tr').find('.amount').val(amount);

            var dis = amount *(selectedDiscount/100);
            $(this).closest('tr').find('.discount').val(dis);
//console.log(dis);
// Update net_Amount and discount for all rows
            updateNetAmount();
            updateDiscount();

// Calculate and update free quantity
            calculateAndDisplayFreeQuantity($(this));

// Update the total_amount and balance
            updateTotalAmount();
            updateBalance();
        });
        
        $(document).on('input', '#pay', function () {
            updateBalance();
        });

// Function to update net_Amount , total_amount and discount for all rows
        function updateNetAmount() {
            net_Amount = 0;
            $('.amount').each(function () {
                net_Amount += parseFloat($(this).val()) || 0;
            });
            $('#net_Amount').val(net_Amount);
        }

        function updateDiscount() {
            tot_discount = 0;
            $('.discount').each(function () {
                tot_discount += parseFloat($(this).val()) || 0;
            });
            $('#tot_discount').val(tot_discount);
        }

        function updateTotalAmount() {
            tot_Amount = 0;
            tot_Amount = net_Amount - tot_discount;
            $('#tot_Amount').val(tot_Amount);
        }
// Function to update the balance
        function updateBalance() {
            var payment = parseFloat($('#pay').val()) || 0;
            balance = tot_Amount - payment;
            $('#balance').val(balance);
        }

// Dynamic Table Creation
        $("#add").click(function () {
            let i = $('.sl').length + 1;
            let html =
                '<tr>' +
                '<td>' +
                '<select name="pu_product[]" id="pu_product' + i + '" class="form-control product-select" placeholder="Select Product">' +
                'optgroup><label>Select Purchase Product</label>' +
                '<option value="" selected disabled hidden>Select Product</option>' +
                '@foreach ($products as $product)' +
                '<option value="{{ $product->productName }}" data-name="{{ $product->productName }}" data-price="{{ $product->productPrice }}" data-code="{{ $product->product_code}}" data-discount="{{ $product->discount}}">{{ $product->productName }}</option>' +
                '@endforeach' +
                '</optgroup>' +
                '</select>' +
                '</td>' +
                '<td><input type="text" name="product_code[]" id="product_code' + i + '" class="form-control product-code" readonly></td>' +
                '<td><input type="text" name="product_price[]" id="product_price' + i + '"  class="form-control product-price" readonly></td>' +
                '<td><input type="text" name="quantity[]" id="quantity' + i + '"  class="form-control quantity"></td>' +
                '<td><input type="text" name="free[]" id="free' + i + '"  class="form-control free" readonly></td>' +
                '<td><input type="text" name="discount[]" id="discount' + i + '"  class="form-control discount" readonly></td>' +
                '<td><input type="text" name="amount[]" id="amount' + i + '"  class="form-control amount" readonly></td>' +
                '<td><button class="btn btn-danger remove" type="button" name="remove">Remove</button></td>' +
                '</tr>';

            $("#productTable").append(html);
            dynamicTableCounter++;
            // console.log(productTable);
        });

        // Event listener for removing rows
        $("#productTable").on('click', '.remove', function () {
            $(this).closest('tr').remove();
            dynamicTableCounter--;

            updateNetAmount();
        });


        function calculateAndDisplayFreeQuantity(quantityInput) {
            var quantity = quantityInput.val();
            var selectedOption = $(this).find(':selected');
            var productType = quantityInput.closest('tr').find('.product-select option:selected').data('type');
            var lowerLimit = quantityInput.closest('tr').find('.product-select option:selected').data('lower-limit');
            var freeQuantityField = quantityInput.closest('tr').find('.free');
            // console.log(selectedCode);
            var ty = @JSON($FreeIssues);


            // console.log(selectedOption);
            for (var i = 0; i < ty.length; i++) {
            var type = ty[i].type;
            var lower_limit = ty[i].lower_limit;
            var defineProduct = ty[i].pu_product;
            var defineFree = ty[i].free_quantity;
            var upper_limit = ty[i].upper_limit;

            // console.log(type);
            // console.log(lower_limit);

           
            // this part use calculate free issues
                if (namee==defineProduct && type==='flat') {
                    if (quantity >=lower_limit) {
                        freeQuantityField.val(defineFree); 
                    } else{
                        freeQuantityField.val('0'); 
                    }
                } 


                if (namee == defineProduct && type === 'multiple' && quantity >= lower_limit) {
                    
                    if ( quantity <= upper_limit) {

                        var multyFree=(quantity/lower_limit)*defineFree; 
                        freeQuantityField.val(Math.round(multyFree)); 

                    } else{
                        var multyFree=(upper_limit/lower_limit)*defineFree; 
                        freeQuantityField.val(Math.round(multyFree));
                    }
                 } else{
                    // freeQuantityField.val('0'); 
                     } 
            }
        }

        // Initialize the product options in the new row
        function initializeProductOptions() {
            // Update the product options in the new row
            $('.product-select').last().html($('#pu_product').html());
        }

        $("#insert_form").submit(function (e) {
            e.preventDefault();

            // Extract the form data
            var formData = $(this).serialize();

            // Perform an AJAX request to submit the form data
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: formData,
                success: function (response) {
                    // Handle the success response
                    console.log(response);
                },
                error: function (error) {
                    // Handle the error response
                    console.error(error);
                }
            });
        });

        // Initialize the product options in the first row
        initializeProductOptions();
    });

</script>


</head>
<body class="container"><br>
    <a href="/"><button class="btn btn-success">Home page</button></a>

        <form class="mb-3"  action="{{route('saveData')}}" method="POST">
        @csrf
        
            <hr>
            <h1 class="text-center">Placing Order</h1>
            <hr>
                <label><b>Customer Name</b></label>
                <select class="form-control" name="customer_name" id="customer_name" required>
                    <option value="" selected disabled hidden>Select Name</option>
                            @foreach($Customers as $Customer)
                                <option value="{{ $Customer->customerName  }}">{{ $Customer->customerName }}</option>
                            @endforeach
                </select>

                <label><b>Order Number</b></label>
                <input type="text" class="form-control" name="order_No" id="order_No" value="{{ $nextOrderNumber }}" readonly>
            

            <hr>
 
                <table class="table table-bordered" id="productTable">
                    <thead class="thead-dark" style="text-align: center;">
                        <tr>
                            <th>Product Name</th>
                            <th>Product Code</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Free quantity</th>
                            <th>Discount (Rs.)</th>
                            <th>Amount</th>
                            <th></th>
                        </tr>
                    </thead>
                         <tr id="table_field" ></tr> 
                </table>
                <table>
                    <tr><th><input class="btn btn-warning" type="button" name="add" id="add"  value="Add Row"></th></tr>
                </table>
                <table>
                    {{-- net_Amount veriabel mean sun totalamount --}}
                    <tr><td><h6>Sub Total Amount</h6></td><td><input type="text" name="net_Amount" id="net_Amount" class="form-control" readonly></td></tr>
                    <tr style="border-bottom: 3px solid black;"><td><h6>Discount</h6></td><td><input type="text" name="tot_discount" id="tot_discount" class="form-control" readonly></td></tr>
                    <tr><td><h6>Total Amount</h6></td><td><input type="text" name="tot_Amount" id="tot_Amount" class="form-control" readonly></td></tr>
                    <tr style="border-bottom: 2px solid black;"><td><h6>Payment</h6></td><td><input type="text" name="pay" id="pay" class="form-control" placeholder="0.00"></td></tr>
                    <tr style="border-bottom: 4px solid black;"><td><h6>Balance</h6></td><td><input type="text" name="balance" id="balance" class="form-control" readonly></td></tr>
                </table>

                <center>
                    <td><input class="btn btn-success" type="submit" name="saveData" id="saveData" value="Save Data"></td>
                </center>
        </form>

        <a href="{{route('placingOrder.view')}}"><button class="btn btn-info">View Orders</button></a>
        <button class="btn btn-info" onclick="window.print()">Print Order Sheet</button>
</body>
</html>