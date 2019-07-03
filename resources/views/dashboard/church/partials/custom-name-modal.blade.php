<div class="modal fade" id="custom-name-modal" tabindex="-1" role="dialog" aria-labelledby="customNameModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <img class="mr-2" src="{{ asset('img/information.svg') }}" alt="{{ __('Information') }}" width="24px" height="auto">
            <h5 class="modal-title" id="customNameModal">{{ __('Information') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p class="text-justify"> {{ __('If you want to personalize the name you must wait for an approval and you can not use the different functions of a church immediately until the name is verified by the administration, it is important to include a telephone number to contact you if you want to leave activated the option to customize the name.') }} </p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">{{ __('In agreement') }}</button>
        </div>
        </div>
    </div>
</div>
