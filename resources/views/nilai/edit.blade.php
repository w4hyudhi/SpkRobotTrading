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
            Update
          </div>
          <h2 class="page-title">
            Penilaian
          </h2>
        </div>
        <!-- Page title actions -->

      </div>
    </div>
  </div>
  <div class="page-body">
    <div class="container-xl">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Penilaian</h3>
              </div>

              <div class="card-body">
                <form class="form" action="{{ route('nilai.update',1) }}" method="POST">
                    @csrf
                    @method('put')

                <div class="my-2">
                    <label for="tourism_object_id" class="form-label">Nama Robot Trading</label>
                    <select class="form-select @error('alternatif_id') 'is-invalid' : ''  @enderror" id="alternatif_id" name="alternatif_id" required>
                      @if ($alternatif_data->count())

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

                  @if ($nilai->count())

                  @foreach ($nilai as $nilai)
                  <input type="hidden" name="data_id[]" value="{{ $nilai->id }}">
                  @endforeach
                @else
                  <option disabled value="" selected>--NO DATA FOUND--</option>
                @endif

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

                                @foreach($criteria->sub as $crip)
                                    <option value="{{$crip->id}}" {{(in_array($crip->id,$data_sub))?'selected':''}}>{{$crip->nama_sub." - ".$crip->keterangan}}</option>
                                @endforeach
                            </select>


                        <input  type={{$criteria->tipe=='Select' ? ' hidden' : 'number'}}  name="nilai_value[]" class="form-control @error('nilai') is-invalid @enderror" placeholder="{{ __('nilai') }}"  required>



                      </div>
                    @endforeach
                  @endif
                  <div class="form-footer">
                    <button href="#" class="btn btn-primary ms-auto" type="submit">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                        Simpan
                      </button> </div>
                </form>
              </div>
            </div>
          </div>
    </div>
</div>
  @endsection
