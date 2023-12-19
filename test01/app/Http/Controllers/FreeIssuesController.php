<?php

namespace App\Http\Controllers;

use App\Models\DefineFreeIssues;
use App\Models\product;
use Illuminate\Http\Request;

class FreeIssuesController extends Controller
{
    // select product table data for display defineFreeIssues form
    public function selectProduct()
    {
        $products = Product::all();
        $def_products = DefineFreeIssues::pluck('pu_product')->toArray();
        return view('defineFreeIssues', ['products' => $products, 'def_products' => $def_products]);
    }
    
// create constracter for DefineFreeIssues
    protected $task;
    public function __construct()
    {
        $this->task =new DefineFreeIssues();
    }

    // insert Data
    public function addFreeIssue (Request $request){
        $this->task->create($request->all());
        
        return redirect()->back();
    }

    //view Data
    public function view (){
        $response['tasks']=$this->task->all();
        return view('defineFreeIssuesView',$response);
    }

    // edit
    public function editeFreeIssues($task_id){
        $task = $this->task->find($task_id);
        
        if (!$task) {
            return redirect()->back()->with('error', 'Task not found');
        }
        return view('defineFreeIssuesUpdate', compact('task'));
    }

    //update tabel
    public function updateFreeIssues(Request $request, $task_id) {
        $task=$this->task->find($task_id);
        if (!$task) {
            return redirect()->back()->with('error','Task Not Found');
        }
        $task->update([
            'label' => $request->input('label'),
            'type' => $request->input('type'),
            'pu_product' => $request->input('pu_product'),
            'free_product' => $request->input('free_product'),
            'pu_quantity' => $request->input('pu_quantity'),
            'free_quantity' => $request->input('free_quantity'),
            'lower_limit' => $request->input('lower_limit'),
            'upper_limit' => $request->input('upper_limit'),
        ]);

        return redirect()->route('freeIssues.view')->with('success', 'Free Issues updated successfully');
    }
}
