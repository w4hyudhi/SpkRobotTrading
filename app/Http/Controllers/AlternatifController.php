<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Http\Requests\StoreAlternatifRequest;
use App\Http\Requests\UpdateAlternatifRequest;
use App\Models\Kriteria;
use Brian2694\Toastr\Facades\Toastr;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $data = Alternatif::all()->sortByDesc('id');
        //  dd($kriteria);
        return view('alternatif.index',compact('data','kriteria'));
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
     * @param  \App\Http\Requests\StoreAlternatifRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlternatifRequest $request)
    {
        $data=Alternatif::create( $request->all());
        if (!$data) {
            Toastr::error('Robot Trading Gagal Disimpan', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        Toastr::success('Robot Trading Disimpan', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function show(Alternatif $alternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function edit(Alternatif $alternatif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAlternatifRequest  $request
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlternatifRequest $request, Alternatif $alternatif)
    {
        $alternatif->update( $request->all());
        if (!$alternatif) {
            Toastr::error('Robot Trading Gagal Diubah', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        Toastr::success('Robot Trading Diubah', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alternatif  $alternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();
        if (!$alternatif) {
            Toastr::error('Alternatif Gagal Dihapus', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        Toastr::success('Alternatif Dihapus', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
