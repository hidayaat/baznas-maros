<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class DonorController extends Controller
{
    private $perPage = 15;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $donors = [];
        if ($request->has('keyword')) {
            $donors = Donor::where('first_name', 'LIKE', "%{$request->keyword}%")
            ->orWhere('last_name', 'LIKE', "%{$request->keyword}%")->latest()
            ->paginate($this->perPage);
        } else {
            $donors = Donor::latest()->paginate($this->perPage);
        }
        return view('donors.index', [
            'donors' => $donors->appends(['keyword' => $request->keyword])
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
     * @param  \App\Models\Donor  $Donor
     * @return \Illuminate\Http\Response
     */
    public function show(Donor $donor)
    {
        return view('donors.show', [
            'donor' => $donor
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donor  $Donor
     * @return \Illuminate\Http\Response
     */
    public function edit(Donor $donor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donor  $Donor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donor $donor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donor  $Donor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donor $donor)
    {
        try {
            $donor->delete();
            Alert::success('Hapus Data Donatur', 'Berhasil');
        } catch (\Throwable $th) {
            Alert::error('Hapus Data Donatur', 'Gagal'.$th->getMessage());
        }

        return redirect()->back();
    }
}
