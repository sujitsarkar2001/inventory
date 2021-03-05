<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'customer_id'   => $this->customer_id,
            'qty'           => $this->qty,
            'sub_total'     => $this->sub_total,
            'vat'           => $this->vat,
            'total'         => $this->total,
            'pay'           => $this->pay,
            'due'           => $this->due,
            'pay_by'        => $this->pay_by,
            'date'          => $this->date,
            'month'         => $this->month,
            'year'          => $this->year,
            'customer'      => $this->customer,
            'order_details' => $this->order_details
        ];
    }
}
