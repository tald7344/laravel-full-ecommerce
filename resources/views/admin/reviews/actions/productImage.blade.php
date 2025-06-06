@php
  $product = \App\Model\Product::find($product_id);
  $productImageUrl = $product->photo;
  $productName = $product->{'title_'.lang()};
@endphp
<a href="{{aurl('product/' . $product_id . '/edit')}}" title="{{ $productName }}" class="text-primary">
  @if (Storage::exists($productImageUrl))
    <img class="img-thumbnail" width="100" src="{{ Storage::url($productImageUrl) }}" >
  @else
    {{ words($productName, 10) }}
  @endif
</a>
