@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Header-->
    <header class="page-header p-2 mb-3">
        <div class="container-fluid p-0">
            <i class="fa fa-globe mr-2" aria-hidden="true"></i>
            <span class="p-0 align-middle">{{ __('Set up my church') }}</span>
        </div>
    </header>
    <div class="container container-churches">
        <div class="row p-1 pb-5">
            @include('dashboard.church.partials.church')
        </div>
    </div>

    {{--  @includeWhen(Auth::user()->hasPermissionTo('assing-roles.edit'), 'dashboard.assing-roles.edit')  --}}
@endsection


@push('styles')
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
    {{--  Style Plugin izi-toast  --}}
    <link href="{{ secure_asset('css/plugins/izi-toast/izi-toast.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    {{--  Plugin Blockui  --}}
    <script src="{{ secure_asset('js/plugins/blockui/blockui.js') }}" defer></script>
    {{--  Plugin button loader  --}}
    <script src="{{ secure_asset('js/plugins/button-loader/button-loader.min.js') }}" defer></script>
    {{--  Plugin izi-toast  --}}
    <script src="{{ secure_asset('js/plugins/izi-toast/izi-toast.min.js') }}" defer></script>
    <!-- Functions comunes-->
    <script src="{{ secure_asset('js/common/common-functions.js') }}" defer></script>
    {{--  Script de la funcionalidad index --}}
     <script src="{{ secure_asset('js/dashboard/churches/churches-index.js') }}" defer></script>
@endpush
