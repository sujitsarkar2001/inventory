<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($expense) {
                return [
                    'id'      => $expense->id,
                    'details' => $expense->details,
                    'amount'  => $expense->amount
                ];
            })
        ];
    }
}
