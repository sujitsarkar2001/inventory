<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductCollection;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Setting;

class POSController extends Controller
{
    public function categories()
    {
        $categories = Category::select(['id', 'name', 'slug'])->latest('id')->get();
        return response()->json($categories);
    }

    public function products()
    {
        $products = Product::with('category')->latest('id')->get();
        return response()->json($products);
    }

    public function getCategoryProducts($id)
    {
        $products = Product::where('category_id', $id)->latest('id')->get();
        return response()->json($products);
    }

    public function searchProduct($category_id, $query)
    {
        if ($category_id == 0) {
            $products = Product::where('name', 'LIKE', "%$query%")
                            ->orWhere('qty', 'LIKE', "%$query%")                    
                            ->latest('id')->paginate(10);
        } else {
            $products = Product::where('category_id', $category_id)
                        ->where('name', 'LIKE', "%$query%")
                        ->orWhere('qty', 'LIKE', "%$query%")                      
                        ->latest('id')->get();
        }
        return response()->json($products);
    }

    public function customer()
    {
        $customers = Customer::select(['id', 'name'])->latest('id')->get();
        return response()->json($customers);
    }

    public function getCartByCustomer($id)
    {
        $cart      = Cart::where('customer_id', $id)->latest('id')->get();
        
        $setting   = Setting::select('vat')->first();
        $sub_total = $cart->sum('sub_total');
        
        return response()->json([
            'total_cart' => $cart,
            'total_qty'  => $cart->sum('quantity'),
            'sub_total'  => $sub_total,
            'vat'        => $setting->vat,
            'total'      => $sub_total * $setting->vat /100 +$sub_total
        ]);
    }

    // Store Cart by Customer Id
    public function storeCartByCustomer($product_id, $customer_id)
    {
        $product = Product::findOrFail($product_id);
        if ($product->qty > 0) {

            $check = Cart::where('customer_id', $customer_id)->where('product_id', $product_id)->first();
        
            if ($check) {
    
                $check->update([
                    'quantity'  => $check->quantity + 1,
                    'sub_total' => $check->sub_total + $product->selling_price
                ]);
    
            } else {
                Cart::create([
                    'customer_id' => $customer_id,
                    'product_id'  => $product->id,
                    'name'        => $product->name,
                    'quantity'    => 1,
                    'price'       => $product->selling_price,
                    'sub_total'   => $product->selling_price
                ]);
            }
            
            return response()->json([
                'message' => 'Product successfully added to cart',
                'alert'   => 'Success'
            ]);
        } else {
            return response()->json([
                'message' => 'Sorry! Stock out this product',
                'alert'   => 'Warning'
            ]);
        }
    }

    // Delete Cart
    public function destroyCart($id, $customer_id)
    {
        Cart::findOrFail($id)->delete();
        
        return response()->json([
            'message' => 'Cart successfully deleted',
            'alert'   => 'Success'
        ]);
    }

    // Sum Cart
    public function sumCart($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->update([
            'quantity'  => $cart->quantity + 1,
            'sub_total' => $cart->sub_total + $cart->price
        ]);
        
        return response()->json([
            'message' => 'Cart quantity updated',
            'alert'   => 'Success'
        ]);
    }

    // Minus Cart
    public function minusCart($id)
    {
        $cart = Cart::findOrFail($id);
        
        $cart->update([
            'quantity'  => $cart->quantity - 1,
            'sub_total' => $cart->sub_total - $cart->price
        ]);
        
        return response()->json([
            'message' => 'Cart quantity updated',
            'alert'   => 'Success'
        ]);
    }
}
