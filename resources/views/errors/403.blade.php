@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <p class="display-4 text-center m-md-5"> {{ __('mensaje.-3') }} </p>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ secure_asset('css/app-propios.css') }}" rel="stylesheet">
@endpush
