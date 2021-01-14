<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Http\Request;
use App\Http\Resources\Donation as DonationResource;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = new DonationResource(Donation::orderBy('created_at', 'desc')->get());
        return $donations;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $donation = new Donation;
        $donation->total_price = $request->total_price;
        if ($request->attachment) {
            \Storage::disk('public')->put("attachment/$request->attachment", base64_decode($request->image));
            $donation->attachment = "attachment/$request->attachment";
        }
        $donation->created_at = now();
        $donation->updated_at = null;
        $donation->user_id = $request->user_id;
        $donation->donation_type_id = $request->donation_type_id;
        $donation->save();  

        if ($request->gooods) {
            $donation_detail = [];
            foreach($request->goods as $i => $good) {
                $donation_detail[] = [
                    'donation_id' => $donation->id,
                    'good_id' => $good['id'],
                    'quantity' => $good['quantity'],
                    'created_at' => now(),
                    'updated_at' => null
                ];
            }
            \DB::table('donation_detail')->insert($donation_detail);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'message' => 'Data Donasi Berhasil Ditambahkan',
            'data' => $donation
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
