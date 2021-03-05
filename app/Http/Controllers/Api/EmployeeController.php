<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new EmployeeCollection(Employee::latest('id')->paginate(10));
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
            'name'    => 'required|string:min:2|max:20',
            'email'   => 'required|string|email|unique:employees',
            'phone'   => 'required|numeric|min:11',
            'salary'  => 'required|numeric',
            'address' => 'required|string',
            'nid'     => 'required|numeric',
            'joining_date'     => 'required|date'
        ]);
        
        if ($request->avatar) {
            
            $position   = strpos($request->avatar, ';');
            $sub        = substr($request->avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $avatar     = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (!file_exists('backend/employee')) {
                mkdir('backend/employee', 0777, true);
            }

            Image::make($request->avatar)->resize(240, 200)->save('backend/employee/'.$avatar);
        
        } else {
           $avatar = 'default.png';
        }

        Employee::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'salary'       => $request->salary,
            'address'      => $request->address,
            'avatar'       => $avatar,
            'nid'          => $request->nid,
            'joining_date' => $request->joining_date
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Employee Added Successfully'
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
        return new EmployeeResource(Employee::findOrFail($id));
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
            'name'    => 'required|string|min:2|max:20',
            'email'   => 'required|string|email|unique:employees,email,'.$id,
            'phone'   => 'required|numeric|min:11',
            'salary'  => 'required|numeric',
            'address' => 'required|string',
            'nid'     => 'required|numeric',
            'joining_date'     => 'required|date'
        ]);

        $employee = Employee::findOrFail($id);
        
        if ($request->new_avatar) {
            
            $position   = strpos($request->new_avatar, ';');
            $sub        = substr($request->new_avatar, 0, $position);
            $extension  = explode('/', $sub)[1];
            $avatar     = date('d-m-Y').'-'.rand().'.'.$extension;
            
            if (file_exists('backend/employee/' . $employee->avatar)) {
                unlink('backend/employee/' . $employee->avatar);
            }

            if (!file_exists('backend/employee')) {
                mkdir('backend/employee', 0777, true);
            }

            Image::make($request->new_avatar)->resize(240, 200)->save('backend/employee/'.$avatar);
        
        } else {
           $avatar = $request->avatar;
        }

        $employee->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'salary'       => $request->salary,
            'address'      => $request->address,
            'avatar'       => $avatar,
            'nid'          => $request->nid,
            'joining_date' => $request->joining_date
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Employee Updated Successfully'
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
        $employee = Employee::findOrFail($id);

        if (file_exists('backend/employee/'.$employee->avatar)) {
            unlink('backend/employee/'.$employee->avatar);
        }

        $employee->delete();

        return response()->json([
            'alert' => 'Success',
            'message' => 'Employee Deleted Successfully'
        ]);
    }

    // Search Customer
    public function search($query)
    {
        return new EmployeeCollection(Employee::where('name', 'LIKE', "%$query%")
                    ->orWhere('email', 'LIKE', "%$query%")                            
                    ->orWhere('phone', 'LIKE', "%$query%")                            
                    ->orWhere('salary', 'LIKE', "%$query%")                            
                    ->orWhere('address', 'LIKE', "%$query%")                            
                    ->orWhere('nid', 'LIKE', "%$query%")                            
                    ->orWhere('joining_date', 'LIKE', "%$query%")                            
                    ->latest('id')->paginate(10));
    }

}
