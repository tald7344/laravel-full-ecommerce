<div class="card checkout-area pt-30 pb-30">
  <div class="row">
    <div class="col-12 mx-auto">
      <div class="order-scroll">
        @if ($carts->isNotEmpty())
          @foreach( $carts as $key => $cart )
            <div class="mb-3">
              <div class="card-body">
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
                  @foreach($cart->items as $item)
                    <tr>
                      <td>{{$item['item']['title'] }}</td>
                      <td>${{$item['price'] }}</td>
                      <td>{{$item['qty'] }}</td>
                      <td>{{trans('auth.paid')}}</td>
                      <td>{{ (!is_null($item['item']->country) ? $item['item']->country->currency : '$') . ' ' . $cart->totalPrice}}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>

              </div>
            </div>
            @if ($key + 1 != count($carts))
              <hr class="border-warning border-2">
            @endif
          @endforeach
        @else
          <div class="card-body">
            <div class="text-warning text-center">{{ trans('auth.empty-user-orders') }}</div>
          </div>
        @endif
      </div>
    </div><!--.col-12-->
  </div><!--.row-->
</div>
