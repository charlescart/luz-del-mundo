<div class="modal" tabindex="-1" role="dialog" id="modal-guest-user" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pt-0">
          <form class="text-secondary">

              {{ csrf_field() }}
              <div class="form-group">
                  <label for="email" class="col-form-label text-md-right"> {{ __('E-Mail Address') }} </label>
                  <input type="text" name="email" class="form-control" placeholder="{{__('Type the email of a user')}}" required autocomplete="off">
                  <div class="invalid-feedback"></div>
              </div>

              <div class="form-group">
                  <label for="name" class="col-form-label text-md-right"> {{ __('Name') }} </label>
                  <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}" required autocomplete="off">
                  <div class="invalid-feedback"></div>
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
              <textarea class="form-control tag-edit" name="roles" cols="30" rows="1" required></textarea>
              <div class="invalid-feedback"></div>
          </div>

          <div class="form-check mb-0 mt-3">
              <input type="checkbox" name="send_email" class="form-check-input" id="sendEmail" checked>
              <label class="form-check-label" for="sendEmail">{{__('Send an E-mail')}}?</label>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary rounded-0 btn-sm" data-dismiss="modal">{{ __('btn.cancel') }}</button>
        <button type="submit" class="btn btn-outline-primary rounded-0 btn-sm btn-roles-save has-spinner" data-load-text="{{ __('btn.saving') }}">{{ __('btn.save') }}</button>
      </div>
    </div>
  </div>
</div>
