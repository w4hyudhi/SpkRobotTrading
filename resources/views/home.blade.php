@extends('layouts.app')

@section('custom_styles')

@endsection

@section('content')
    <div class="page-body">
        <div class="container-xl d-flex flex-column justify-content-center">
            <div class="empty">
              {{-- <div class="empty-img"><img src="{{ url('img/logo.png') }}" height="200" alt="">
              </div>
              <H1 >SELAMAT DATANG DI</H1>
              <H2 class="empty-subtitle">
                SISTEM PENDUKUNG KEPUTUSAN <BR>
PEMILIHAN ROBOT TRADING FOREX MENGGUNAKAN METODE<BR>
SIMPLE ADDITIVE WEIGHTING

              </H2> --}}

              <div class="alert alert-success">
                <div class="empty-img"><img src="{{ url('img/logo.png') }}" height="200" alt="">
                </div>
                <div class="alert-title">
                    {{ __('SELAMAT DATANG DI') }}
                </div>
                <div class="text-muted">
                    SISTEM PENDUKUNG KEPUTUSAN <BR>
                        PEMILIHAN ROBOT TRADING FOREX MENGGUNAKAN METODE<BR>
                        SIMPLE ADDITIVE WEIGHTING

                </div>
            </div>

            </div>
          </div>
    </div>
@endsection
