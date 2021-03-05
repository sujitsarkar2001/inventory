<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'employee_id' => $this->employee_id,
            'amount' => $this->amount,
            'date' => $this->date,
            'month' => $this->month,
            'year' => $this->year,
            'employee' => $this->employee->makeHidden(['created_at', 'updated_at'])
        ];
    }
}
