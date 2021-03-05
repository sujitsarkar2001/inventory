<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($product) {
                
                return [
                    'id'            => $product->id,
                    'category_id'   => $product->category_id,
                    'supplier_id'   => $product->supplier_id,
                    'name'          => $product->name,
                    'code'          => $product->code,
                    'root'          => $product->root,
                    'qty'           => $product->qty,
                    'buying_price'  => $product->buying_price,
                    'selling_price' => $product->selling_price,
                    'buy_date'      => $product->buy_date,
                    'image'         => $product->image,
                    'category'      => $product->category,
                    'supplier'      => $product->supplier,
                ];
            })
        ];
    }
}
