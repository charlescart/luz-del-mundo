<!--Boton action de datatables roles-->
<div class="btn-group dropleft">
    <button type="button" class="btn btn-outline-primary rounded-0 dropdown-toggle text-lowercase btn-sm border-0" style="padding: 0.125rem 0.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}
    </button>
    <div class="dropdown-menu">
        <!-- Dropdown menu links -->
        @if(Auth::user()->hasPermissionTo('guest-user.edit'))
            <a class="dropdown-item btn-edit" href="#!" style="color: #000;" data-toggle="modal" data-target="#modal-guest-user" data-form="form-edit-guest-user" data-title="{{__('Edit invitation')}}">
                <i class="fa fa-pencil mr-1" aria-hidden="true"></i> {{ __('btn.edit') }}
            </a>
        @endif
    </div>
</div>
