<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'name'         => $this->name,
            'email'        => $this->email,
            'phone'        => $this->phone,
            'salary'       => $this->salary,
            'address'      => $this->address,
            'avatar'       => $this->avatar,
            'nid'          => $this->nid,
            'joining_date' => $this->joining_date
        ];
    }
}
