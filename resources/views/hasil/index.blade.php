@extends('layouts.app')

@section('custom_styles')

@endsection

@section('content')

<div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Hasil
          </div>
          <h2 class="page-title">
            Perihitungan SAW Robot Trading
          </h2>
        </div>
      </div>
    </div>
  </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 card-deck mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Hasil Analisa</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center col-md-2">Nama</th>
                                    @foreach($kriteria as $krit)
                                        <th class="text-center col-md-2">{{$krit->nama}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($alternatif))
                                    @foreach($alternatif as $data)
                                        <tr>
                                            <td>{{$data->nama_alternatif}}</td>
                                            @foreach($data->sub as $sub)
                                                <td>{{$sub->nama_sub}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{(count($kriteria)+1)}}" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center col-md-2">Kode</th>
                                    @foreach($kriteria as $krit)
                                        <th class="text-center col-md-2">{{$krit->kode}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($alternatif))
                                    @foreach($alternatif as $data)
                                        <tr>
                                            <td>{{$data->kode_alternatif}}</td>
                                            @foreach($data->sub as $sub)
                                                <td>{{$sub->nilai_sub}}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{(count($kriteria)+1)}}" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 card-deck mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">Normalisasi</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center col-md-2">Kode</th>
                                    <?php $bobot = [] ?>
                                    @foreach($kriteria as $krit)
                                        <?php $bobot[$krit->id] = $krit->bobot ?>
                                        <th class="text-center col-md-2">{{$krit->kode}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($alternatif))
                                    <?php $rangking = []; ?>
                                    @foreach($alternatif as $data)
                                        <tr>
                                            <td>{{$data->kode_alternatif}}</td>
                                            <?php $total = 0;?>
                                            @foreach($data->sub as $sub)
                                                @if($sub->kriteria->atribut == 'cost')
                                                    <?php $normalisasi = ($kode_krit[$sub->kriteria->id]/$sub->nilai_sub); ?>
                                                @elseif($sub->kriteria->atribut == 'benefit')
                                                    <?php $normalisasi = ($sub->nilai_sub/$kode_krit[$sub->kriteria->id]); ?>
                                                @endif
                                                    <?php $total = $total+($bobot[$sub->kriteria->id]*$normalisasi);?>
                                                    <td>{{$normalisasi}}</td>
                                            @endforeach
                                            <?php $rangking[] = [
                                                'kode'  => $data->kode_alternatif,
                                                'nama'  => $data->nama_alternatif,
                                                'total' => $total
                                            ]; ?>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="{{(count($kriteria)+1)}}" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 card-deck mt-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Ranking</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Total</th>
                                        <th>Ranking</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                usort($rangking, function($b, $a)
                                {
                                    return $a['total']<=>$b['total'];
                                });
                                //   rsort($rangking);
                                $a = 1;
                                ?>
                                    @foreach($rangking as $t)
                                        <tr>
                                            <td>{{$t['kode']}}</td>
                                            <td>{{$t['nama']}}</td>
                                            <td>{{$t['total']}}</td>
                                            <td>{{$a++}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
