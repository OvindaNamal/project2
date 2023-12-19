<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

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
            'expiryDate' => 'required|date',
        ]);

        // Update task data
        $task->update([
            'productName' => $request->input('productName'),
            'product_code' => $request->input('product_code'),
            'productPrice' => $request->input('productPrice'),
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
}
