<form class="form-materiall">

    {{ csrf_field() }}
    <div class="form-group">
        <label for="finance_classification_id" class="label-material">{{__('Finance Classification')}}</label>
        <select class="form-control form-control-sm" id="finance_classification_id" name="finance_classification">
            @foreach($finance_classifications as $finance_classification)
                <option value="{{$finance_classification->id}}" data-fund="{{$finance_classification->fund}}" {{($loop->first) ? 'selected': ''}}>
                    {{$finance_classification->name}}
                </option>
            @endforeach
        </select>
        <div class="invalid-feedback"></div>
    </div>

    <div class="form-group content-debit-to d-none">
        <label for="debit_to" class="label-material">{{__('Debit to')}}</label>
        <select class="form-control form-control-sm" id="debit_to" name="debit_to">
            <option value="0" selected>{{__('Select')}}</option>
            @foreach($finance_classifications as $finance_classification)
                @if($finance_classification->fund)
                    <option value="{{$finance_classification->id}}">
                        {{$finance_classification->name}}
                    </option>
                @endif
            @endforeach
        </select>
        <div class="invalid-feedback"></div>
    </div>

    <div class="row">
        <div class="form-group col-md-4">
            <label for="currency">{{__('Currency')}}</label>
            <select id="currency" class="form-control form-control-sm" name="currency">
                @foreach($currencies as $currrency)
                    <option value="{{$currrency->id}}" {{($loop->first) ? 'selected': ''}}>
                        {{$currrency->code}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-12 col-md-4 pl-md-0 pr-md-0">
            <label for="amount" class="text-md-right label-materiall"> {{ __('Amount') }} </label>
            <input type="number" name="amount" class="form-control form-control-sm input-materiall" placeholder="{{__('Amount')}}" step="0.01" required autocomplete="off">
            <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-12 col-md-4">
            <label for="debt" class="text-md-right label-materiall"> {{ __('Debt') }} </label>
            <input type="number" name="debt" class="form-control form-control-sm input-materiall" placeholder="{{__('Debt')}}" step="0.01" autocomplete="off">
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="form-group">
        <label for="description">{{__('Description')}}</label>
        <textarea name="description" class="form-control form-control-sm" id="description" rows="2" maxlength="1000" placeholder="{{__('Description')}}" required></textarea>
        <div class="invalid-feedback"></div>
    </div>

    <div class="content-radio-button">
        <div class="col-12 p-0">
            <span>{{__('Decimate this income?')}}</span>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tithe" id="tithe_not" value="0">
            <label class="form-check-label" for="tithe_not">{{__('Not')}}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tithe" id="tithe_yes" value="1" checked>
            <label class="form-check-label" for="tithe_yes">{{__('Yes')}}</label>
        </div>

        <div class="col-12 p-0">
            <span>{{__('Pay tithes with a fifth?')}}</span>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="fifth_part" id="fifth_part_not" value="0" checked>
            <label class="form-check-label" for="fifth_part_not">{{__('Not')}}</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="fifth_part" id="fifth_part_yes" value="1">
            <label class="form-check-label" for="fifth_part_yes">{{__('Yes')}}</label>
        </div>
    </div>

    {{--  <div class="form-group">
        <label for="description">{{ trans('form.description') }}</label>
        <textarea name="description" rows="5" class="form-control">{{ $post->description }}</textarea>
        <div class="invalid-feedback"></div>
    </div>  --}}

</form>
