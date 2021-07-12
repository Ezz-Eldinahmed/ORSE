<?php

namespace App\Http\Controllers;

use App\Models\recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $recommendation = Recommendation::create([
            'type' => $request->type,
            'description' => $request->description,
            'user_id' => auth()->user()->id
        ]);

        dd($recommendation);
        // foreach ($request->categroies as $key => $value) {
        //     $recommendation->categories()->create([
        //         'recommendation_id' => $recommendation->id,
        //         'category_id' => $value->id
        //     ]);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function show(recommendation $recommendation)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function edit(recommendation $recommendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, recommendation $recommendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\recommendation  $recommendation
     * @return \Illuminate\Http\Response
     */
    public function destroy(recommendation $recommendation)
    {
        //
    }
}
