<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Province extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent = parent::toArray($request);
        return [
            'status' => 'Success',
            'message' => 'Get Data Provinces Success',
            'data' => $parent
        ];
    }
}
