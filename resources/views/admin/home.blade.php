@extends('admin.index')

@section('content')


<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $ordersCount }}</h3>
            <p>{{ trans('admin.orders') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-box-open"></i>
          </div>
          <a href="{{ aurl('orders') }}" class="small-box-footer">{{ trans('admin.more-info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $productsCount }}<sup style=""></sup></h3>
            <p>{{ trans('admin.products') }}</p>
          </div>
          <div class="icon">
            <i class="fab fa-product-hunt"></i>
          </div>
          <a href="{{ aurl('product') }}" class="small-box-footer">{{ trans('admin.more-info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="background-color:#F39C12;color: #fff;">
          <div class="inner">
            <h3>{{ $usersCount }}</h3>

            <p>{{ trans('admin.users') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-plus"></i>
          </div>
          <a href="{{ aurl('user') }}" class="small-box-footer">{{ trans('admin.more-info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box" style="background-color: #E74C3C;color: #fff;">
          <div class="inner">
            <h3>{{ $productVisit }}</h3>

            <p>{{ trans('admin.unique-visitors') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-chart-pie"></i>
          </div>
          <a href="#" class="small-box-footer" style="visibility: hidden">{{ trans('admin.more-info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box" style="background-color: #6C3483;color: #fff;">
          <div class="inner">
            <h3>{{ $tradeMarksCount }}</h3>
            <p>{{ trans('admin.trademarks') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-trademark"></i>
          </div>
          <a href="{{ aurl('trademark') }}" class="small-box-footer">{{ trans('admin.more-info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{ $mallsCount }}</h3>
            <p>{{ trans('admin.malls') }}</p>
          </div>
          <div class="icon">
            <i class="fa fa-building"></i>
          </div>
          <a href="{{ aurl('mall') }}" class="small-box-footer">{{ trans('admin.more-info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box" style="background-color: #17A589;color: #fff;">
          <div class="inner">
            <h3>{{ $manufactoriesCount }}</h3>
            <p>{{ trans('admin.manufactories') }}</p>
          </div>
          <div class="icon">
            <i class="fas fa-industry"></i>
          </div>
          <a href="{{ aurl('manufactory') }}" class="small-box-footer">{{ trans('admin.more-info') }} <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
          @include('admin.home.unique-visitors-graph-home')

          @include('admin.home.chat-home')

          @include('admin.home.to-do-home')
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">
        @include('admin.home.calendar-home')

        @include('admin.home.map-visitors')

        @include('admin.home.sales-graph-home')
        <!-- /.card -->
      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->

@endsection

