<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Resources\SupplierCollection;
use App\Http\Resources\SupplierResource;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SupplierCollection(Supplier::latest('id')->paginate(10));
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
            'name'       => 'required|string|min:2|max:20',
            'email'      => 'required|string|email|unique:suppliers',
            'phone'      => 'required|numeric|min:11',
            'shop_name'  => 'required|string',
            'address'    => 'required|string'
        ]);
        
        if ($request->avatar) {
            
            $position   = strpos($request->avatar, ';');
            $sub        = substr($request->avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $avatar     = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (!file_exists('backend/supplier')) {
                mkdir('backend/supplier', 0777, true);
            }

            Image::make($request->avatar)->resize(240, 200)->save('backend/supplier/'.$avatar);
        
        } else {
           $avatar = 'default.png';
        }

        Supplier::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'avatar'    => $avatar,
            'shop_name' => $request->shop_name
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Supplier Added Successfully'
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
        return new SupplierResource(Supplier::findOrFail($id));
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
            'name'      => 'required|string:min:2|max:20',
            'email'     => 'required|string|email|unique:suppliers,email,'.$id,
            'phone'     => 'required|numeric|min:11',
            'shop_name' => 'required|string',
            'address'   => 'required|string'
        ]);

        $supplier = Supplier::findOrFail($id);
        
        if ($request->new_avatar) {
            
            $position   = strpos($request->new_avatar, ';');
            $sub        = substr($request->new_avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $avatar     = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (file_exists('backend/supplier/' . $supplier->avatar)) {
                unlink('backend/supplier/' . $supplier->avatar);
            }

            if (!file_exists('backend/supplier')) {
                mkdir('backend/supplier', 0777, true);
            }

            Image::make($request->new_avatar)->resize(240, 200)->save('backend/supplier/'.$avatar);
        
        } else {
           $avatar = $request->avatar;
        }

        $supplier->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'shop_name'    => $request->shop_name,
            'address'      => $request->address,
            'avatar'       => $avatar
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Supplier Updated Successfully'
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
        $supplier = Supplier::findOrFail($id);

        if (file_exists('backend/supplier/'.$supplier->avatar)) {
            unlink('backend/supplier/'.$supplier->avatar);
        }

        $supplier->delete();

        return response()->json([
            'alert' => 'Success',
            'message' => 'Supplier Deleted Successfully'
        ]);
    }

    // Search Customer
    public function search($query)
    {
        return new SupplierCollection(Supplier::where('name', 'LIKE', "%$query%")
                    ->orWhere('email', 'LIKE', "%$query%")                            
                    ->orWhere('phone', 'LIKE', "%$query%")                            
                    ->orWhere('shop_name', 'LIKE', "%$query%")                            
                    ->orWhere('address', 'LIKE', "%$query%")                            
                    ->latest('id')->paginate(10));
    }
}
