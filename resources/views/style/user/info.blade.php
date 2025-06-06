
@include('style.layouts.messages')
<div class="card checkout-area">
  <div class="your-order">
    <div class="your-order-table table-responsive">
      <table class="table">
        <tbody>
        <tr class="cart_item">
          <td colspan="4" class="cart-product-image">
            <img src="{{ Storage::url($user->image) }}" width="250" alt="User Image" onerror="this.onerror=null;this.src='{{ asset('images/default-user-image.png') }}'">
          </td>
        </tr>
        <tr class="cart_item">
          <td class="cart-product-name">
            <strong class="product-quantity">
              {{ trans('auth.name') }}
            </strong>
          </td>
          <td class="cart-product-total">
            {{$user->name}}
          </td>
        </tr>
        <tr class="cart_item">
{{--          @if (!is_null($user->mobile))--}}
{{--            <td class="cart-product-name">--}}
{{--              <strong class="product-quantity">--}}
{{--                {{ trans('auth.mobile') }}--}}
{{--              </strong>--}}
{{--            </td>--}}
{{--            <td class="cart-product-total">--}}
{{--              {{$user->mobile}}--}}
{{--            </td>--}}
{{--          @endif--}}

          @if (!is_null($user->email))
            <td class="cart-product-name">
              <strong class="product-quantity">
                {{ trans('auth.email') }}
              </strong>
            </td>
            <td class="cart-product-total">
              {{$user->email}}
            </td>
          @endif
          {{--						<td class="cart-product-name">--}}
          {{--							<strong class="product-quantity">--}}
          {{--								{{ trans('product.sex') }}--}}
          {{--							</strong>--}}
          {{--						</td>--}}
          {{--						<td class="cart-product-total">--}}
          {{--							{{ trans('auth.male') }}--}}
          {{--						</td>--}}

        </tr>
        <tr class="cart_item">
          @if (!is_null($user->level))
            <td class="cart-product-name">
              <strong class="product-quantity">
                {{ trans('auth.level') }}
              </strong>
            </td>
            <td class="cart-product-total">
              {{$user->level}}
            </td>
          @endif
{{--          @if (!is_null($user->webSite))--}}
{{--            <td class="cart-product-name">--}}
{{--              <strong class="product-quantity">--}}
{{--                {{ trans('site.webSite') }}--}}
{{--              </strong>--}}
{{--            </td>--}}
{{--            <td class="cart-product-total">--}}
{{--              {{$user->webSite}}--}}
{{--            </td>--}}
{{--          @endif--}}
        </tr>
        <tr class="cart_item">
{{--          @if (!is_null($user->phone))--}}
{{--            <td class="cart-product-name">--}}
{{--              <strong class="product-quantity">--}}
{{--                {{ trans('auth.phone') }}--}}
{{--              </strong>--}}
{{--            </td>--}}
{{--            <td class="cart-product-total">--}}
{{--              {{$user->phone}}--}}
{{--            </td>--}}
{{--          @endif--}}
          {{--						<td class="cart-product-name">--}}
          {{--							<strong class="product-quantity">--}}
          {{--								{{ trans('product.dob') }}--}}
          {{--							</strong>--}}
          {{--						</td>--}}
          {{--						<td class="cart-product-total">--}}
          {{--							31-12-2022--}}
          {{--						</td>--}}
        </tr>
        {{--					<tr class="cart_item">--}}
        {{--						<td class="cart-product-name">--}}
        {{--							<strong class="product-quantity">--}}
        {{--								{{ trans('all.city') }}--}}
        {{--							</strong>--}}
        {{--						</td>--}}
        {{--						<td class="cart-product-total">--}}
        {{--							----}}
        {{--						</td>--}}
        {{--						<td class="cart-product-name">--}}
        {{--							<strong class="product-quantity">--}}
        {{--								{{ trans('all.address') }}--}}
        {{--							</strong>--}}
        {{--						</td>--}}
        {{--						<td class="cart-product-total">--}}
        {{--							-----}}
        {{--						</td>--}}
        {{--					</tr>--}}
        </tbody>
      </table>
    </div>
  </div>
  <div class="payment-method">
    <div class="payment-accordion">
      <div class="order-button-payment">
        <a href="{{url('profile/edit')}}" class="text-center info-edit" id="info_edit">{{ trans('auth.edit-account-info') }}</a>
      </div>
    </div>
  </div>
</div>
