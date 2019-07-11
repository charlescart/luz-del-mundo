@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 p-1">
            <div class="card">
                <div class="card-header p-2">
                    <img src="{{ secure_asset('img/email-vefiried.svg') }}" alt="" style="max-width: 24px; height: auto;">
                    {{ __('Verify Your Email Address') }}
                </div>

                <div class="card-body text-justify pl-2 pr-2">
                    @if (!session('resent'))
                        <div class="alert alert-success mb-3" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="alert-heading">{{ __('E-mail Sent') }}!</h4>
                            <hr class="mt-0 mb-2">
                            {{ __('A fresh verification link has been sent to your email address') }}.<br>
                        </div>
                    @endif
                    {{ __('Before continuing, check your email to see a verification link. If you did not receive the email, ask for another one by clicking on the request another verification email button') }}.
                    <p class="mt-2">{{ __('Due to security reasons we ask you to confirm your email, this helps us verify that you are really a person with a valid email with which we can have communication. Once this filter is over, you can use all the benefits offered by the platform') }}.</p>
                    <div class="text-center">
                        <a href="{{ route('verification.resend') }}" class="btn btn-outline-primary">{{ __('request another') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ secure_asset('css/app-propios.css') }}" rel="stylesheet">
@endpush
