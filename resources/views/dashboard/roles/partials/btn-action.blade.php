<!--Boton action de datatables finance-->
<div class="btn-group dropleft">
    <button type="button" class="btn btn-outline-primary rounded-0 dropdown-toggle text-lowercase btn-sm border-0" style="padding: 0.125rem 0.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}
    </button>
    <div class="dropdown-menu">
        <!-- Dropdown menu links -->
            <a class="dropdown-item btn-roles-show" href="#!" style="color: #000;" data-toggle="modal" data-target="#modal-finance-show">{{ __('btn.see') }}</a>
            <a class="dropdown-item btn-roles-edit" href="#!" style="color: #000;">{{ __('btn.edit') }}</a>
            <a class="dropdown-item btn-roles-destroy" href="#!" style="color: #000;">{{ __('btn.delete') }}</a>
    </div>
</div>
