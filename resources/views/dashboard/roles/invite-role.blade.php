<div class="modal" tabindex="-1" role="dialog" id="modal-invite-role">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{__('Assing Roles')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
          <form class="text-secondary" id="form-invite-role">

              {{ csrf_field() }}
              <div class="form-group">
                  <label for="email" class="col-form-label text-md-right"> {{ __('E-Mail Address') }} </label>
                  <input type="text" name="email" id="email-search" class="form-control" placeholder="{{__('Type the email of a user')}}" required autocomplete="off">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="text-center text-md-left d-none container-user-select">
                  <span class="name-user"></span>
              </div>

              <div class="text-center text-md-left d-none container-user-noselect">
                  <span class="text-justify">
                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                      {{__('Unregistered user will be sent an invitation to register on the platform')}}
                  </span>
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
              <textarea form="form-invite-role" class="form-control" name="roles" id="tag-editor-roles" cols="30" rows="10" required></textarea>
              <div class="invalid-feedback"></div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-0 btn-sm" data-dismiss="modal">{{ __('btn.cancel') }}</button>
        <button type="submit" class="btn btn-outline-primary rounded-0 btn-sm btn-roles-save has-spinner" form="form-invite-role" data-load-text="{{ __('btn.saving') }}">{{ __('btn.save') }}</button>
      </div>
    </div>
  </div>
</div>
