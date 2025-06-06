@extends('style.index')
@section('styles')
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
@endsection

@section('content')
@include('style.layouts.header-image', [
  'imageUrl' => asset('images/bg-checkout.jpg'),
  'title' => trans('admin.checkout-page'),
  'links' => [
      ['url' => url('/'), 'name' => trans('admin.home'), 'arrow' => '<span class="lnr lnr-arrow-right"></span>'],
      ['url' => '#', 'name' => trans('admin.checkout'), 'arrow' => '']
  ]])

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>{{ trans('product.checkout') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <h4>{{ trans('product.total') }}: ${{ $total }}</h4>
                <div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : ''  }}">
                    {{ Session::get('error') }}
                </div>
                <form action="/charge" method="post" id="payment-form">
                    {{ csrf_field() }} {{-- Or Use @csrf with any Curly bracket like : @csrf --}}
                    <div class="form-row">
                        <input type="hidden" name="amount" value="{{ $total }}">
                      <label for="card-element">
                        Credit or debit card
                      </label>
                      <div id="card-element" style="margin: 10px 0;">
                        <!-- A Stripe Element will be inserted here. -->
                      </div>

                      <!-- Used to display form errors. -->
                      <div id="card-errors" class="text-danger" role="alert"></div>
                    </div>

                    <button class="btn btn-primary btn-sm">
                        Submit Payment
                    </button>
                  </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    window.onload = function () {
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51H3O69JFCwUwjpu28iNAToMg1aNcSIpQIcKMYTMvLO0NpXb8aeaC9Sro1QD5DJiKKj00Imiii1EQyBCe42lA9hZw00So7gzqxb');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                  color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }

    }
</script>
@endsection
