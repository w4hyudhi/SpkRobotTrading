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
            SubKriteria
          </div>
          <h2 class="page-title">
            {{$data->nama}}
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-12 col-md-auto ms-auto d-print-none">
          <div class="btn-list">

            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Tambah SubKriteria
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
                        <th>id</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th class="w-1"></th>
                      </tr>
                    </thead>
                    <tbody>

                        @if(!empty($data))
                        @foreach($data->sub as $subdata)
                            <tr>
                                <td>{{$subdata->id}}</td>
                                <td>{{$subdata->nama_sub}}</td>
                                <td>{{$subdata->nilai_sub}}</td>
                                <td class="text-center">

                                        <div class="btn-list flex-nowrap">
                                              <a class="btn" href="#"  data-bs-toggle="modal" data-bs-target="#modal-report{{$subdata->id}}">
                                                Edit
                                              </a>
                                              <form action="{{ route('sub.destroy', $subdata->id) }}" type="submit" method='post' >
                                                @csrf
                                                @method('delete')
                                              <button  type="submit" class="btn">Hapus</button>
                                            </form>

                                        </div>

                                </td>
                            </tr>


    <div class="modal modal-blur fade" id="modal-report{{$subdata->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ubah Sub-Kriteria</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="{{ route('sub.update',$subdata->id) }}" method="POST">
                @csrf
                @method('put')
            <div class="modal-body">

                    @csrf
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Nama SubKriteria') }}</label>
                        <input type="text" name="nama_sub" class="form-control @error('nama_sub') is-invalid @enderror" placeholder="{{ __('Nama SubKriteria') }}" value="{{ $subdata->nama_sub }}" required>
                    </div>
                    @error('nama_sub')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror



                    <div class="mb-3">
                        <label class="form-label required">{{ __('Nilai SubKriteria') }}</label>
                        <input type="number" step=any name="nilai_sub"  class="form-control @error('nilai_sub') is-invalid @enderror" placeholder="{{ __('Nilai SubKriteria') }}" value="{{ $subdata->nilai_sub }}" required>
                    </div>
                    @error('nilai_sub')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror


                  <div class="mb-3">
                      <label class="form-label required">Keterangan</label>
                      <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"   rows="3" required>{{ $subdata->keterangan }}</textarea>
                  </div>
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
                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                        </tr>
                    @endif
                    </tbody>
                  </table>
                </div>
              </div>


        </div>
    </div>

    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah SubKriteria</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="{{ route('kriteria.sub.store',$data->id) }}" method="POST">
            <div class="modal-body">

                    @csrf

                <div class="mb-3">
                    <label class="form-label required">{{ __('Nama SubKriteria') }}</label>
                    <input type="text" name="nama_sub" class="form-control @error('nama_sub') is-invalid @enderror" placeholder="{{ __('Nama SubKriteria') }}" value="{{ old('nama_sub') }}" required>
                </div>
                @error('nama_sub')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror



                <div class="mb-3">
                    <label class="form-label required">{{ __('Nilai SubKriteria') }}</label>
                    <input type="number" step=any name="nilai_sub"  class="form-control @error('nilai_sub') is-invalid @enderror" placeholder="{{ __('Nilai SubKriteria') }}" value="{{ old('nilai_sub') }}" required>
                </div>
                @error('nilai_sub')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror


              <div class="mb-3">
                  <label class="form-label required">Keterangan</label>
                  <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"   rows="3" required>{{ old('keterangan') }}</textarea>
              </div>

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
