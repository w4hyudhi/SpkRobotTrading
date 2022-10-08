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
            Kriteria
          </h2>
        </div>
        <!-- Page title actions -->
        <div class="col-12 col-md-auto ms-auto d-print-none">
          <div class="btn-list">

            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-report">
              <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
              Tambah Kriteria
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
                        <th>Atribut</th>
                        <th>Bobot</th>
                        <th>Tipe</th>
                        <th class="w-1"></th>
                      </tr>
                    </thead>
                    <tbody>

                        @if(!empty($data))
                        @foreach($data as $data)
                            <tr>
                                <td>{{$data->kode}}</td>
                                <td>{{$data->nama}}</td>
                                <td>{{$data->atribut}}</td>
                                <td>{{$data->bobot}}</td>
                                <td>{{$data->tipe}}</td>
                                <td class="text-center">

                                        <div class="btn-list flex-nowrap">

                                                <a class="btn" href="{{route('kriteria.sub.index',$data->id)}}">
                                                    SubKriteria
                                                  </a>
                                              <a class="btn" href="#"  data-bs-toggle="modal" data-bs-target="#modal-report{{$data->id}}">
                                                Edit
                                              </a>
                                              <form action="{{ route('kriteria.destroy', $data->id) }}" type="submit" method='post' >
                                                @csrf
                                                @method('delete')
                                              <button  type="submit" class="btn">Hapus</button>
                                            </form>

                                        </div>

                                </td>
                            </tr>


    <div class="modal modal-blur fade" id="modal-report{{$data->id}}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Ubah Kriteria</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="{{ route('kriteria.update',$data->id) }}" method="POST">
                @csrf
                @method('put')
            <div class="modal-body">

                    @csrf
                <div class="mb-3">
                    <label class="form-label required">{{ __('Kode Kriteria') }}</label>
                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" placeholder="{{ __('Kode Kriteria') }}" value="{{ $data->kode }}" required>
                </div>
                @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label required">{{ __('Nama Kriteria') }}</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="{{ __('Nama Kriteria') }}" value="{{$data->nama }}" required>
                </div>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror


              <label class="form-label required">Jenis</label>
              <div class="form-selectgroup-boxes row mb-3">
                <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="atribut" value="benefit" class="form-selectgroup-input" {{($data->atribut == 'benefit') ? ' checked' : ''}} checked >
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                      <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                      </span>
                      <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Benefit</span>
                        <span class="d-block text-muted">Semakin tinggi nilai/bobotnya maka semakin bagus value-nya</span>
                      </span>
                    </span>
                  </label>
                </div>
                <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="atribut" value="cost" class="form-selectgroup-input" {{($data->atribut == 'cost') ? ' checked' : ''}}>
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                      <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                      </span>
                      <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Cost</span>
                        <span class="d-block text-muted">Semakin besar nilai/bobotnya maka semakin rendah value-nya</span>
                      </span>
                    </span>
                  </label>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label class="form-label required">{{ __('Bobot kriteria') }}</label>
                        <input type="number" step=any name="bobot"  class="form-control @error('bobot') is-invalid @enderror" placeholder="{{ __('Bobot Kriteria') }}" value="{{ $data->bobot}}" required>
                    </div>
                    @error('bobot')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select"  name="tipe" >
                            <option value="Select" {{($data->tipe == 'Select') ? ' selected' : ''}}>Select</option>
                            <option value="Input" {{($data->tipe == 'Input') ? ' selected' : ''}}>Input</option>
                        </select>
                      </div>
                </div>
              </div>




              <div class="mb-3">
                  <label class="form-label required">Keterangan</label>
                  <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan"   rows="3" required>{{$data->keterangan }}</textarea>
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
              <h5 class="modal-title">Tambah Kriteria</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form" action="{{ route('kriteria.store') }}" method="POST">
            <div class="modal-body">

                    @csrf
                <div class="mb-3">
                    <label class="form-label required">{{ __('Kode Kriteria') }}</label>
                    <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" placeholder="{{ __('Kode Kriteria') }}" value="{{ old('kode') }}" required>
                </div>
                @error('kode')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="mb-3">
                    <label class="form-label required">{{ __('Nama Kriteria') }}</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="{{ __('Nama Kriteria') }}" value="{{ old('nama') }}" required>
                </div>
                @error('nama')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror


              <label class="form-label required">Jenis</label>
              <div class="form-selectgroup-boxes row mb-3">
                <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="atribut" value="benefit" class="form-selectgroup-input" {{(old('atribut') == 'benefit') ? ' checked' : ''}} checked >
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                      <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                      </span>
                      <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Benefit</span>
                        <span class="d-block text-muted">Semakin tinggi nilai/bobotnya maka semakin bagus value-nya</span>
                      </span>
                    </span>
                  </label>
                </div>
                <div class="col-lg-6">
                  <label class="form-selectgroup-item">
                    <input type="radio" name="atribut" value="cost" class="form-selectgroup-input" {{(old('atribut') == 'cost') ? ' checked' : ''}}>
                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                      <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                      </span>
                      <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Cost</span>
                        <span class="d-block text-muted">Semakin besar nilai/bobotnya maka semakin rendah value-nya</span>
                      </span>
                    </span>
                  </label>
                </div>
              </div>



                <div class="row">
                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label class="form-label required">{{ __('Bobot kriteria') }}</label>
                            <input type="number" step=any name="bobot"  class="form-control @error('bobot') is-invalid @enderror" placeholder="{{ __('Bobot Kriteria') }}" value="{{ old('bobot') }}" required>
                        </div>
                        @error('bobot')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-lg-4">
                      <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select"  name="tipe" >
                            <option value="Select" {{(old('tipe') == 'Select') ? ' selected' : ''}}>Select</option>
                            <option value="Input" {{(old('tipe') == 'Input') ? ' selected' : ''}}>Input</option>
                        </select>
                      </div>
                    </div>
                  </div>


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
