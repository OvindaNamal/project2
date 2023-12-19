<?php

namespace App\Http\Controllers;

use App\Models\PlacingOrder;
use Illuminate\Http\Request;

class PlacingOrderAll extends Controller
{
    public function allOrders($customer_name)
    {
        // Retrieve all orders for the selected customer
        $customerOrders = PlacingOrder::where('customer_name', $customer_name)->get();

        return view('placingOrderAll', ['customerOrders' => $customerOrders]);
    }


    public function deleteOrder($id)
    {
        $order = PlacingOrder::find($id);

        if ($order) {
            $order->delete();
            return redirect()->back()->with('success', 'Order deleted successfully');
        }

        return redirect()->back()->with('error', 'Order not found');
    }
    
}
