@foreach ($user->churches as $church)
    <div class="card bg-danger col-12 col-sm-11 col-md-5 p-0 mx-sm-auto">
        <img src="{{__('img/church-2.svg')}}" class="card-img-top mx-auto d-block" alt="{{__('Create Church')}}" style="height: 140px; width: auto;">
        <a href="#!" data-toggle="tooltip" title="{!! ($church->church_verified_at) ? __('Church verificated') : __('Church not verificated') !!}" style="position: absolute; right: 5px; top: 5px;">
            @if ($church->church_verified_at)
                <i class="fa fa-check-circle-o text-dark" aria-hidden="true"></i>
            @else
                <i class="fa fa-exclamation-triangle text-dark" aria-hidden="true"></i>
            @endif
        </a>
        <div class="card-body bg-white text-dark">
            <h5 class="card-title text-center text-capitalize">{{ $church->name }}</h5>
            <p class="card-text text-justify">{{ $church->address }}</p>
            <p class="card-text mb-0"><strong>{{ __('Ubication') }}</strong>: {{ $church->city->province->country->name }} / {{ $church->city->name }}</p>
            <p class="card-text mb-0"><strong>{{ __('Create') }}</strong>: {{ $church->created_at->toFormattedDateString() }}</p>
            <p class="card-text {!! ($church->custom_name_at) ? 'text-success':'text-danger' !!}">
                @if ($church->custom_name_at)
                    {{ __('Church name verified') }}
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                @else
                    {{ __('Name in verification') }}
                    {{-- <i class="fa fa-times" aria-hidden="true"></i> --}}
                    @endif
                </p>
                            <div class="spinner-border text-warning" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i> {{ __('Configuration') }}
                </button>
                <div class="dropdown-menu">
                    @if(Auth::user()->hasPermissionTo('churches.destroy'))
                    <a class="dropdown-item btn-edit" href="#!" style="color: #000;">
                        <i class="fa fa-trash-o mr-1" aria-hidden="true"></i> {{ __('btn.delete') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
