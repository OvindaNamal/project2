<?php

namespace App\Http\Controllers;

use App\Models\PlacingOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class PlacingOrderPdfController extends Controller
{
    // public function exportPdfMultiple(Request $request)
    // {
    //     // Retrieve the selected orders from the request
    //     $selectedOrders = $request->input('selected_orders', []);

    //     // Retrieve all orders from the database (or use your own logic)
    //     $orderNumbers = PlacingOrder::all();
    //     $filteredOrders = $orderNumbers->whereIn('order_No', $selectedOrders); // Filter the orders based on selected order numbers

    //     return view('pdf.placingOrderPdf', ['filteredOrders' => $filteredOrders]);
    // }
    public function getOrderDetails(Request $request)
    {
        // Retrieve the selected orders from the request
        $selectedOrders = $request->input('selected_orders');

        $orderDetails = PlacingOrder::where('order_No', $selectedOrders)->get();

        // Return the order details as JSON (adjust as needed)
        return response()->json($orderDetails);
    }

    
    public function exportAllPdf (){
        $order_num = PlacingOrder::all();
        $uniqueOrderNumber = $order_num->unique('order_No');
        
        $pdf = Pdf::loadView('pdf.placingOrderAllPdf', ['orderNumber'=>$order_num, 'uniqueOrderNumber'=>$uniqueOrderNumber]);
        return $pdf->stream();
    }


    public function exportPdfMultiple(Request $request)
    {
        // Retrieve the selected orders from the request
        $selectedOrders = $request->input('selected_orders', []);

        // Retrieve the details for the selected orders from the database

        $order_num = PlacingOrder::where('order_No', $selectedOrders)->get();
        $uniqueOrderNumber = $order_num->unique('order_No');
        // Load the PDF view with the order details
        $pdf = Pdf::loadView('pdf.placingOrderPdf', ['order_num' => $order_num,'uniqueOrderNumber'=>$uniqueOrderNumber]);

        // Stream the PDF to the browser for download
        return $pdf->stream();
    }



}
