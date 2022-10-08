<?php

namespace App\Http\Controllers;

use App\Models\Subkriteria;
use App\Http\Requests\StoreSubkriteriaRequest;
use App\Http\Requests\UpdateSubkriteriaRequest;
use App\Models\Kriteria;
use Brian2694\Toastr\Facades\Toastr;

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Kriteria $kriteria)
    {
        $data=$kriteria;
        //  dd($data);
        return view('sub.index',compact('data'));
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
     * @param  \App\Http\Requests\StoreSubkriteriaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubkriteriaRequest $request, Kriteria $kriteria)
    {
        $data_form = $request->all();
        $data_form['kriteria_id'] = $kriteria->id;
        // dd($data_form);

        $data=Subkriteria::create( $data_form);

        if (!$data) {
            Toastr::error('SubKriteria Gagal Disimpan', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }
        Toastr::success('SubKriteria Disimpan', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Subkriteria $subkriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkriteria $subkriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubkriteriaRequest  $request
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubkriteriaRequest $request, Subkriteria $sub)
    {

        $sub->update( $request->all());
        if (!$sub) {
            Toastr::error('SubKriteria Gagal Diubah', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        Toastr::success('SubKriteria Diubah', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkriteria  $subkriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkriteria $sub)
    {
        $sub->delete();
        if (!$sub) {
            Toastr::error('SubKriteria Gagal Dihapus', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        Toastr::success('SubKriteria Dihapus', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
