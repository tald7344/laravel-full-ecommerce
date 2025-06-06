<?php

namespace App\DataTables;



use App\Model\Mall;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;

class MallDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', 'admin.malls.actions.checkbox')
            ->addColumn('image', 'admin.malls.actions.image')
            ->addColumn('edit', 'admin.malls.actions.edit')
            ->addColumn('delete', 'admin.malls.actions.delete')
            ->addColumn('updated_at', 'admin.admins.actions.updated_at')
            ->addColumn('created_at', 'admin.admins.actions.created_at')
            ->rawColumns([
                'checkbox', 'image', 'edit', 'delete', 'updated_at', 'created_at'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Model\Mall $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Mall $model)
    {
        return $model->newQuery()->with('country')->select('malls.*');
    }


    public static function lang()
    {
        $langJson = [
            'sProcessing'           => trans('admin.processing'),
            'sLengthMenu'           => trans('admin.lengthMenu'),
            'sZeroRecords'          => trans('admin.zeroRecords'),
            'sEmptyTable'           => trans('admin.emptyTable'),
            'sInfo'                 => trans('admin.info'),
            'sInfoEmpty'            => trans('admin.infoEmpty'),
            'sInfoFiltered'         => trans('admin.infoFiltered'),
            'sInfoPostFix'          => trans('admin.infoPostFix'),
            'sSearch'               => trans('admin.search'),
            'sUrl'                  => trans('admin.url'),
            'sInfoThousands'        => trans('admin.iInfoThousands'),
            'sLoadingRecords'       => trans('admin.loadingRecords'),
            'oPaginate' => [
                'sFirst'            => trans('admin.first'),
                'sLast'             => trans('admin.last'),
                'sNext'             => trans('admin.next'),
                'sPrevious'         => trans('admin.previous'),
            ],
            'oAria' => [
                'sSortAscending'    => trans('admin.sortAscending'),
                'sSortDescending'   => trans('admin.sortDescending')
            ]
        ] ;
        return $langJson;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('mallsdatatable-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom' =>'Blfrtip', // this will make space under the lengthMenu
            'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('admin.all-records')]],
            'buttons' => [
                [
                    'text' => '<i class="fa fa-plus mr-1"></i> ' . trans('admin.new_mall'),
                    'className' => 'btn btn-info text-white mx-1',
                    'action' => 'function () {
                        window.location.href = "' . URL::current() . '/create";
                    }'
                ],
                ['extend' => 'print', 'className' => 'btn btn-primary text-white mx-1', 'text' => '<i class="fa fa-print"></i>'],
                ['extend' => 'csv', 'className' => 'btn btn-info text-white mx-1', 'text' => '<i class="fa fa-file mr-2"></i> ' . trans('admin.export_csv')],
                ['extend' => 'excel', 'className' => 'btn btn-success text-white mx-1', 'text' => '<i class="fa fa-file mr-2"></i> ' . trans('admin.export_excel')],
                ['extend' => 'reload', 'className' => 'btn btn-outline-secondary mx-1', 'text' => '<i class="fa fa-sync"></i>'],
                [
                    'text' => '<i class="fa fa-trash mr-1"></i> ' . trans('admin.delete_all'),
                    'className' => 'btn btn-danger text-white mx-1 delete_all',
                ],
            ],
            'initComplete' => "function () {
                this.api().columns([2, 3, 4, 5, 6]).every(function () {
                    var column = this;
                    var input = document.createElement(\"input\");
                    input.style.width = '100%';
                    $(input).appendTo($(column.footer()).empty())
                    .on('keyup', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            }",
            'language' => self::lang()

        ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('checkbox')
            ->title('<input type="checkbox" class="check_all" onclick="check_all();" />')
            ->exportable(false)
            ->orderable(false)
            ->searchable(false)
            ->printable(false),
            Column::make('id'),
            Column::make('malls_name_ar')->title(trans('admin.malls_name_ar')),
            Column::make('malls_name_en')->title(trans('admin.malls_name_en')),
            Column::make('mobile')->title(trans('admin.mobile')),
            Column::make('contact_name')->title(trans('admin.contact_name')),
            Column::make('country_id')
              ->title(trans('admin.country_id'))
              ->data('country.countries_name_' . session('lang')),
            Column::computed('image')
            ->title(trans('admin.mall_image'))
            ->exportable(false)
            ->orderable(false)
            ->searchable(false)
            ->printable(false),
            Column::computed('created_at')
              ->title(trans('admin.column_created_at'))
              ->exportable(true)
              ->orderable(true)
              ->searchable(true)
              ->printable(true),
            Column::computed('updated_at')
              ->title(trans('admin.column_updated_at'))
              ->exportable(true)
              ->orderable(true)
              ->searchable(true)
              ->printable(true),
            Column::computed('edit')
              ->title(trans('admin.edit'))
              ->exportable(false)
              ->printable(false)
              ->orderable(false)
              ->searchable(false)
              ->width(50)
              ->addClass('text-center'),
            Column::computed('delete')
              ->title(trans('admin.delete'))
              ->exportable(false)
              ->orderable(false)
              ->searchable(false)
              ->printable(false)
              ->width(50)
              ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'malls_' . date('YmdHis');
    }
}
