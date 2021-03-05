<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest('id')->paginate(10);
        return new OrderCollection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|numeric',
            'pay'    => 'required|numeric',
            'due'    => 'required|numeric',
            'pay_by' => 'required|string|max:20',
        ]);
        $carts = Cart::where('customer_id', $request->name)->get();
        $setting = Setting::firstOrFail();
        
        $order = Order::create([
            'customer_id' => $request->name,
            'qty'         => $carts->sum('quantity'),
            'sub_total'   => $carts->sum('sub_total'),
            'vat'         => $setting->vat,
            'total'       => $carts->sum('sub_total') * $setting->vat /100 +$carts->sum('sub_total'),
            'pay'         => $request->pay,
            'due'         => $request->due,
            'pay_by'      => $request->pay_by,
            'date'        => date('Y-m-d'),
            'month'       => date('F'),
            'year'        => date('Y')
        ]);

        foreach ($carts as $cart) {

            OrderDetails::create([
                'order_id'    => $order->id,
                'product_id'  => $cart->product_id,
                'qty'         => $cart->quantity,
                'price'       => $cart->price,
                'sub_total'   => $cart->sub_total
            ]);

            $product = Product::findOrFail($cart->product_id);
            $product->update([
                'qty' => $product->qty - $cart->quantity
            ]);
            $cart->delete();
        }

        return response()->json([
            'alert' => 'Success',
            'message' => 'Order Successfully Done',
        ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'order_details.product']);
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json([
            'alert' => 'Success',
            'message' => 'Order Deleted Successfully'
        ]);
    }

    // Search Customer
    public function search($query)
    {
        $orders = Order::where('customer_id', 'LIKE', "%$query%")
                    ->orWhere('qty', 'LIKE', "%$query%")                            
                    ->orWhere('sub_total', 'LIKE', "%$query%")                            
                    ->orWhere('vat', 'LIKE', "%$query%")                            
                    ->orWhere('total', 'LIKE', "%$query%")                            
                    ->orWhere('pay', 'LIKE', "%$query%")                            
                    ->orWhere('due', 'LIKE', "%$query%")                            
                    ->orWhere('pay_by', 'LIKE', "%$query%")                            
                    ->orWhere('date', 'LIKE', "%$query%")                            
                    ->orWhere('month', 'LIKE', "%$query%")                            
                    ->orWhere('year', 'LIKE', "%$query%")                            
                    ->latest('id')->paginate(10);
        return new OrderCollection($orders);
    }
}
