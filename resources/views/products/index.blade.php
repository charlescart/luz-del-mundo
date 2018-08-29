@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        {{ __('Products') }}
                        @can('products.create')
                            <a href="{{ route('products.create') }}" class="btn btn-info btn-sm float-right">{{ __('btn.create') }}</a>
                        @endcan
                    </div>

                    <div class="card-body">
                        <div class="col">
                            <table id="table_products" class="table dt-responsive table-striped  table-sm" width="100%">
                                <thead class="thead-light">
                                <tr>
                                    <th>Id</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/app-propios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/izitoast/iziToast.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/blockui/blockui.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/izitoast/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/plugins/blockui/blockui.js') }}"></script>
    <script src="{{ asset('js/common/common-functions.js') }}"></script>
    <script src="{{ asset('js/products/products-index.js') }}"></script>
@endpush
