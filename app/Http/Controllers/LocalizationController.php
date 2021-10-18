<?php

namespace App\Http\Controllers;

class LocalizationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //cara 1 Invokable
    // public function __invoke($language = 'en')
    // {
    //     request()->session()->put('locale', $language);
    //     return redirect()->back();
    // }

    //cara 2 method biasa
    public function switch($language = 'id')
    {
        request()->session()->put('locale', $language);
        return redirect()->back();
    }
}
