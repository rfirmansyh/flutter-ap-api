<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Good extends JsonResource
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
            'message' => 'Get Data Barang Success',
            'data' => $parent
        ];
    }
}
