<div class="modal" tabindex="-1" role="dialog" id="modal-add-permission">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Permission')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form class="form-material text-secondary" id="form-add-permission">

              {{ csrf_field() }}
              <div class="form-group">
                  <input type="text" name="name" class="form-control input-material" autofocus required autocomplete="off">
                  <label for="name" class="col-form-label text-md-right label-material"> {{ __('form.name') }} </label>
                  <div class="invalid-feedback"></div>
                  <input type="hidden" class="d-none" name="role_name" value="{{ $role->name }}">
              </div>

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-0 btn-sm" data-dismiss="modal">{{ __('btn.cancel') }}</button>
        <button type="submit" class="btn btn-outline-primary rounded-0 btn-sm btn-add-permission has-spinner" form="form-add-permission" data-load-text="{{ __('btn.saving') }}">{{ __('btn.save') }}</button>
      </div>
    </div>
  </div>
</div>
