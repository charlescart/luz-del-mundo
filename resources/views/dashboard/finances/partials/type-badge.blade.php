<span style="min-width: 82px; padding: 4px 10px;"
      data-toggle="tooltip" data-placement="top" title="{{$finance->finance_classification->description}}"
      class="badge badge-pill badge-{{$finance->finance_classification->class}}">
    {{$finance->finance_classification->name}}
    @if($finance->fifth_part)
        <i class="fa fa-bookmark" style="margin-left: 3px" aria-hidden="true"></i>
    @endif
</span>
