<p class="badge 
    {{$level == 'user' ? 'badge-info p-2': ''}}
    {{$level == 'company' ? 'badge-primary p-2': ''}}
    {{$level == 'vendor' ? 'badge-success p-2': ''}}
">
{{ trans('admin.' . $level . '_level') }}
</p>