<?php

namespace App\Http\Resources;
use App\Review;
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
                // dd($this[$i]->id);
                // $parent[$i]['reviews'] = $this[$i]->reviews->toArray();
                $count_5 = Review::select(\DB::raw('COUNT(id) as count_5'))
                                ->where('tempat_id', $this[$i]->id)
                                ->where('rating', '>=',  5)->first()->count_5;
                $count_4 = Review::select(\DB::raw('COUNT(id) as count_4'))
                                ->where('tempat_id', $this[$i]->id)
                                ->where('rating', '>=',  4)->where('rating', '<',  5)->first()->count_4;
                $count_3 = Review::select(\DB::raw('COUNT(id) as count_3'))
                                ->where('tempat_id', $this[$i]->id)
                                ->where('rating', '>=',  3)->where('rating', '<',  4)->first()->count_3;
                $count_2 = Review::select(\DB::raw('COUNT(id) as count_2'))
                                ->where('tempat_id', $this[$i]->id)
                                ->where('rating', '>=',  2)->where('rating', '<',  3)->first()->count_2;
                $count_1 = Review::select(\DB::raw('COUNT(id) as count_1'))
                                ->where('tempat_id', $this[$i]->id)
                                ->where('rating', '>=',  1)->where('rating', '<',  2)->first()->count_1;
                $sum = Review::select(\DB::raw("
                                                $count_5 / COUNT(id) as sum_5, 
                                                $count_4 / COUNT(id) as sum_4,
                                                $count_3 / COUNT(id) as sum_3,
                                                $count_2 / COUNT(id) as sum_2,
                                                $count_1 / COUNT(id) as sum_1
                                                "))->first();
                // dd($sum);
                $parent[$i]['reviews'] = Review::select(\DB::raw('reviews.*, users.name, users.photo'))
                                                ->join('users', 'users.id', '=', 'user_id')
                                                ->where('tempat_id', $this[$i]->id)
                                                ->orderBy('reviews.id', 'desc')->get();
                $parent[$i]['sum'] = $sum;                                                 
            } else {
                $parent[$i]['reviews'] = null;
            }
        }
        // $data['reviews'] = new ReviewCollection($this->reviews());
        return $parent;
    }
}
