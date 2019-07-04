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
            <span class="card-text d-block mb-2">
                @if ($church->custom_name_at)
                    {{ __('Church name verified') }}
                @else
                    {{ __('Name in verification') }}
                    <div class="spinner-grow spinner-grow-sm text-warning" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                @endif
            </span>
            <!--Boton action de iglesia-->
            <div class="btn-group dropright">
                <button type="button" aria-labelledby="dropdownChurch" class="btn btn-sm btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropright
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownChurch">
                    <!-- Dropdown menu links -->
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item btn-destroy" type="button">Something else here</button>
                </div>
            </div>
            {{--  <div class="dropdown">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuChurch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog" aria-hidden="true"></i> {{ __('Configuration') }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuChurch">
                    @if(Auth::user()->hasPermissionTo('churches.destroy'))
                    <a class="dropdown-item btn-destroy" href="#!" style="color: #000;">
                        <i class="fa fa-trash-o mr-1" aria-hidden="true"></i> {{ __('btn.delete') }}
                    </a>
                    @endif
                </div>
            </div>  --}}
        </div>
    </div>
@endforeach
