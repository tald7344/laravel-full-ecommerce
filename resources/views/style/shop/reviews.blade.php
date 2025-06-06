<div class="row">
  <div class="col-md-6">
    <div class="row total_rate ">
      <div class="col-10 col-lg-8 mx-auto">
        <div class="box_total mb-4">
          @php
            if ($product->reviews->isNotEmpty()):
              foreach($product->reviews as $review) {
                  $collectReviews[] = $review->review;
              }
              $total = array_sum($collectReviews);
              $count = count($product->reviews);
              $totalReview = $total / $count;
            else:
              $totalReview = 0;
            endif;
          @endphp
          <h5>{{ trans('product.overall') }}</h5>
          <h4>{{ $totalReview }}</h4>
        </div>
      </div>
    </div>
    <div class="review_list">
      @if ($product->reviews->isNotEmpty())
        @foreach($product->reviews as $review)
          <div class="review_item">
            <div class="media">
              <div class="media-body">
                <h4>{{ $review->reviewer_name }}</h4>
                @php
                  for($i = 1; $i <= 5; $i++) {
                    if ($i <= $review->review) {
                        echo '<i class="fa fa-star"></i>';
                    } else {
                        echo '<i class="fa fa-star text-muted"></i>';
                    }
                  }
                @endphp
              </div>
            </div>
            <p>{{ $review->review_text }}</p>
          </div>
        @endforeach
      @endif
    </div>
  </div>
  <div class="col-md-6">
    <div class="review_box">
      <h4>{{ trans('product.add-review') }}</h4>
      <div class="alert alert-danger review-response-error d-none"></div>
      {!! Form::open(['method' => 'POST', 'id' => 'reviewForm', 'class' => 'row contact_form', 'novalidate' => 'novalidate']) !!}
        {{ Form::hidden('product_id', $product->id) }}
        <div class="col-md-12">
          <div class="form-group">
            {{ Form::text('reviewer_name', old('reviewer_name'), ['class' => 'form-control', 'placeholder' => trans('product.your-name'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "' . trans('product.your-name') . '"' ]) }}
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            {{ Form::number('review', old('review'), ['class' => 'form-control', 'min' => '0', 'max' => '5', 'placeholder' => trans('product.rate-one-to-five'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "'. trans('product.rate-one-to-five') .'"']) }}
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            {{ Form::textarea('review_text', old('review_text'), ['class' => 'form-control', 'placeholder' => trans('admin.review'), 'onfocus' => 'this.placeholder = ""', 'onblur' => 'this.placeholder = "'. trans('admin.review') .'"']) }}
          </div>
        </div>
        <div class="col-md-12 text-right">
          <button type="submit" value="submit" class="primary-btn">{{trans('product.send')}}</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@push('js')
  <script>
    $(document).ready(function () {
      $('#reviewForm button').click(function (e) {
        e.preventDefault();
        let form = document.getElementById('reviewForm');
        let formData = new FormData(form);
        let reviewerName = $('input[name="reviewer_name"]').val();
        let productId = $('input[name="product_id"]').val();
        let reviewText = $('input[name="review_text"]').val();
        let review = $('input[name="review"]').val();
        formData.append('_token', '{{csrf_token()}}');

        if (reviewerName == '' || productId == '' || reviewText == '' || review == '') {
          console.log('invalid form');
          return;
        }
        $.ajax({
          url: '{{ url('shop/ajax-new-review') }}',
          type: 'POST',
          contentType: false,
          processData: false,
          data: formData,
          beforeSend: function () {
            $(this).css({'opacity': '.6', 'pointer-events': 'none'});
          },
          error: function (response) {
            // console.log('error : ', response, typeof(response.responseJSON.error) == 'string');
            $(this).css({'opacity': '1', 'pointer-events': 'auto'});
            if (response.responseJSON.error) {
              $('.review-response-error').removeClass('d-none');
              let result = `<ul class="list-unstyled">`;
              if (typeof(response.responseJSON.error) == 'string') {
                  result += `<li>${response.responseJSON.error}</li>`;
              } else {
                for(let item in response.responseJSON.error) {
                  // item : Get object key
                  result += `<li>${response.responseJSON.error[item][0]}</li>`;
                }
              }
              result += '</ul>';
              $('.review-response-error').html(result);
              // Hide Error Message After 5 second
              setTimeout(() => {
                $('.review-response-error').html('').addClass('d-none');
              }, 5000);
            }
          },
          success: function (response) {
            // Active send button
            $(this).css({'opacity': '1', 'pointer-events': 'auto'});
            // Reset Form
            form.reset();
            // Display Success Message
            $('#custom-message').addClass('show');
            $('#custom-message .message-text').html(response.success);
          }
        });
      });
    });
  </script>
@endpush

