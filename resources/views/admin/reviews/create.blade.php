@extends('admin.index')
@section('content')

<div class="card">
    <div class="card-header">
    <h3 class="card-title" style="float:none;">{{ $title }}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {!! Form::open(['route' => 'review.store', 'method' => 'POST']) !!}
            <div class="form-group">
                {{ Form::label('reviewer_name', trans('admin.reviewer_name')) }}
                {{ Form::text('reviewer_name', old('reviewer_name'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
              {{ Form::label('product_id', trans('admin.product_title')) }}
              {{ Form::select('product_id', \App\Model\Product::pluck('title_' . lang(), 'id'), old('product_id'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
              {{ Form::label('review', trans('admin.review')) }}
              {{ Form::select('review', [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5], old('review'), ['class' => 'form-control'] )}}
            </div>
            <div class="form-group">
              {{ Form::label('review_text', trans('admin.review_text')) }}
              {{ Form::textarea('review_text', old('review_text'), ['class' => 'form-control'] )}}
            </div>
            {{ Form::submit(trans('admin.new_review'), ['class' => 'btn btn-primary'] )}}
        {!! Form::close() !!}
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->


@endsection
