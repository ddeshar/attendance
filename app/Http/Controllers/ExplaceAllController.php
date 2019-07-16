<?php

namespace App\Http\Controllers;

use App\explace_all;
use Illuminate\Http\Request;

class ExplaceAllController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ex_all = explace_all::all();
        return view ('explace.index',compact('ex_all')); 
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\explace_all  $explace_all
     * @return \Illuminate\Http\Response
     */
    public function show(explace_all $explace_all)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\explace_all  $explace_all
     * @return \Illuminate\Http\Response
     */
    public function edit(explace_all $explace_all)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\explace_all  $explace_all
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, explace_all $explace_all)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\explace_all  $explace_all
     * @return \Illuminate\Http\Response
     */
    public function destroy(explace_all $explace_all)
    {
        //
    }
}
