@extends('style.index')
@section('content')
  @include('style.layouts.header-image', ['title' => 'Shopping Cart Page'])
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="single-product-area">
        <div class="container">
            @if (Session::has('cart'))
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6 mx-auto">
                        <ul class="list-group">
                            @foreach($cartProducts as $product)
                                <li class="list-group-item">
                                    <span style="padding: 0 5px;"><img src="{{ Storage::url($product['photo']) }}" width="50" height="50"></span>
                                    <span class="badge">{{ $product['qty'] }}</span>
                                    <strong style="padding: 0 5px;">{{ $product['item']['title'] }}</strong>
                                    <span class="label label-success" style="padding: 0 5px;">{{ $product['price'] }}</span>
                                    <div class="btn-group" role="group">
                                        {!! Form::open(['route' => ['cart.destroy', $product['id']], 'method' => 'POST']) !!}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::button(
                                                '<i class="fa fa-trash"></i>', [
                                                    'type' => 'submit',
                                                    'style' => 'padding: 5px 10px;',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'onclick' => "if(!confirm('". trans('admin.alert_delete_msg') . "')) return false;"
                                                ])
                                            }}
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="btn-group" role="group">
                                        {!! Form::open(['route' => ['cart.update', $product['id']], 'method' => 'POST']) !!}
                                            {{ Form::hidden('_method', 'PUT') }}
                                            {{ Form::text('qty', $product['qty']) }}
                                            {{ Form::button(
                                                '<i class="fa fa-edit"></i>', [
                                                    'type' => 'submit',
                                                    'style' => 'padding: 5px 10px;',
                                                    'class' => 'btn btn-success btn-sm',
                                                ])
                                            }}
                                        {!! Form::close() !!}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div><!--.row-->
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6 mx-auto">
                    <strong>Total: {{ $totalPrice }}</strong>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12 col-sm-8 col-md-6 mx-auto">
                        <a href="{{ url('checkout') }}" class="btn btn-success">Checkout</a>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="col-12 col-sm-8 col-md-6 mx-auto">
                    <h2>No Item In Cart!</h2>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
