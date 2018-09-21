@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col text-secondary">
                <div class="display-4 text-center" style="margin-top: 150px;">
                    {{ __('Light of the World') }}
                </div>
            </div>
        </div>


    </div>
    </div>
@endsection
@push('styles')
    <link href="{{ asset('css/app-propios.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/common/common-functions.js') }}" defer></script>
    <script src="{{ asset('js/plugins/particles/particles.min.js') }}" defer></script>
    <script src="{{ asset('js/welcome.js') }}" defer></script>
@endpush
