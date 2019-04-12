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
                        <a href="#!" class="btn btn-outline-primary rounded-0 btn-sm float-right" style="min-width: 4rem;" data-toggle="modal" data-target="#modal-finances-create" data-form="form-finances-create" data-title="{{ __('Create a :text', ['text' => __('Finances')]) }}">{{ __('btn.create') }}</a>
                </div>

                <div class="card-body p-0 mt-3">
                    <div class="row bg-danger">
                        <div class="col-6 col-md bg-gray">
                            {{__('Tithe')}}:
                            @if($tithe)
                                @foreach($tithe as $item)
                                    <span class="text-nowrap {{$item['color']}}">{{$item['amount']}} {{$item['code']}}</span>
                                    {{(!$loop->last) ? '/' : ''}}
                                @endforeach
                            @endif
                        </div>
                        <div class="col-6 col-md bg-info">
                            {{__('Capital')}}:
                        </div>
                        <div class="col-6 col-md bg-orange">
                            {{__('Debt')}}:
                        </div>
                        <div class="col-6 col-md bg-danger">
                            {{__('5% Income')}}:
                        </div>
                    </div>
                    <div class="col p-1 p-sm-2">
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
    <link href="{{ asset('css/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="{{ asset('css/dashboard/fontastic.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/dashboard/dashboard-theme.css') }}" id="theme-stylesheet">
    <!-- Font Roboto-->
    <link href="{{ asset('css/fonts-roboto.css') }}" rel="stylesheet">
    <!-- Style propios-->
    <link href="{{ asset('css/app-propios.css') }}" rel="stylesheet">
    {{--  Style Blockui  --}}
    <link href="{{ asset('css/plugins/blockui/blockui.css') }}" rel="stylesheet">
    {{--  Style button loader  --}}
    <link href="{{ asset('css/plugins/button-loader/button-loader.css') }}" rel="stylesheet">
    {{--  Style Plugin izi-toast  --}}
    <link href="{{ asset('css/plugins/izi-toast/izi-toast.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    {{-- Plugin DataTables --}}
    <script src="{{ asset('js/plugins/datatables/datatables.min.js') }}" defer></script>
    {{--  Plugin Blockui  --}}
    <script src="{{ asset('js/plugins/blockui/blockui.js') }}" defer></script>
    {{--  Plugin button loader  --}}
    <script src="{{ asset('js/plugins/button-loader/button-loader.min.js') }}" defer></script>
    {{--  Plugin izi-toast  --}}
    <script src="{{ asset('js/plugins/izi-toast/izi-toast.min.js') }}" defer></script>
    <!-- Functions comunes-->
    <script src="{{ asset('js/common/common-functions.js') }}" defer></script>
    {{--  Script de la funcionalidad index --}}
    <script src="{{ asset('js/dashboard/finances/finances-index.js') }}" defer></script>
@endpush
