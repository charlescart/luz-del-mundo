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
