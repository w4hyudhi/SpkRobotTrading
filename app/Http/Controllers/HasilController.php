<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index()
    {

        $kriteria = Kriteria::all()->sortBy('kode');
        $alternatif = Alternatif::all()->sortBy('kode_alternatif');
        $kode_krit = [];
        foreach ($kriteria as $krit)
        {
            $kode_krit[$krit->id] = [];
            foreach ($alternatif as $al)
            {
                foreach ($al->sub as $crip)
                {
                        if ($crip->kriteria->id == $krit->id)
                        {
                            $kode_krit[$krit->id][] = $crip->nilai_sub;
                        }
                }
            }

            if ($krit->atribut == 'cost')
            {
                $kode_krit[$krit->id] = min($kode_krit[$krit->id]);
            } elseif ($krit->atribut == 'benefit')
            {
                $kode_krit[$krit->id] = max($kode_krit[$krit->id]);
            }
        };
//        return json_encode($kode_krit);
        return view('hasil.index',[
            'kriteria'      => $kriteria,
            'alternatif'    => $alternatif,
            'kode_krit'     => $kode_krit
        ]);
    }
}
