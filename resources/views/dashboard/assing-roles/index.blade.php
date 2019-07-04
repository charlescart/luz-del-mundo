@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Header-->
    <header class="page-header p-2 d-none">
        <div class="container-fluid">
            <span class="p-0 lead"><i class="fa fa-globe mr-2" aria-hidden="true"></i> {{ __('Assing Roles') }}</span>
        </div>
    </header>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header p-2">
                    <i class="fa fa-globe mr-2" aria-hidden="true"></i>
                    <span class="align-middle">{{ __('Assing Roles') }}</span>
                </div>

                <div class="card-body p-0 mt-3">
                    <div class="col p-1 p-sm-2">
                        <table id="table_users" class="table dt-responsive table-striped  table-sm" width="100%">
                            <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>{{ __('Name') }}</th>
                                <th class="text-nowrap">{{ __('E-Mail Address') }}</th>
                                <th class="text-nowrap">{{ __('E-Mail Verified') }}</th>
                                <th>{{ __('Registed') }}</th>
                                <th class="text-rigth">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @includeWhen(Auth::user()->hasPermissionTo('assing-roles.edit'), 'dashboard.assing-roles.edit')
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
    {{--  Style Plugin TagEditor  --}}
    <link href="{{ secure_asset('css/common/tag-editor.css') }}" rel="stylesheet">
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
    {{--  Script de Plugin TagEditor--}}
    <script src="{{ secure_asset('js/common/tag-editor.min.js') }}" defer></script>
    {{--  Script de plugin caret --}}
    <script src="{{ secure_asset('js/common/caret.min.js') }}" defer></script>
    {{--  Script de la funcionalidad index --}}
    <script src="{{ secure_asset('js/dashboard/assing-roles/assing-roles-index.js') }}" defer></script>
@endpush
