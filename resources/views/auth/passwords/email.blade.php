@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-0 mt-4">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="form-material mt-2">
                        @csrf

                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-material" name="email" value="{{ old('email') }}" required>
                            <label for="email" class="col-form-label text-md-right label-material">{{ __('E-Mail Address') }}</label>

                            {{-- <div class="col-md-6"> --}}

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            {{-- </div> --}}
                        </div>

                        <div class="form-group mb-0 mt-4 text-center">
                            {{-- <div class="col-md-6 offset-md-4"> --}}
                                <button type="submit" class="btn btn-outline-primary rounded-0">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            {{-- </div> --}}
                        </div>
                    </form>
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
    <script src="{{ asset('js/auth/email.js') }}" defer></script>
@endpush
