<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use Brian2694\Toastr\Facades\Toastr;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kriteria::all()->sortBy('kode');
        return view('kriteria.index',compact('data'));
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
     * @param  \App\Http\Requests\StoreKriteriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKriteriaRequest $request)
    {

        $data=Kriteria::create( $request->all());
        if (!$data) {
            Toastr::error('Kriteria Gagal Disimpan', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        Toastr::success('Kriteria Disimpan', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Kriteria $kriteria)
    {
        dd($kriteria);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Kriteria $kriteria,$id)
    {
        // $data =  $kriteria->find($id);
        // dd($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKriteriaRequest  $request
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKriteriaRequest $request, Kriteria $kriteria)
    {


        $kriteria->update( $request->all());
        // if (!$kriteria) {
        //     Toastr::error('Kriteria Gagal Diubah', 'Error', ["positionClass" => "toast-top-right"]);
        //     return back();
        // }

        Toastr::success('Kriteria Diubah', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kriteria  $kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        if (!$kriteria) {
            Toastr::error('Kriteria Gagal Dihapus', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        Toastr::success('Kriteria Dihapus', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
