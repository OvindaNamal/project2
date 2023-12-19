<html>
<head>
    <title>View Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script>
        $(document).ready(function () {
            // Event handler for checkbox changes
            $('input[name="selected_orders[]"]').change(function () {
                // Get all checked checkboxes
                var selectedCheckboxes = $('input[name="selected_orders[]"]:checked');
                var selectedOrders = [];
    
                // Loop through checked checkboxes to find selected order numbers
                selectedCheckboxes.each(function () {
                    selectedOrders.push($(this).val());
                });
    
                // Update the download button link with selected order numbers
                updateDownloadLink(selectedOrders);
            });
    
            function updateDownloadLink(selectedOrders) {
            var downloadLink = '/export-pdf-multiple?selected_orders=' + selectedOrders.join(',');
            $('.export-pdf-btn').attr('href', downloadLink);
            console.log(downloadLink);
            }

            //     $.ajax({
            //     url: '/generate-pdf',
            //     method: 'POST',
            //     data: { selected_orders: selectedOrders.join(',') },
            //     success: function (response) {
            //         console.log(response.message);
                  
            //     },
            //     error: function (error) {
            //         console.error('Error generating PDFs:', error);
            //     }
            // });
        });
</script>
<style>

    tr:nth-child(even) {
      background-color: rgba(150, 212, 212, 0.4);
    }
    
    th:nth-child(even),td:nth-child(even) {
      background-color: rgba(150, 212, 212, 0.168);
    }
</style>    
  
</head>

<body class="container">
    <a href="/"><button class="btn btn-warning">Home page</button></a>
    {{-- <a href="{{ route('generatePdf') }}"><button class="btn btn-warning">Download Bulk PDF</button></a> --}}
    <a href="" class="export-pdf-btn"><button class="btn btn-success">Download PDF</button></a>
    <a href="{{ route('exportAllPdf') }}"><button class="btn btn-warning">Download All Items PDF</button></a>
    <a href="/placingOrder"><button class="btn btn-success">Go To Placing Order Page</button></a>

    <h2>Order View</h2>
        <form action="/download-pdf" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Select</th>
                        <th>Order No</th>
                        <th>Customer Name</th>
                        <th>Order Date</th>
                        <th>Last Paid</th>
                        <th>Total Amount</th>
                        <th>Balance</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($response as $task)
                    <tr>
                        <td>
                                <input type="checkbox" name="selected_orders[]" value="{{ $task->order_No }}">
                        </td>
                        <td>{{$task->order_No}}</td>
                        <td>{{$task->customer_name}}</td> 
                        <td>{{ \Carbon\Carbon::parse($task->created_at)->timezone('Asia/Colombo')->format('Y-m-d') }}</td>
                        <td>{{ \Carbon\Carbon::parse($task->updated_at)->timezone('Asia/Colombo')->format('Y-m-d') }}</td>
                        <td>{{$task->tot_Amount}}</td>
                        <td>{{$task->balance}}</td>

                        <td><a href="{{ route('placingOrders.view', $task->order_No) }}" style="color: rgb(34, 0, 255);"><b>View</b></a></td>
                        <td><a href="{{ route('paydetails', $task->order_No) }}" style="color: rgb(135, 0, 65);"><b>payment</b></a></td>
                    </tr>    
                    @endforeach
                </tbody>
            </table>
        </form>
</body>
</html>
