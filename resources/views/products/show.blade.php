@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h1 class="display-4 text-center">{{ $product->name }}</h1>
                <div class="col" style="margin-top: 6%;">
                    <p class="text-justify"> {!! e($product->description) !!}</p>
                </div>
                <div class="col">
                    {{ __('By:') }} {{ $product->user->name }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/app-propios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/common/common-functions.js') }}"></script>
    <script src="{{ asset('js/products/products-index.js') }}"></script>
@endpush
