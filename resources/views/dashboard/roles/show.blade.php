<div class="modal" tabindex="-1" role="dialog" id="modal-roles-show">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="jumbotron jumbotron-fluid bg-transparent p-0">
                    <div class="container p-0">
                        <p class="lead mb-0">{{ __('Guard Name') }}: <span class="roles-guard-name"></span></p>
                        <p class="lead mb-0">{{ __('Date') }}: <span class="roles-date"></span></p>
                    </div>
                </div>

                <table id="table_permissions" class="table dt-responsive table-striped  table-sm" width="100%">
                    <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Guard') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-secondary rounded-0 btn-sm" data-dismiss="modal">{{ __('btn.cancel') }}</button>
            </div>--}}
        </div>
    </div>
</div>
