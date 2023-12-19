<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DefineFreeIssues;
use App\Models\PlacingOrder;
use App\Models\product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PlacingOrderController extends Controller
{
    // select product table data for display defineFreeIssues form
    public function placingorder()
    {
        $Customers = Customer::all();
        $products = product::all();
        $FreeIssues = DefineFreeIssues::all();

        $def_Customers = PlacingOrder::pluck('customer_name')->toArray();
        $def_products = PlacingOrder::pluck('pu_product')->toArray();

        $lastOrder = placingOrder::latest('order_No')->first();
        $nextOrderNumber = 1; // Default order number if no orders exist

        if ($lastOrder) {
            // If there is a last order number, increment it by 1
            $nextOrderNumber = $lastOrder->order_No + 1;
        }
        return view('placingorder',['Customers' => $Customers, 'products' => $products, 'nextOrderNumber'=>$nextOrderNumber, 'def_products' => $def_products, 'def_Customers' => $def_Customers, 'FreeIssues'=>$FreeIssues]);
        // return ['Customers' => $Customers, 'products' => $products, 'nextOrderNumber'=>$nextOrderNumber, 'def_products' => $def_products, 'def_Customers' => $def_Customers, 'FreeIssues'=>$FreeIssues];

    }
// create constracter for DefineFreeIssues
    protected $task;
    public function __construct()
    {
        $this->task =new PlacingOrder();
    }


//view Data
    public function view (){

        $response['tasks']=$this->task->all();
        $uniqueOrder= $response['tasks']->unique('order_No');
        return view('placingOrderView',['response'=>$uniqueOrder]);
    }

//view one order Data

    public function details($order_No){

    $order_num = placingOrder::where('order_No', $order_No)->get();
    $uniqueOrderNumber = $order_num->unique('order_No');
    
    return view('placingOrdersView',['orderNumber'=>$order_num, 'uniqueOrderNumber'=>$uniqueOrderNumber]);
    
}



//insert data
    public function saveData(Request $request){
        try {
            $data = $request->all();
    
            $customer_name = $data['customer_name'];
            $order_No = $data['order_No'];
            $pu_product = $data['pu_product'];
            $product_code = $data['product_code'];
            $product_price = $data['product_price'];
            $quantity = $data['quantity'];
            $free =$data['free'];
            $discount =$data['discount'];
            $amount =$data['amount'];
            $net_Amount = $data['net_Amount'];
            $tot_discount = $data['tot_discount'];
            $tot_Amount = $data['tot_Amount'];
            $pay = $data['pay'];
            $balance = $data['balance'];
    
            foreach ($quantity as $key => $qty) {
                // Check if necessary keys exist
                if (isset($quantity[$key], $free[$key], $amount[$key])) {
                    // Check if quantity and amount are not null
                    if ($qty !== null && $amount[$key] !== null) {
    
                        $order_add = new PlacingOrder();
    
                        $order_add->customer_name = $customer_name;
                        $order_add->order_No = $order_No;
                        $order_add->pu_product = $pu_product[$key];
                        $order_add->product_code = $product_code[$key];
                        $order_add->product_price = $product_price[$key];
                        $order_add->quantity = $qty;
                        $order_add->free = $free[$key];
                        $order_add->discount = $discount[$key];
                        $order_add->amount = $amount[$key];
                        $order_add->net_Amount = $net_Amount;
                        $order_add->tot_discount = $tot_discount;
                        $order_add->tot_Amount = $tot_Amount;
                        $order_add->pay = $pay;
                        $order_add->balance = $balance;
    
                        $order_add->save();
                    }
                } else {
                    // Log or handle missing keys (optional)
                }
            }
    //return $request;
            return redirect()->back()->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            return redirect()->back()->with('error', 'An error occurred while processing the order.');
        }
    }

}
