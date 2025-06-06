@if (Storage::exists($image))
  <img src="{{Storage::url($image)}}" alt="Mall Icon" width="100" class="img-thumbnail" />
@else
  <span>-----</span>
@endif

