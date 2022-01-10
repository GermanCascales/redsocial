<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostTypeRequest;
use App\Http\Requests\UpdatePostTypeRequest;
use App\Models\PostType;

class PostTypeController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function show(PostType $postType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function edit(PostType $postType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostTypeRequest  $request
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostTypeRequest $request, PostType $postType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostType  $postType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostType $postType)
    {
        //
    }
}
