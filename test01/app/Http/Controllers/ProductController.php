<?php

namespace App\Http\Controllers;

use App\Models\PlacingOrder;
use App\Models\product;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
//create Construct    
    protected $task;
    public function __construct()
    {
        $this->task = new product();
    }

// Data insert part
    public function store (Request $request)
    {
        $this->task->create($request->all());
        return redirect()->back();
    }


// View part
    public function view(){
        $response['tasks'] = $this->task->all();
        return view('productView', $response);
    }


// Delete part
    public function delete($task_id){
        $task=$this->task->find($task_id);
        $task -> delete();
        return redirect()->back();
    }



// update part
    public function edit($task_id)
    {
        $task = $this->task->find($task_id);

        // Check if the task is found
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        return view('productUpdate', compact('task'));
    }

    public function update(Request $request, $task_id)
    {
        $task =$this->task->find($task_id);

        // Check if the task is found
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        // Validate the request data
        $request->validate([
            'productName' => 'required|string|max:255',
            'product_code' => 'required|string|max:255',
            'productPrice' => 'required|numeric',
            'discount' => 'required|numeric',
            'expiryDate' => 'required|date',
        ]);

        // Update task data
        $task->update([
            'productName' => $request->input('productName'),
            'product_code' => $request->input('product_code'),
            'productPrice' => $request->input('productPrice'),
            'discount' => $request->input('discount'),
            'expiryDate' => $request->input('expiryDate'),
        ]);

        return redirect()->route('productReg.view')->with('success', 'Product updated successfully');
    }

// get products names for free issuse form
    public function selectProduct()
    {
        $products = product::pluck('productName', 'id');
        return view('defineFreeIssues', compact('products'));
    }


//-----------stock-------------

    public function stock_view()
    {
        // Fetch all tasks/products
        $tasks = product::all(); // Replace with your actual model

        $productCodes = $tasks->pluck('product_code')->unique();

        // Iterate through each product code
        foreach ($productCodes as $productCode) {
            // Calculate total quantity and total free for the product
            $totalQuantity = PlacingOrder::where('product_code', $productCode)->sum('quantity');
            $totalFree = PlacingOrder::where('product_code', $productCode)->sum('free');
            
            // Calculate stock balance for the product
            $stockBalance = $tasks->where('product_code', $productCode)->first()->stock - ($totalQuantity + $totalFree);
    
            // Update the $tasks collection with the calculated values
            $tasks->where('product_code', $productCode)->each(function ($task) use ($totalQuantity, $totalFree, $stockBalance) {
                $task->totalQuantity = $totalQuantity;
                $task->totalFree = $totalFree;
                $task->stockBalance = $stockBalance;
            });
        }
        // Pass the tasks to the view
        return view('productStockView', compact('tasks'));
    }




// update stock part
    public function editStock($task_id)
    {
        $task = $this->task->find($task_id);

        // Check if the task is found
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }

        return view('productStockUpdate', compact('task'));
    }

    public function updateStock(Request $request, $task_id)
    {
        $task = $this->task->find($task_id);
    
        // Check if the task is found
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }
    
        // Validate the request data
        $request->validate([
            'addStock' => 'required|numeric|min:0',
        ]);
    
        // Update task data by adding the new stock value
        $currentStock = $task->stock;
        $addStock = $request->input('addStock');
        $newStock = $currentStock + $addStock;
    
        $task->update([
            'stock' => $newStock,
        ]);
    
        return redirect()->route('productStock.view')->with('success', 'Stock updated successfully');
    }

//--------excel bulck import---------
    public function import_product (Request $request){
        $request->validate([
            'excel-file'=>'required|mimes:xlsx'
        ]);

        Excel::import(new ProductImport, $request -> file('excel-file'));
        
        return redirect()->back()->with('success', 'All Product Added Success....');
    }

}
