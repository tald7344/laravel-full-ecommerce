@if($categories->isNotEmpty())
  <div class="sidebar-categories box-drop-shadow">
    <div class="head">{{trans('product.products-categories')}}</div>
    <ul class="main-categories">
      <li class="main-nav-list">
        <a href="{{ url('shop/'. $sort) }}">
          <span class="lnr lnr-arrow-right"></span>{{ trans('product.all') }}<span class="number">( {{ $productsCount }} )</span>
        </a>
      </li>
      @foreach($categories as $category)
        <li class="main-nav-list" data-level="1">
          @if (is_null($category->parent) && $category->sons->isNotEmpty())
            <a data-toggle="collapse" href="#category_{{$category->id}}" aria-expanded="false"
               aria-controls="category_{{$category->id}}">
              <span class="lnr lnr-arrow-right"></span>{{ $category->{'dep_name_' . lang()} }}
            </a>
            <ul class="collapse" id="category_{{$category->id}}" data-toggle="collapse" aria-expanded="false"
                aria-controls="category_{{$category->id}}">
              @foreach($category->sons as $cat)
                @if ($cat->sons->isNotEmpty())
                  <li class="main-nav-list child" data-level="2">
                    <a data-toggle="collapse" href="#category_{{$cat->id}}" aria-expanded="false"
                       aria-controls="category_{{$cat->id}}">
                      <span class="lnr lnr-arrow-right"></span>{{ $cat->{'dep_name_' . lang()} }}
                    </a>
                    <ul class="collapse" id="category_{{$cat->id}}" data-toggle="collapse"
                        aria-expanded="false" aria-controls="category_{{$cat->id}}">
                      @foreach($cat->sons as $subCategory)
                        <li class="main-nav-list sub-child" data-level="3">
                          <a class="{{$pl_5}}"
                             href="{{ url('shop/'. $sort . '/' . $subCategory->id) }}">{{ $subCategory->{'dep_name_' . lang()} }}
                            <span class="number">( {{ $subCategory->products_count }} )</span></a>
                        </li>
                      @endforeach
                    </ul>
                  </li>
                @else
                  <li class="main-nav-list child">
                    <a href="{{ url('shop/'. $sort . '/' . $cat->id) }}">{{ $cat->{'dep_name_' . lang()} }}
                      <span class="number">( {{ $cat->products_count }} )</span></a>
                  </li>
                @endif

              @endforeach
            </ul>
          @elseif (is_null($category->parent) && $category->sons->isEmpty())
            <a href="{{ url('shop/'. $sort . '/' . $category->id) }}">
              <span class="lnr lnr-arrow-right"></span>{{ $category->{'dep_name_' . lang()} }}<span
                class="number">( {{ $category->products_count }} )</span>
            </a>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
@endif
