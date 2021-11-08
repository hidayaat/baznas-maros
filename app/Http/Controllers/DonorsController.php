<?php

namespace App\Http\Controllers;

use App\Models\Donors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class DonorsController extends Controller
{
    private $perPage = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Donors::paginate($this->perPage);
        return view('donors.index', [
            'donors' => $data
        ])->with('i', ($request->input('page', 1) - 1) * $this->perPage);
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
     * @param  \App\Models\Donors  $Donors
     * @return \Illuminate\Http\Response
     */
    public function show(Donors $Donors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donors  $Donors
     * @return \Illuminate\Http\Response
     */
    public function edit(Donors $Donors)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donors  $Donors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donors $Donors)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donors  $Donors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donors $Donors)
    {
        //
    }
}
