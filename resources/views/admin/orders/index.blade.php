@extends('admin.index')
@section('content')
  <div class="orders-panel">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title" style="float:none;">{{ $title }}</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-12 mx-auto">
            <div class="order-scroll">
              @if (count($carts) > 0)
                @foreach( $carts as $key => $cart )
                  <div class="mb-3">
                    <div class="card-body">
                      <h5>{{ trans('admin.order-owner') }} : <span
                          class="text-info">{{ !is_null(\App\User::find($cart['user_id'])) ? \App\User::find($cart['user_id'])->name : '------' }}</span></h5>
                      <table class="table table-striped mt-2 mb-2">
                        <thead>
                        <tr>
                          <th scope="col">{{trans('auth.title')}}</th>
                          <th scope="col">{{trans('auth.price')}}</th>
                          <th scope="col">{{trans('auth.quantity')}}</th>
                          <th scope="col">{{trans('auth.status')}}</th>
                          <th scope="col">{{trans('auth.total-price')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cart['cart']->items as $item)
                          <tr>
                            <td class="d-block" style="max-height: 60px; width: 250px; overflow: auto">{{$item['item']['title'] }}</td>
                            <td>${{$item['price'] }}</td>
                            <td>{{$item['qty'] }}</td>
                            <td>{{trans('auth.paid')}}</td>
                            <td>{{ (!is_null($item['item']->country) ? $item['item']->country->currency : '$') . ' ' . $cart['cart']->totalPrice}}</td>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                  @if ($key + 1 != count($orders))
                    <hr class="border-warning border-2">
                  @endif
                @endforeach
              @endif
            </div>
          </div><!--.col-12-->
        </div><!--.row-->
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center">
          {{ $orders->links() }}
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>


@endsection
