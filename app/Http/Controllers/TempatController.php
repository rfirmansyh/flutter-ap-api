<?php

namespace App\Http\Controllers;

use App\Tempat;
use Illuminate\Http\Request;
use App\Http\Resources\TempatCollection as TempatCollectionResource;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review_sum = \App\Review::select(\DB::raw('reviews.*, SUM(reviews.rating) / COUNT(reviews.tempat_id) as review_total, COUNT(reviews.id) AS review'))
                                    ->groupBy('reviews.tempat_id');
        $tempats = Tempat::select(\DB::raw('
                                tempats.*, 
                                review, review_total as rating_review, 
                                provinces.name as province_name, kabupatens.name as kabupaten_name'))
                        ->leftJoinSub($review_sum, 'reviews', function($join) {
                            $join->on('tempats.id', '=', 'reviews.tempat_id');
                        })
                        ->join('kabupatens', 'kabupatens.id', '=', 'tempats.kabupaten_id')
                        ->join('provinces', 'provinces.id', '=', 'tempats.province_id')
                        ->orderBy('created_at')
                        ->groupBy('tempats.id')
                        ->paginate(4);
        $tempats = new TempatCollectionResource($tempats);
        return $tempats;
    }

    public function show($id) 
    {
        $review_sum = \App\Review::select(\DB::raw('reviews.*, SUM(reviews.rating) / COUNT(reviews.tempat_id) as review_total, COUNT(reviews.id) AS review'))
                                    ->groupBy('reviews.tempat_id');
        $tempat = Tempat::select(\DB::raw('
                            tempats.*, 
                            review, review_total as rating_review, 
                            provinces.name as province_name, kabupatens.name as kabupaten_name'))
                    ->leftJoinSub($review_sum, 'reviews', function($join) {
                        $join->on('tempats.id', '=', 'reviews.tempat_id');
                    })
                    ->join('kabupatens', 'kabupatens.id', '=', 'tempats.kabupaten_id')
                    ->join('provinces', 'provinces.id', '=', 'tempats.province_id')
                    ->groupBy('tempats.id')
                    ->where('tempats.id', $id)
                    ->orderBy('created_at')
                    ->get();
        $tempat = new TempatCollectionResource($tempat);
        return $tempat;
    }

    public function search($keyword)
    {
        $tempats = \App\Tempat::select(\DB::raw('tempats.*, kabupatens.name as kabupaten_name, provinces.name as province_name'))
                        ->join('kabupatens', 'kabupatens.id', '=', 'tempats.kabupaten_id')
                        ->join('provinces', 'provinces.id', '=', 'tempats.province_id')
                        ->where('tempats.name', 'LIKE', "%$keyword%")
                        ->orWhere('kabupatens.name', 'LIKE', "%$keyword%")
                        ->orWhere('provinces.name', 'LIKE', "%$keyword%")
                        ->orderBy('tempats.created_at')
                        ->get();
        return new TempatCollectionResource($tempats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function upload(Request $request) 
    {
        \Storage::disk('public')->put("tempats/$request->photo", base64_decode($request->image));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tempat = new Tempat;
        $tempat->name = $request->name;
        if ($request->photo) {
            \Storage::disk('public')->put("tempats/$request->photo", base64_decode($request->image));
            $tempat->photo = "tempats/$request->photo";
        }
        $tempat->description = $request->description;
        $tempat->rating_sanitasi = $request->rating_sanitasi;
        $tempat->user_id = 1;
        $tempat->province_id = $request->province_id;
        $tempat->kabupaten_id = $request->kabupaten_id;
        $tempat->save();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Data Tempat Berhasil Ditambahkan',
            'data' => $tempat
        ], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function edit(Tempat $tempat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tempat $tempat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tempat  $tempat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tempat $tempat)
    {
        //
    }
}
