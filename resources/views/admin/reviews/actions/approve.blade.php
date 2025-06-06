@if ($isApprove == 0)
  {!! Form::open(['route' => ['review.approve', 'id' => $id, 'approve' => 1], 'method' => 'POST']) !!}
  {{ Form::button(
      '<i class="fa fa-check"></i>', [
          'type' => 'submit',
          'class' => 'btn btn-secondary btn-sm'
      ])
  }}
  {!! Form::close() !!}
@else
  {!! Form::open(['route' => ['review.approve', 'id' => $id, 'approve' => 0], 'method' => 'POST']) !!}
      {{ Form::button(
          '<i class="fa fa-check"></i>', [
              'type' => 'submit',
              'class' => 'btn btn-success btn-sm'
          ])
      }}
  {!! Form::close() !!}
@endif
