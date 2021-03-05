<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($order) {
                return [
                    'id'          => $order->id,
                    'customer_id' => $order->customer_id,
                    'qty'         => $order->qty,
                    'sub_total'   => $order->sub_total,
                    'vat'         => $order->vat,
                    'total'       => $order->total,
                    'pay'         => $order->pay,
                    'due'         => $order->due,
                    'pay_by'      => $order->pay_by,
                    'date'        => $order->date,
                    'month'       => $order->month,
                    'year'        => $order->year,
                    'customer'    => $order->customer
                ];
            })
        ];
    }
}
