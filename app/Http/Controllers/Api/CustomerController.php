<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use Intervention\Image\Facades\Image;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::latest('id')->paginate(10);
        return new CustomerCollection($customers);
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
            'name'    => 'required|string|max:30',
            'email'   => 'required|email|string|max:30',
            'phone'   => 'required|numeric',
            'address' => 'required|string|max:255'
        ]);

        if ($request->avatar) {
            
            $position   = strpos($request->avatar, ';');
            $sub        = substr($request->avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $avatar     = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (!file_exists('backend/customer')) {
                mkdir('backend/customer', 0777, true);
            }

            Image::make($request->avatar)->resize(240, 200)->save('backend/customer/'.$avatar);
        
        } else {
           $avatar = 'default.png';
        }

        Customer::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'avatar'       => $avatar
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Customer Added Successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name'    => 'required|string|max:30',
            'email'   => 'required|email|string|max:30',
            'phone'   => 'required|numeric',
            'address' => 'required|string|max:255'
        ]);

        if ($request->new_avatar) {
            
            $position   = strpos($request->new_avatar, ';');
            $sub        = substr($request->new_avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $avatar     = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (file_exists('backend/customer/'.$customer->avatar)) {
                unlink('backend/customer/'.$customer->avatar);
            }
            if (!file_exists('backend/customer')) {
                mkdir('backend/customer', 0777, true);
            }

            Image::make($request->new_avatar)->resize(240, 200)->save('backend/customer/'.$avatar);
        
        } else {
           $avatar = $customer->avatar;
        }

        $customer->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'avatar'       => $avatar
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Customer Added Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        if (file_exists('backend/customer/'.$customer->avatar)) {
            unlink('backend/customer/'.$customer->avatar);
        }

        $customer->delete();

        return response()->json([
            'alert' => 'Success',
            'message' => 'Customer Deleted Successfully'
        ]);
    }

    // Search Customer
    public function search($query)
    {
        $customers = Customer::where('name', 'LIKE', "%$query%")
                    ->orWhere('email', 'LIKE', "%$query%")                            
                    ->orWhere('phone', 'LIKE', "%$query%")                            
                    ->orWhere('address', 'LIKE', "%$query%")                            
                    ->latest('id')->paginate(10);
        return new CustomerCollection($customers);
    }
}
