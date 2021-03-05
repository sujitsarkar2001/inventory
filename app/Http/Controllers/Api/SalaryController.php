<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SalaryCollection;
use App\Http\Resources\SalaryResource;
use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new SalaryCollection(Salary::latest('id')->paginate(10));
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
            'name'  => 'required|numeric',
            'month' => 'required|string|max:15'
        ]);

        $check = Salary::where('employee_id', $request->name)
                        ->where('month', $request->month)
                        ->where('year', date('Y'))
                        ->first();
        if ($check ) {
            return response()->json([
                'alert'   => 'Warning',
                'message' => 'Already Pay Salary!!'
            ]);
        } else {
            $employee = Employee::findOrFail($request->name);
            Salary::create([
                'employee_id' => $employee->id,
                'amount'      => $employee->salary,
                'date'        => date('Y-m-d'),
                'month'       => $request->month,
                'year'        => date('Y')
            ]);
            return response()->json([
                'alert'   => 'Success',
                'message' => 'Employee Payment Successfully Done'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SalaryResource(Salary::findOrFail($id));
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Salary::findOrFail($id)->delete();
        return response()->json([
            'alert' => 'Success',
            'message' => 'Salary Deleted Successfully'
        ]);
    }

    // Employee Details 
    public function allEmployee() {
        $employees = Employee::select(['id', 'name'])->latest('id')->get();
        return response()->json($employees);
    }

    // Search Customer
    public function search($query)
    {
        return new SalaryCollection(Salary::where('amount', 'LIKE', "%$query%")
                    ->orWhere('date', 'LIKE', "%$query%")                            
                    ->orWhere('month', 'LIKE', "%$query%")                            
                    ->orWhere('year', 'LIKE', "%$query%")                         
                    ->latest('id')->paginate(10));
    }
}
