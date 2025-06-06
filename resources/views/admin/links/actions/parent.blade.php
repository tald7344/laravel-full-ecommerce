@if($parent == 0)
  <span>---</span>
@else
  <span>{{ \App\Model\Link::find($parent)->{'link_name_' . lang()} }}</span>
@endif

