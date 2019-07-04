@extends('dashboard.layouts.app')

@section('content')
    <!-- Page Header-->
    <header class="page-header p-2 d-none">
        <div class="container-fluid">
            <span class="p-0 lead"><i class="fa fa-globe mr-2" aria-hidden="true"></i> {{ __('Roles') }}</span>
        </div>
    </header>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header p-2">
                    <i class="fa fa-globe mr-2" aria-hidden="true"></i>
                    <span class="align-middle">{{ __('Roles') }} / {{ __('Edit') }}</span>
                    @if(Auth::user()->hasPermissionTo('roles.edit'))
                        <a href="#!" class="btn btn-outline-primary rounded-0 btn-sm float-right"
                           style="min-width: 4rem;" data-toggle="modal"
                           data-target="#modal-add-permission">{{ __('btn.add_permission') }}</a>
                    @endif
                </div>

                <div class="card-body p-0 mt-3">
                    <div class="col p-1 p-sm-2">

                        <form class="form-material text-secondary" id="form-roles-edit" data-id="{{ $role->id }}">

                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control input-material" required autocomplete="off" value="{{ $role->name }}">
                                        <label for="name" class="col-form-label text-md-right label-material"> {{ __('form.name') }} </label>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" name="guard_name" class="form-control input-material" required value="{{ $role->guard_name }}">
                                        <label for="guard_name" class="col-form-label text-md-right label-material">{{ __('form.guard name') }}</label>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div class="col text-center">
                            <span class="lead">{{ __(':role role permission list', ['role' => $role->name]) }}</span>
                        </div>

                        <table id="table_permissions" class="table dt-responsive table-striped  table-sm" width="100%">
                            <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Guard') }}</th>
                                <th>{{ __('Date') }}</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    @includeWhen(Auth::user()->hasPermissionTo('roles.edit'), 'dashboard.roles.add-permission')
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
    <script src="{{ secure_asset('js/dashboard/roles/roles-edit.js') }}" defer></script>
@endpush
