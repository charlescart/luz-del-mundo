<form class="form-material text-secondary">

    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" name="name" class="form-control input-material" autofocus required autocomplete="off">
        <label for="name" class="col-form-label text-md-right label-material"> {{ __('form.name') }} </label>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group">
        <input type="text" name="guard_name" class="form-control input-material" required>
        <label for="guard_name" class="col-form-label text-md-right label-material">{{ __('form.guard name') }}</label>
        <div class="invalid-feedback"></div>
    </div>

    {{--  <div class="form-group">
        <label for="description">{{ trans('form.description') }}</label>
        <textarea name="description" rows="5" class="form-control">{{ $post->description }}</textarea>
        <div class="invalid-feedback"></div>
    </div>  --}}

</form>
