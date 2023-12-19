<?php

namespace App\Http\Controllers;

use App\Models\PlacingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PaymentCreditorBalanceController extends Controller
{
    // public function displayCustomerBalances()
    // {
    //     try {
    //         $customerBalances = PlacingOrder::select('customer_name', DB::raw('SUM(subquery.balance) as total_balance'))
    //             ->from(DB::raw('(SELECT DISTINCT order_NO, customer_name, balance FROM placing_orders) as subquery'))
    //             ->groupBy('customer_name')
    //             ->get();

    //         $customerTotalAmount = PlacingOrder::select('customer_name', DB::raw('SUM(subquery.net_Amount) as total_net_amount'))
    //             ->from(DB::raw('(SELECT DISTINCT order_NO, customer_name, net_Amount FROM placing_orders) as subquery'))
    //             ->groupBy('customer_name')
    //             ->get();

    //         return view('creditorBalance', ['customerBalances' => $customerBalances ?? []],['customerTotalAmount' => $customerTotalAmount ?? []]);
    //     } catch (\Exception $e) {
    //         return view('error');
    //     }
    // }

    public function displayCustomerBalances()
    {
        try {
            $customerBalances = PlacingOrder::select('customer_name', DB::raw('SUM(subquery.balance) as total_balance'), DB::raw('SUM(subquery.net_Amount) as total_net_amount'))
                ->from(DB::raw('(SELECT DISTINCT order_NO, customer_name, balance, net_Amount FROM placing_orders) as subquery'))
                ->groupBy('customer_name')
                ->get();
    
            return view('creditorBalance', ['customerBalances' => $customerBalances ?? []]);
        } catch (\Exception $e) {
            return view('error');
        }
    }
}