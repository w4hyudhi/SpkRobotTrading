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
            Data
          </div>
          <h2 class="page-title">
            Penilaian Robot Trading
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-12 col-md-auto ms-auto d-print-none">
          <div class="btn-list">

            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-nilai">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Tambah Penilaian
            </a>

          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="page-body">
        <div class="container-xl">

            <div class="card">
                <div class="table-responsive">
                  <table
      class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            @foreach($kriteria as $krit)
                                        <th>{{$krit->nama}}</th>
                                    @endforeach
                                    <th class="w-1"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($alternatif))
                        @foreach($alternatif as $data)
                            <tr>
                                <td>{{$data->kode_alternatif}}</td>
                                <td>{{$data->nama_alternatif}}</td>
                                @foreach($data->sub as $crip1)
                                    <td>{{$crip1->nama_sub}}</td>
                                @endforeach
                                <td class="text-center">

                                    <div class="btn-list flex-nowrap">
                                          {{-- <a class="btn" href="#"  data-bs-toggle="modal" data-bs-target="#modal-nilai{{$data->id}}">
                                            Edit
                                          </a> --}}
                                          <a class="btn" href="{{ route('nilai.edit', $data->id) }}">
                                            Edit
                                          </a>
                                          <form action="{{ route('nilai.destroy', $data->id) }}" type="submit" method='post' >
                                            @csrf
                                            @method('delete')
                                          <button  type="submit" class="btn">Hapus</button>
                                        </form>

                                    </div>

                            </td>
                            </tr>

                            <div class="modal modal-blur fade" id="modal-nilai{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Tambah Penilaian</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="form" action="#" method="POST">
                                        @csrf

                                    <div class="modal-body">



                                            @if ($kriteria->count())
                                            @foreach ($kriteria as $key => $criteria)
                                              {{-- <input type="hidden" name="criteria_id[]" value="{{ $criteria->id }}"> --}}
                                              <input type="hidden" name="criteria_id[]" value="{{ $criteria->id }}">

                                              <div class="my-2">
                                                <label class="form-label">
                                                  {{ $criteria->nama }}
                                                    <a href="#" class="text-muted" data-toggle="tooltip" title="{{$criteria->keterangan}}">
                                                    <span class="badge bg-primary ms-auto rounded-circle">?</span>
                                                    </a>

                                                </label>



                                                    <select name="alternative_value[]" class="form-control" {{$criteria->tipe=='Input' ? ' hidden' : ''}}>
                                                        <option value="">-- Pilih {{$criteria->nama}}--</option>
                                                        @foreach($criteria->sub as $crip)
                                                            <option value="{{$crip->id}}" {{(in_array($crip->id,$data_sub))?'selected':''}}>{{$crip->nama_sub." - ".$crip->keterangan}}</option>
                                                        @endforeach
                                                    </select>


                                                <input  type={{$criteria->tipe=='Select' ? ' hidden' : 'number'}}  name="nilai_value[]" class="form-control @error('nilai') is-invalid @enderror" placeholder="{{ __('nilai') }}"  required>



                                              </div>
                                            @endforeach
                                          @endif
                                    </div>

                                    <div class="modal-footer">
                                      <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                                        Batal
                                      </a>
                                      <button href="#" class="btn btn-primary ms-auto" type="submit">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                        Simpan
                                      </button>
                                    </div>
                                </form>
                                  </div>
                                </div>
                              </div>

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


    <div class="modal modal-blur fade" id="modal-nilai" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Penilaian</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="{{ route('nilai.store') }}" method="POST">
                @csrf

            <div class="modal-body">

                <div class="my-2">
                    <label for="tourism_object_id" class="form-label">Nama Robot Trading</label>
                    <select class="form-select @error('alternatif_id') 'is-invalid' : ''  @enderror" id="alternatif_id" name="alternatif_id" required>
                      @if ($alternatif_data->count())
                        <option disabled selected>--Choose One--</option>
                        @foreach ($alternatif_data as $alternatif_data)
                          <option value="{{ $alternatif_data->id }}">
                            {{ $alternatif_data->nama_alternatif}}
                          </option>
                        @endforeach
                      @else
                        <option disabled value="" selected>--NO DATA FOUND--</option>
                      @endif
                    </select>

                    @error('alternatif_id')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>

                    @if ($kriteria->count())
                    @foreach ($kriteria as $key => $criteria)
                      {{-- <input type="hidden" name="criteria_id[]" value="{{ $criteria->id }}"> --}}
                      <input type="hidden" name="criteria_id[]" value="{{ $criteria->id }}">

                      <div class="my-2">
                        <label class="form-label">
                          {{ $criteria->nama }}
                            <a href="#" class="text-muted" data-toggle="tooltip" title="{{$criteria->keterangan}}">
                            <span class="badge bg-primary ms-auto rounded-circle">?</span>
                            </a>

                        </label>



                            <select name="alternative_value[]" class="form-control" {{$criteria->tipe=='Input' ? ' hidden' : ''}}>
                                <option value="">-- Pilih {{$criteria->nama}}--</option>
                                @foreach($criteria->sub as $crip)
                                    <option value="{{$crip->id}}">{{$crip->nama_sub." - ".$crip->keterangan}}</option>
                                @endforeach
                            </select>


                        <input  type={{$criteria->tipe=='Select' ? ' hidden' : 'number'}}  name="nilai_value[]" class="form-control @error('nilai') is-invalid @enderror" placeholder="{{ __('nilai') }}"  required>



                      </div>
                    @endforeach
                  @endif
            </div>

            <div class="modal-footer">
              <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                Batal
              </a>
              <button href="#" class="btn btn-primary ms-auto" type="submit">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Simpan
              </button>
            </div>
        </form>
          </div>
        </div>
      </div>
@endsection
