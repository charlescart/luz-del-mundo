@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-0 mt-4">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="form-material mt-2">
                        @csrf

                        <div class="form-group">
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} input-material" name="name" value="{{ old('name') }}" required autofocus autocomplete="off">
                            <label for="name" class="col-form-label text-md-right label-material">{{ __('Name') }}</label>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} input-material" name="email" value="{{ old('email') }}" required autocomplete="off">
                            <label for="email" class="col-form-label text-md-right label-material">{{ __('E-Mail Address') }}</label>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} input-material" name="password" required autocomplete="off">
                            <label for="password" class="col-form-label text-md-right label-material">{{ __('Password') }}</label>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control input-material" name="password_confirmation" required>
                            <label for="password-confirm" class="col-form-label text-md-right label-material">{{ __('Confirm Password') }}</label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-outline-primary rounded-0">
                                    {{ __('Register') }}
                                </button>
                            </div>
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
   <script src="{{ asset('js/auth/register.js') }}" defer></script>
@endpush
