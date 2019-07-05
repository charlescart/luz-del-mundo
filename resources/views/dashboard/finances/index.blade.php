@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Header-->
    <header class="page-header p-2 d-none">
        <div class="container-fluid">
            <span class="p-0 lead"><i class="fa fa-globe mr-2" aria-hidden="true"></i> {{ __('Finances') }}</span>
        </div>
    </header>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header p-2">
                    <i class="fa fa-globe mr-2" aria-hidden="true"></i>
                    <span class="align-middle">{{ __('Finances') }}</span>
                        <a href="#!" class="btn btn-outline-primary rounded-0 btn-sm float-right" style="min-width: 4rem;" data-toggle="modal" data-target="#modal-finances-create" data-form="form-finances-create" data-title="{{ __('Create a :text', ['text' => __('Amount')]) }}">{{ __('btn.create') }}</a>
                </div>

                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex bd-highlight w-100">
                                <div class="col-12 col-md bd-highlight">
                                    <p class="text-uppercase text-center mb-1 text-xsmall">{{__('Tithe')}}</p>
                                    @if($tithe)
                                        @foreach($tithe as $item)
                                            <p class="text-center text-nowrap mb-1">{{__($item['color'])}} {{$item['amount']}} {{$item['code']}}</p>
                                        @endforeach
                                    @endif
                                </div>
                                @if($funds)
                                    @foreach($funds as $key => $fund)
                                        <div class="col-12 col-md align-self-stretch p-0 bd-highlight">
                                            <p class="text-uppercase text-center mb-1 text-xsmall">{{$key}}</p>
                                            @foreach($fund as $item)
                                                <p class="text-nowrap text-center mb-0" style="color: {{($item['currency'] == 'USD') ? '#0e982e' : '#ca9907'}} !important;">{{$item['currency']}}</p>
                                                <p class="text-center text-nowrap mb-1">
                                                    <span class="text-success"><i class="fa fa-arrow-down" aria-hidden="true"></i> {{$item['have']}}</span>
                                                    <span class="text-danger"><i class="fa fa-arrow-up" aria-hidden="true"></i> {{$item['debit']}}</span>
                                                    <span style="color: #055a19 !important;"><i class="fa fa-money" aria-hidden="true"></i> {{$item['capital']}}</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col p-1 p-sm-2 border-top">
                        <table id="table_finance" class="table dt-responsive table-striped  table-sm" width="100%">
                            <thead class="thead-light">
                            <tr class="text-center">
                                <th>Id</th>
                                <th>{{ __('Amount') }}</th>
                                <th>{{ __('Tithe') }}</th>
                                <th>{{ __('Debt') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th class="text-rigth">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.finances.create')
    @includeWhen(Auth::user()->hasPermissionTo('roles.show'), 'dashboard.roles.show')
@endsection


@push('styles')
    {{--Styles DataTables--}}
    <link href="{{ secure_asset('css/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ secure_asset('css/dashboard/fontastic.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ secure_asset('css/dashboard/dashboard-theme.css') }}" id="theme-stylesheet">
    <!-- Font Roboto-->
    <link href="{{ secure_asset('css/fonts-roboto.css') }}" rel="stylesheet">
    <!-- Style propios-->
    <link href="{{ secure_asset('css/app-propios.css') }}" rel="stylesheet">
    {{--  Style Blockui  --}}
    <link href="{{ secure_asset('css/plugins/blockui/blockui.css') }}" rel="stylesheet">
    {{--  Style button loader  --}}
    <link href="{{ secure_asset('css/plugins/button-loader/button-loader.css') }}" rel="stylesheet">
    {{--  Style Plugin izi-toast  --}}
    <link href="{{ secure_asset('css/plugins/izi-toast/izi-toast.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    {{-- Plugin DataTables --}}
    <script src="{{ secure_asset('js/plugins/datatables/datatables.min.js') }}" defer></script>
    {{--  Plugin Blockui  --}}
    <script src="{{ secure_asset('js/plugins/blockui/blockui.js') }}" defer></script>
    {{--  Plugin button loader  --}}
    <script src="{{ secure_asset('js/plugins/button-loader/button-loader.min.js') }}" defer></script>
    {{--  Plugin izi-toast  --}}
    <script src="{{ secure_asset('js/plugins/izi-toast/izi-toast.min.js') }}" defer></script>
    <!-- Functions comunes-->
    <script src="{{ secure_asset('js/common/common-functions.js') }}" defer></script>
    {{--  Script de la funcionalidad index --}}
    <script src="{{ secure_asset('js/dashboard/finances/finances-index.js') }}" defer></script>
@endpush
