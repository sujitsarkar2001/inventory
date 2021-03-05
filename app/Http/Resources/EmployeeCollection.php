<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeeCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($data) {
                return [
                    'id'           => $data->id,
                    'name'         => $data->name,
                    'email'        => $data->email,
                    'phone'        => $data->phone,
                    'salary'       => $data->salary,
                    'address'      => $data->address,
                    'avatar'       => $data->avatar,
                    'nid'          => $data->nid,
                    'joining_date' => $data->joining_date
                ];
            })
        ];
    }
}
