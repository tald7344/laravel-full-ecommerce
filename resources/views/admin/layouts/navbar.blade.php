  <!-- Navbar -->
  @include('admin.layouts.menu')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin') }}" class="brand-link">
      <img src="{{ Storage::url(setting()->icon) }}" alt="{{ setting()->{'sitename_'.lang()} }}" class="brand-image img-circle" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ trans('admin.website-panel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/default-avatar.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ aurl('user') }}" class="d-block">{{admins()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="{{aurl()}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ trans('admin.main') }}
                <span class="right badge badge-danger d-none">New</span>
              </p>
            </a>
          </li> --}}
          <li class="nav-item has-treeview {{activate_menu('admin')[0]}}">
            <a href="#" class="nav-link {{activate_menu('admin')[1]}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                {{ trans('admin.main')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="{{ activate_menu('admin')[2] }}">
              <li class="nav-item">
                <a href="{{aurl()}}" class="nav-link">
                  <i class="fa fa-chart-line nav-icon"></i>
                  <p>{{ trans('admin.main')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{aurl('settings')}}" class="nav-link">
                  <i class="fa fa-cog nav-icon"></i>
                  <p>{{ trans('admin.settings')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{aurl('home-banner')}}" class="nav-link">
                  <i class="fa fa-image nav-icon"></i>
                  <p>{{ trans('admin.homeBanners')}}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{activate_menu('admin')[0]}}">
            <a href="#" class="nav-link {{activate_menu('admin')[1]}}">
              <i class="nav-icon fa fa-users-cog"></i>
              <p>
                {{ trans('admin.adminPanel')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="{{ activate_menu('admin')[2] }}">
              <li class="nav-item">
                <a href="{{aurl('admin')}}" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>{{ trans('admin.admin')}}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{activate_menu('user')[0]}}">
            <a href="#" class="nav-link {{activate_menu('user')[1]}}">
              <i class="nav-icon fa fa-users"></i>
              <p>
                {{ trans('admin.userPanel')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="{{ activate_menu('user')[2] }}">
              <li class="nav-item">
                <a href="{{aurl('user')}}" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>{{ trans('admin.userPanel')}}</p>
                </a>
              </li>
{{--              <li class="nav-item">--}}
{{--                <a href="{{aurl('user')}}?level=user" class="nav-link">--}}
{{--                  <i class="fa fa-user nav-icon"></i>--}}
{{--                  <p>{{ trans('admin.user_level')}}</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li class="nav-item">--}}
{{--                <a href="{{aurl('user')}}?level=company" class="nav-link">--}}
{{--                  <i class="fa fa-building nav-icon"></i>--}}
{{--                  <p>{{ trans('admin.company_level')}}</p>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li class="nav-item">--}}
{{--                <a href="{{aurl('user')}}?level=vendor" class="nav-link">--}}
{{--                  <i class="fa fa-store nav-icon"></i>--}}
{{--                  <p>{{ trans('admin.vendor_level')}}</p>--}}
{{--                </a>--}}
{{--              </li>--}}
            </ul>
          </li>
          @if (setting()->menu_control == 'show')
            <li class="nav-item has-treeview {{activate_menu('menu')[0]}}">
              <a href="#" class="nav-link {{activate_menu('menu')[1]}}">
                <i class="nav-icon fas fa-list-ul"></i>
                <p>
                  {{ trans('admin.menuPanel')}}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="{{ activate_menu('menu')[2] }}">
                <li class="nav-item">
                  <a href="{{aurl('menu')}}" class="nav-link">
                    <i class="fas fa-list-ul nav-icon"></i>
                    <p>{{ trans('admin.menus')}}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{aurl('link')}}" class="nav-link">
                    <i class="fa fa-link nav-icon" aria-hidden="true"></i>
{{--                    <i class="fas fa-list-ul nav-icon"></i>--}}
                    <p>{{ trans('admin.links')}}</p>
                  </a>
                </li>
              </ul>
            </li>
          @endif
          <li class="nav-item has-treeview {{activate_menu('page')[0]}}">
            <a href="#" class="nav-link {{activate_menu('page')[1]}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                {{ trans('admin.pagePanel')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="{{ activate_menu('page')[2] }}">
              <li class="nav-item">
                <a href="{{aurl('page')}}" class="nav-link">
                  <i class="fas fa-copy nav-icon"></i>
                  <p>{{ trans('admin.pages')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{aurl('page/create')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>{{ trans('admin.new_page')}}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{activate_menu('departement')[0]}}">
              <a href="#" class="nav-link {{activate_menu('departement')[1]}}">
                  <i class="nav-icon fa fa-tags"></i>
                  <p>
                      {{ trans('admin.departements')}}
                      <i class="right fas fa-angle-left"></i>
                  </p>
              </a>
              <ul class="nav nav-treeview" style="{{ activate_menu('departement')[2] }}">
                  <li class="nav-item">
                      <a href="{{aurl('departement')}}" class="nav-link">
                          <i class="fa fa-tags nav-icon"></i>
                          <p>{{ trans('admin.departements')}}</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{aurl('departement/create')}}" class="nav-link">
                          <i class="fa fa-plus nav-icon"></i>
                          <p>{{ trans('admin.new_departement')}}</p>
                      </a>
                  </li>
              </ul>
          </li>
          <li class="nav-item has-treeview {{activate_menu('product')[0]}}">
            <a href="#" class="nav-link {{activate_menu('product')[1]}}">
              <i class="nav-icon fab fa-product-hunt"></i>
              <p>
                {{ trans('admin.products')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="{{ activate_menu('product')[2] }}">
              <li class="nav-item">
                <a href="{{aurl('product')}}" class="nav-link">
                  <i class="fab fa-product-hunt nav-icon"></i>
                  <p>{{ trans('admin.products')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{aurl('orders')}}" class="nav-link">
                  <i class="fas fa-box-open nav-icon"></i>
                  <p>{{ trans('admin.orders')}}</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview {{activate_menu('location')[0]}}">
            <a href="#" class="nav-link {{activate_menu('location')[1]}}">
              <i class="nav-icon fas fa-map-marked-alt"></i>
              <p>
                {{ trans('admin.location')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="{{ activate_menu('departement')[2] }}">
              <li class="nav-item">
                <a href="{{aurl('country')}}" class="nav-link">
                  <i class="nav-icon fa fa-flag"></i>
                  <p>{{ trans('admin.countries')}}</p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('city')[0]}}">
                <a href="{{aurl('city')}}" class="nav-link {{activate_menu('city')[1]}}">
                  <i class="nav-icon fa fa-flag"></i>
                  <p>
                    {{ trans('admin.cities')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('state')[0]}}">
                <a href="{{aurl('state')}}" class="nav-link {{activate_menu('state')[1]}}">
                  <i class="nav-icon fa fa-flag"></i>
                  <p>
                    {{ trans('admin.states')}}
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-plus"></i>
              <p>
                {{ trans('admin.other')}}
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="{{ activate_menu('departement')[2] }}">
              <li class="nav-item has-treeview {{activate_menu('trademark')[0]}}">
                <a href="{{aurl('trademark')}}" class="nav-link {{activate_menu('trademark')[1]}}">
                  <i class="nav-icon fa fa-cube"></i>
                  <p>
                    {{ trans('admin.trademarks')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('manufactory')[0]}}">
                <a href="{{aurl('manufactory')}}" class="nav-link {{activate_menu('manufactory')[1]}}">
                  <i class="nav-icon fas fa-industry"></i>
                  <p>
                    {{ trans('admin.manufactories')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('shipping')[0]}}">
                <a href="{{aurl('shipping')}}" class="nav-link {{activate_menu('shipping')[1]}}">
                  <i class="nav-icon fa fa-truck"></i>
                  <p>
                    {{ trans('admin.shippings')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('mall')[0]}}">
                <a href="{{aurl('mall')}}" class="nav-link {{activate_menu('mall')[1]}}">
                  <i class="nav-icon fa fa-building"></i>
                  <p>
                    {{ trans('admin.malls')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('size')[0]}}">
                <a href="{{aurl('color')}}" class="nav-link {{activate_menu('color')[1]}}">
                  <i class="nav-icon fa fa-paint-brush"></i>
                  <p>
                    {{ trans('admin.colors')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('size')[0]}}">
                <a href="{{aurl('size')}}" class="nav-link {{activate_menu('size')[1]}}">
                  <i class="nav-icon fa fa-circle"></i>
                  <p>
                    {{ trans('admin.sizes')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('weight')[0]}}">
                <a href="{{aurl('weight')}}" class="nav-link {{activate_menu('weight')[1]}}">
                  <i class="nav-icon fa fa-weight "></i>
                  <p>
                    {{ trans('admin.weights')}}
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{activate_menu('review')[0]}}">
                <a href="{{aurl('review')}}" class="nav-link {{activate_menu('review')[1]}}">
                  <i class="nav-icon fa fa-star" aria-hidden="true"></i>
                  <p>
                    {{ trans('admin.reviews')}}
                  </p>
                </a>
              </li>
            </ul><!--.nav-->
          </li><!--.nav-item-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
