<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SalaryCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($salary) {
                return [
                    'id' => $salary->id,
                    'employee_id' => $salary->employee_id,
                    'amount' => $salary->amount,
                    'date' => $salary->date,
                    'month' => $salary->month,
                    'year' => $salary->year,
                    'employee' => $salary->employee
                ];
            }) 
        ];
    }
}
