<!--Boton action de datatables roles-->
<div class="btn-group dropleft">
    <button type="button" class="btn btn-outline-primary rounded-0 dropdown-toggle text-lowercase btn-sm border-0" style="padding: 0.125rem 0.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}
    </button>
    <div class="dropdown-menu">
        <!-- Dropdown menu links -->
        @if(Auth::user()->hasPermissionTo('roles.show'))
            <a class="dropdown-item btn-roles-show" href="#!" style="color: #000;" data-toggle="modal" data-target="#modal-roles-show">{{ __('btn.see') }}</a>
        @endif

        @if(Auth::user()->hasPermissionTo('roles.edit'))
            <a class="dropdown-item btn-roles-edit" href="#!" style="color: #000;">{{ __('btn.edit') }}</a>
        @endif

        @if(Auth::user()->hasPermissionTo('roles.destroy'))
            <a class="dropdown-item btn-roles-destroy" href="#!" style="color: #000;">{{ __('btn.delete') }}</a>
        @endif
    </div>
</div>
