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
                    <span class="align-middle">{{ __('Roles') }}</span>
                    <a href="{{ route('products.create') }}" class="btn btn-outline-primary rounded-0 btn-sm float-right" style="min-width: 4rem;">{{ __('btn.create') }}</a>
                </div>

                <div class="card-body p-0 mt-3">
                    <div class="col p-1 p-sm-2">
                        <table id="table_roles" class="table dt-responsive table-striped  table-sm" width="100%">
                            <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>{{ __('Role') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th class="text-rigth">{{ __('Action') }}</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
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
@endpush
@push('scripts')
    {{-- Plugin DataTables --}}
    <script src="{{ asset('js/plugins/datatables/datatables.min.js') }}" defer></script>
    <!-- Functions comunes-->
    <script src="{{ asset('js/common/common-functions.js') }}" defer></script>
    {{--<script src="vendor/jquery.cookie/jquery.cookie.js"></script>--}}
    <script src="{{ asset('js/dashboard/roles/roles-index.js') }}" defer></script>
@endpush
