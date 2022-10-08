<?php

namespace App\Http\Controllers;

use App\Models\NilaiAlternatif;
use App\Http\Requests\StoreNilaiAlternatifRequest;
use App\Http\Requests\UpdateNilaiAlternatifRequest;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Brian2694\Toastr\Facades\Toastr;

class NilaiAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        // $alternatif = Alternatif::all();

        $nilai = NilaiAlternatif::all();

        $usedIdsFix = [];

        $data_sub = [];
        foreach ($nilai as $usedId) {
          array_push($usedIdsFix, $usedId->alternatif_id);
          array_push($data_sub, $usedId->subkriteria_id);
        }



        //  dd($data_sub);

        $alternatif_data = Alternatif::whereNotIn('id', $usedIdsFix)->get();
        $alternatif = Alternatif::whereIn('id', $usedIdsFix)
        ->get();
        // dd($alternatives);




        return view('nilai.index',compact('kriteria','alternatif','alternatif_data','data_sub'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Alternatif $alternatif)
    {
        $kriteria = Kriteria::all();
           dd($alternatif);
         return view('nilai.add',compact('alternatif','kriteria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNilaiAlternatifRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNilaiAlternatifRequest $request)


    {
        // dd($request->id);
        foreach ( $request->criteria_id as $key => $criteriaId) {
            $data = [
              'alternatif_id' => $request->alternatif_id,
              'subkriteria_id' => $request->alternative_value[$key],
              'nilai' => $request->nilai_value[$key],
            ];
           NilaiAlternatif::create($data);
          }
          Toastr::success('Nilai Disimpan', 'Berhasil', ["positionClass" => "toast-top-right"]);
          return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NilaiAlternatif  $nilaiAlternatif
     * @return \Illuminate\Http\Response
     */
    public function show(NilaiAlternatif $nilaiAlternatif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NilaiAlternatif  $nilaiAlternatif
     * @return \Illuminate\Http\Response
     */
    public function edit($nilai1)
    {
        // dd($nilai1);
        $kriteria = Kriteria::all();
        $alternatif_data = Alternatif::where('id',$nilai1)
        ->get();
        $nilai = NilaiAlternatif::where('alternatif_id',$nilai1)
        ->get();


        $data_sub = [];
        $data_id = [];
        foreach ($nilai as $usedId) {
          array_push($data_sub, $usedId->subkriteria_id);
          array_push($data_id, $usedId->id);
        }


        return view('nilai.edit',compact('kriteria','alternatif_data','data_sub','nilai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNilaiAlternatifRequest  $request
     * @param  \App\Models\NilaiAlternatif  $nilaiAlternatif
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNilaiAlternatifRequest $request, NilaiAlternatif $nilaiAlternatif)
    {
        // dd($request);
         // dd($request->id);
         foreach ( $request->criteria_id as $key => $criteriaId) {
            $data = [
              'subkriteria_id' => $request->alternative_value[$key],
              'nilai' => $request->nilai_value[$key],
            ];
           NilaiAlternatif::where('id', $request->data_id[$key])
           ->update($data);
          }
          Toastr::success('Nilai DiUpdate', 'Berhasil', ["positionClass" => "toast-top-right"]);
          return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NilaiAlternatif  $nilaiAlternatif
     * @return \Illuminate\Http\Response
     */
    public function destroy($nilai1)
    {
        // dd($nilai1);
        $nilai = NilaiAlternatif::where('alternatif_id', $nilai1)
        ->delete();

        if (!$nilai) {
            Toastr::error('Alternatif Gagal Dihapus', 'Error', ["positionClass" => "toast-top-right"]);
            return back();
        }

        Toastr::success('Alternatif Dihapus', 'Berhasil', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
