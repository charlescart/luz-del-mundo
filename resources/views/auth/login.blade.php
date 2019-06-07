@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center no-gutters">
        <div class="col-12 col-sm-9 col-lg-6 bg-transparent">
            <div class="card mt-4 rounded-0">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="form-material text-secondary">
                        @csrf

                        <div class="form-group">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-material" name="email" value="{{ old('email') }}" required autocomplete="off">
                                <label for="email" class="col-form-label text-md-right label-material">
                                    <i class="fa fa-envelope mr-2" aria-hidden="true"></i>
                                    {{ __('E-Mail Address') }}
                                </label>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-material" name="password" required>
                            <label for="password" class="col-form-label text-md-right label-material">
                                <i class="fa fa-lock mr-sm-2" aria-hidden="true"></i>
                                {{ __('Password') }}
                            </label>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>

                        <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-outline-primary" style="min-width: 10rem;">
                                    {{ __('Login') }}
                                </button>

                                <a class="btn btn-link text-luzdelmundo" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('styles')
    <link href="{{ asset('css/plugins/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app-propios.css') }}" rel="stylesheet">
@endpush
@push('scripts')
    <script src="{{ asset('js/common/common-functions.js') }}" defer></script>
    <script src="{{ asset('js/plugins/particles/particles.min.js') }}" defer></script>
    <script src="{{ asset('js/auth/login.js') }}" defer></script>
@endpush
