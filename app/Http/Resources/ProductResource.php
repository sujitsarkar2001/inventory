<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id'   => $this->category_id,
            'supplier_id'   => $this->supplier_id,
            'name'          => $this->name,
            'code'          => $this->code,
            'root'          => $this->root,
            'qty'           => $this->qty,
            'buying_price'  => $this->buying_price,
            'selling_price' => $this->selling_price,
            'buy_date'      => $this->buy_date,
            'image'         => $this->image,
            'category'      => $this->category,
            'supplier'      => $this->supplier,
        ];
    }
}
