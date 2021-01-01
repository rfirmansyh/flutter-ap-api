<?php

namespace App\Http\Resources;
use App\Http\Resources\Tempat;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TempatCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parent = parent::toArray($request);
        foreach ($parent as $i => $p) {
            if ( count($this[$i]->reviews) !== 0 ) {
                $parent[$i]['reviews'] = $this[$i]->reviews->toArray();
            } else {
                $parent[$i]['reviews'] = [];
            }
        }
        // $data['reviews'] = new ReviewCollection($this->reviews());
        return $parent;
    }
}
