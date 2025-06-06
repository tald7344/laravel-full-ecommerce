@if (Storage::exists($icon))
  <img src="{{Storage::url($icon)}}" alt="Manufactory Icon" width="75" class="img-thumbnail" />
@else
  ----
@endif
