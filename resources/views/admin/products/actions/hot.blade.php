@if ($is_hot == 0)
  {!! Form::open(['route' => ['product.hot', 'id' => $id, 'is_hot' => 1], 'method' => 'POST']) !!}
  {{ Form::button(
      '<i class="fa fa-check"></i>', [
          'type' => 'submit',
          'class' => 'btn btn-secondary btn-sm'
      ])
  }}
  {!! Form::close() !!}
@else
  {!! Form::open(['route' => ['product.hot', 'id' => $id, 'is_hot' => 0], 'method' => 'POST']) !!}
      {{ Form::button(
          '<i class="fa fa-check"></i>', [
              'type' => 'submit',
              'class' => 'btn btn-success btn-sm'
          ])
      }}
  {!! Form::close() !!}
@endif
