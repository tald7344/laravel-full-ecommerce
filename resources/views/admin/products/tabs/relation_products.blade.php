@push('js')
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','.do_search',function(){
		var search = $('.search').val();
		if(search != '' || search !== null){
			$.ajax({
				url:"{{ aurl('product/search') }}",
				dataType:'json',
				type:'post',
				data:{
					_token: '{{ csrf_token() }}',
					search: search,
					productId: '{{ $product->id }}'
				},
				beforeSend: function(){
					$('.loading_data').removeClass('hidden');
				},
				success: function(data){
					if(data.status == true){
						if(data.total_result > 0) {
							var itmes = '';
							var lang = '{{ lang() }}';
							$.each(data.result, function(index,value) {
									itmes += '<li><label><input type="checkbox" name="related[]" value="'+value.id+'" /> '+value['title_' + lang]+' </label></li>';

							});
							$('.itmes').html(itmes);
						}
						$('.loading_data').addClass('hidden');
					}
				},error: function(data){

				}
			});
		}
	});
});
</script>
<style> .do_search:hover { color: #fff; background: #aaa }</style>
@endpush
<div id="relation_products" class="tab-pane fade">
	<h3>{{ trans('admin.relation_products') }}</h3>
	<div class="col-12 col-sm-11 col-md-9 col-lg-6">

		<!-- Search form -->
		{{-- <form class="form-inline">

			<i class="fa fa-spin fa-spinner fa-2x loading_data hidden" aria-hidden="true"></i>
			<i class="fa fa-search fa-2x do_search" aria-hidden="true"></i>
			<input class="form-control form-control-sm search col-md-6" type="text" placeholder="Search"
			aria-label="Search">
		</form> --}}
		<div class="input-group mb-3">
			<div class="input-group-prepend">
			  <span class="input-group-text do_search" id="basic-addon1" style="cursor: pointer;">
				  {{ trans('admin.search') }}
				  {{-- <i class="fa fa-search fa-fw do_search" aria-hidden="true"></i>				   --}}
				  <i class="fa fa-spin fa-spinner fa-2x loading_data d-none" aria-hidden="true"></i>
			</span>
			</div>
			<input type="text" class="form-control search" aria-label="search" aria-describedby="basic-addon1">
		</div>

		<hr />
		<div class="col-md-12 col-lg-12">
			<ol class="itmes"></ol>
			<ol>
				@foreach($product->relatedProducts()->get() as $related)
          <li>
            <label>
              <input type="checkbox" checked name="related[]" value="{{ $related->relation_product }}" />
              {{ $related->product()->first()->{'title_' . lang()} }}
            </label>
          </li>
				@endforeach
			</ol>
		</div>
	</div>
</div>
