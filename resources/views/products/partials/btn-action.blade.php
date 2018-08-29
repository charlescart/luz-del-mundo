<!--Boton action de datatables products-->
<div class="dropdown">
    <a class="btn btn-info btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ __('Action') }}
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        @can('products.show')
            <a class="dropdown-item" href="{{ route('products.show', ['product' => $id]) }}" style="color: #000;">{{ __('btn.see') }}</a>
        @endcan
        @can('products.edit')
            <a class="dropdown-item" href="{{ route('products.edit', ['product' => $id]) }}" style="color: #000;">{{ __('btn.edit') }}</a>
        @endcan
        @can('products.destroy')
            <a class="dropdown-item btn-delete-product" href="#!" style="color: #000;" data-id="{{ $id }}">{{ __('btn.delete') }}</a>
        @endcan
    </div>
</div>