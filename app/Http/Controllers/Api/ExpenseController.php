<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExpenseCollection;
use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ExpenseCollection(Expense::latest('id')->paginate(10));
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
            'details' => 'required|string',
            'amount'  => 'required|numeric'
        ]);
        
        Expense::create([
            'details' => $request->details,
            'amount'  => $request->amount
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Expense Added Successfully'
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
        return new ExpenseResource(Expense::findOrFail($id));
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
        $expense = Expense::findOrFail($id);

        $this->validate($request, [
            'details' => 'required|string',
            'amount'  => 'required|numeric'
        ]);
        
        $expense->update([
            'details' => $request->details,
            'amount'  => $request->amount
        ]);

        return response()->json([
            'alert' => 'Success',
            'message' => 'Expense Updated Successfully'
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
        Expense::findOrFail($id)->delete();
        return response()->json([
            'alert' => 'Success',
            'message' => 'Expense Deleted Successfully'
        ]);
    }

    // Search Customer
    public function search($query)
    {
        return new ExpenseCollection(Expense::where('details', 'LIKE', "%$query%")->orWhere('amount', 'LIKE', "%$query%")->latest('id')->paginate(10));
    }
}
