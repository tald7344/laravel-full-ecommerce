@if (Storage::exists($logo))
  <img src="{{Storage::url($logo)}}" alt="Country Logo" width="75" class="img-thumbnail" />
@else
<span>-----</span>
@endif
