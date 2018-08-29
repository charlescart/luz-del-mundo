@if($product->exists)
    <form action="{{route('products.edit', ['id' => $product->id])}}" method="put" id="form-product-edit">
@else
    <form action="{{route('products.store')}}" method="post" id="form-product-create">
@endif

    {{ csrf_field() }}
    <div class="form-group">
        <label for="title">{{ trans('form.name') }}</label>
        <input type="text" name="title" class="form-control" value="{{ $product->name }}">
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group">
        <label for="description">{{ trans('form.description') }}</label>
        <textarea name="description" rows="8" class="form-control">{{ e($product->description) }}</textarea>
        <div class="invalid-feedback"></div>
    </div>
        
    <div class="form-group">
        <button type="submit" class="btn btn-primary has-spinner" data-load-text="{{ trans('btn.saving') }}">{{ trans('btn.save') }}</button>
    </div>

</form>