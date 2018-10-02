<!--Boton action de datatables roles-->
<div class="btn-group dropleft">
    <button type="button" class="btn btn-outline-primary rounded-0 dropdown-toggle text-lowercase btn-sm" style="padding: 0.125rem 0.25rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}
    </button>
    <div class="dropdown-menu">
        <!-- Dropdown menu links -->
        @can('roles.index')
            <a class="dropdown-item" href="{{ route('roles.show', ['rol' => $id]) }}" style="color: #000;">{{ __('btn.see') }}</a>
        @endif
        @can('roles.edit')
            <a class="dropdown-item" href="{{ route('roles.edit', ['rol' => $id]) }}" style="color: #000;">{{ __('btn.edit') }}</a>
        @endcan
        @can('roles.destroy')
            <a class="dropdown-item btn-delete-product" href="#!" style="color: #000;" data-id="{{ $id }}">{{ __('btn.delete') }}</a>
        @endcan
    </div>
</div>
