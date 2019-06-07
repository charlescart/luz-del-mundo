<div class="modal" tabindex="-1" role="dialog" id="modal-manage-roles">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Assing Roles')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
          <form class="text-secondary" id="form-manage-roles">

              {{ csrf_field() }}
              <input type="hidden" name="user_id" class="d-none">

              <div class="text-center text-md-left">
                  <span class="name-user"></span>
              </div>

          </form>

          <div class="col p-0">
              <table id="table_roles" class="table dt-responsive table-striped  table-sm table-white" width="100%">
                  <thead class="thead-light">
                      <tr>
                          <th class="text-center text-muted"> {{ __('Roles') }} </th>
                      </tr>
                  </thead>
              </table>
          </div>

          <div class="col p-0 mt-3">
              <textarea form="form-manage-roles" class="form-control" name="roles" id="tag-editor-roles" cols="30" rows="10" required></textarea>
              <div class="invalid-feedback"></div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-0 btn-sm" data-dismiss="modal">{{ __('btn.cancel') }}</button>
        <button type="submit" class="btn btn-outline-primary rounded-0 btn-sm btn-roles-save has-spinner" form="form-manage-roles" data-load-text="{{ __('btn.saving') }}">{{ __('btn.save') }}</button>
      </div>
    </div>
  </div>
</div>
