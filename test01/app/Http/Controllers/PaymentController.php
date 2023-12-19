<?php

namespace App\Http\Controllers;

use App\Models\PlacingOrder;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
  
    public function viewData (){
        $details = PlacingOrder ::all();
        $unique = $details->unique('order_No');
        return view('payment',['details'=>$details , 'unique'=>$unique]);
    }

    //view one order Data

    public function paydetails($order_No){

        $order_num = placingOrder::where('order_No', $order_No)->get();
        $uniqueOrderNumber = $order_num->unique('order_No');
        
        return view('payment',['orderNumber'=>$order_num, 'uniqueOrderNumber'=>$uniqueOrderNumber]);
    }

    // update part
    public function editPay($order_No)
    {
        $order = placingOrder::find($order_No)->first();
        return view('payment',compact('order'));
    }

    
    public function updatePay(Request $request, $orderNumber)
    {
        // Validate the incoming request
        $request->validate([
            'pay' => 'required|numeric|min:0.01', // Adjust validation rules as needed
        ]);
    
        // Find all PlacingOrder records with the given order number
        $orders = PlacingOrder::where('order_No', $orderNumber)->get();
    
        // Update the balance and any other relevant fields for each record
        foreach ($orders as $order) {
            $order->balance -= $request->input('pay');
            // You might want to update other fields like payment status, etc.
            $order->save();
        }
    
        // Redirect back or to another page
        return redirect()->back()->with('success', 'Payments updated successfully');
    }
}
