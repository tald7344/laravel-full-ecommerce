<div class="card">
  <div class="card-header">
    <i class="far fa-calendar-alt"></i> {{ trans('admin.calendar') }}
    <div class="card-tools">
      <!-- button with a dropdown -->
      <div class="btn-group">
        <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
          <i class="fas fa-bars"></i></button>
        <div class="dropdown-menu" role="menu">
          <a href="javascript:void(0)" class="dropdown-item" id="delete_events">{{ trans('admin.clear-event') }}</a>
        </div>
      </div>
      <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-default btn-sm" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div id='full_calendar_events'></div>
  </div>
</div>
