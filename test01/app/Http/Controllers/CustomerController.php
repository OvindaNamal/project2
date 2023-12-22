<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Imports\CustomerImport;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    protected $task;
    public function __construct()
    {
        $this->task =new Customer();
    }

    // insert Data
    public function store (Request $request){
        $this->task->create($request->all());
        return redirect()->back();
    }

    //view Data
    public function view (){
        $response['tasks']=$this->task->all();
        return view('customerView',$response);
    }

    // edit
    public function editCust($task_id){
        $task = $this->task->find($task_id);
        
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }
        return view('customerUpdate', compact('task'));
    }

    //update tabel
    public function updateCust(Request $request, $task_id) {
        $task=$this->task->find($task_id);
        if (!$task) {
            return redirect()->back()->with('error','Task Not Found');
        }
        $task->update([
            'customerName' => $request->input('customerName'),
            'customerCode' => $request->input('customerCode'),
            'Address' => $request->input('Address'),
            'contact' => $request->input('contact'),
        ]);

        return redirect()->route('customer.view')->with('success', 'Product updated successfully');
    }
//upload data using excel file
    public function import_customer (Request $request){
        $request->validate([
            'excel-file'=>'required|mimes:xlsx'
        ]);

        Excel::import(new CustomerImport, $request -> file('excel-file'));
        
        return redirect()->back()->with('success', 'All Customer Added Success....');
    }
}
