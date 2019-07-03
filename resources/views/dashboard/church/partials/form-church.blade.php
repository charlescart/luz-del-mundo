<form id="form-create-church" class="">
    <div class="form-row">
        <div class="form-group col-12 col-md-4">
            <label class="col-form-label col-form-label-sm" for="inputState">{{__('Country')}}</label>
            <select name="country" id="country" class="form-control form-control-sm" required>
                <option value="0">{{ __('Select') }}</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}" {{ ($country->id == 1) ? 'selected': '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group col-12 col-md-4">
            <label class="col-form-label col-form-label-sm" for="inputState">{{__('State')}}</label>
            <select name="state" id="state" class="form-control form-control-sm" required>
                <option value="0" selected>{{__('Select')}}</option>
                @foreach($provinces as $province)
                    <option value="{{ $province->id }}">
                        {!! $province->name !!}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group col-12 col-md-4">
            <label class="col-form-label col-form-label-sm" for="inputState">{{__('City')}}</label>
            <select name="city" id="city" class="form-control form-control-sm" required>
                <option value="0" selected>{{__('Select')}}</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-12 col-md-2">
            <label class="col-form-label col-form-label-sm" for="number_of_church">{{__('Number of church')}}</label>
            <input type="number" id="number_of_church" name="number_of_church" class="form-control form-control-sm" min="1" placeholder="31" required autocomplete="off">
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group col-12 col-md-10">
            <label class="col-form-label col-form-label-sm" for="name">{{__('Name')}}</label>
            <input type="text" name="name" class="form-control form-control-sm" id="name" placeholder="{{ __('Light of the World Barcelona Mission 31') }}" readonly>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="custom_name" id="custom_name" class="custom-control-input">
            <label class="custom-control-label" for="custom_name">{{__('Customize church name')}}</label>
        </div>
    </div>

    <div class="form-group">
        <label class="col-form-label col-form-label-sm" for="validationTextarea">{{__('Address')}}</label>
        <textarea name="address" class="form-control form-control-sm" id="validationTextarea" placeholder="{{ __('Guamachito, street 4, near the center of ophthalmology Jose Leonardo Chirino') }}" rows="3" required></textarea>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-row">
        <div class="form-group col-12 col-md-6">
            <label class="col-form-label col-form-label-sm" for="name_shepherd">{{ __('Pastor head of mission') }}</label>
            <input type="text" name="name_shepherd" class="form-control form-control-sm" placeholder="{{ __('Pastor head of mission')  }}" required autocomplete="off">
            <div class="invalid-feedback"></div>
        </div>

        <div class="form-group col-12 col-md-6">
            <label class="col-form-label col-form-label-sm" for="name">{{ __('Telephone contact') }}</label>
            <input type="text" name="phone" class="form-control form-control-sm" placeholder="+58 4120840524" required>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input type="checkbox" name="condition" class="custom-control-input" id="condition" required>
            <label class="custom-control-label text-justify" for="condition">{{__('When requesting to create this church it is assumed that it is the pastor or chief of mission of the same and that it is allowing us to verify this information by entering a verification period.')}}</label>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="form-group text-center text-sm-right pt-3 pb-3">
        <button type="submit" class="btn btn-primary mb-3 has-spinner" data-load-text="{{ __('btn.saving') }}">{{__('Create Church')}}</button>
    </div>
</form>
