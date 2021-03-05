<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use Intervention\Image\Facades\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductCollection(Product::latest('id')->paginate(10));
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
            'category'      => 'required|numeric',
            'supplier'      => 'required|numeric',
            'name'          => 'required|string|min:2',
            'code'          => 'required|string|max:15',
            'root'          => 'required|string',
            'qty'           => 'required|numeric',
            'buying_price'  => 'required|numeric',
            'selling_price' => 'required|numeric',
            'buy_date'      => 'required|date'
        ]);

        if ($request->avatar != '') {
            
            $position   = strpos($request->avatar, ';');
            $sub        = substr($request->avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $avatar     = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (!file_exists('backend/product')) {
                mkdir('backend/product', 0777, true);
            }

            Image::make($request->avatar)->resize(240, 200)->save('backend/product/'.$avatar);
        
        } else {
           $avatar = 'default.png';
        }
        Product::create([
            'category_id'   => $request->category,
            'supplier_id'   => $request->supplier,
            'name'          => $request->name,
            'code'          => $request->code,
            'root'          => $request->root,
            'qty'           => $request->qty,
            'buying_price'  => $request->buying_price,
            'selling_price' => $request->selling_price,
            'buy_date'      => $request->buy_date,
            'image'         => $avatar
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Product Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id'   => 'required|numeric',
            'supplier_id'   => 'required|numeric',
            'name'          => 'required|string|min:2',
            'code'          => 'required|string|max:15',
            'root'          => 'required|string',
            'qty'           => 'required|numeric',
            'buying_price'  => 'required|numeric',
            'selling_price' => 'required|numeric',
            'buy_date'      => 'required|date'
        ]);
        
        $product = Product::findOrFail($id);
        if ($request->new_avatar != '') {
            
            $position   = strpos($request->new_avatar, ';');
            $sub        = substr($request->new_avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $image      = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (file_exists('backend/product/' . $product->image)) {
                unlink('backend/product/' . $product->image);
            }

            if (!file_exists('backend/product')) {
                mkdir('backend/product', 0777, true);
            }

            Image::make($request->new_avatar)->resize(240, 200)->save('backend/product/'.$image);
        
        } else {
           $image = $request->image;
        }

        $product->update([
            'category_id'   => $request->category_id,
            'supplier_id'   => $request->supplier_id,
            'name'          => $request->name,
            'code'          => $request->code,
            'root'          => $request->root,
            'qty'           => $request->qty,
            'buying_price'  => $request->buying_price,
            'selling_price' => $request->selling_price,
            'buy_date'      => $request->buy_date,
            'image'         => $image
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Product Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if (file_exists('backend/product/'.$product->image)) {
            unlink('backend/product/'.$product->image);
        }

        $product->delete();

        return response()->json([
            'alert' => 'Success',
            'message' => 'Product Deleted Successfully'
        ]);
    }

    // Search Customer
    public function search($query)
    {
        return new ProductCollection(Product::where('name', 'LIKE', "%$query%")
                    ->orWhere('code', 'LIKE', "%$query%")                            
                    ->orWhere('buying_price', 'LIKE', "%$query%")                            
                    ->orWhere('selling_price', 'LIKE', "%$query%")                         
                    ->orWhere('root', 'LIKE', "%$query%")                         
                    ->latest('id')->paginate(10));
    }
}
