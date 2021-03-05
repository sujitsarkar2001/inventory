<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $order = Order::all();
        $today_order = Order::where('date', date('Y-m-d'))->get();

        $expense = Expense::sum('amount');
        $today_expense = Expense::where('date', date('Y-m-d'))->sum('amount');

        return response()->json([
            'total_sell'    => $order->sum('total'),
            'today_sell'    => $today_order->sum('total'),
            'total_income'  => $order->sum('pay'),
            'today_income'  => $today_order->sum('pay'),
            'total_due'     => $order->sum('due'),
            'today_due'     => $today_order->sum('due'),
            'expense'       => $expense,
            'today_expense' => $today_expense,
        ]);
    }
}
