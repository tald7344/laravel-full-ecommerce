<?php

namespace App\DataTables;

use App\Model\Review;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Services\DataTable;

class ReviewDatatable extends DataTable
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
            ->addColumn('checkbox', 'admin.reviews.actions.checkbox')
            ->addColumn('product_id', 'admin.reviews.actions.productImage')
            ->addColumn('delete', 'admin.reviews.actions.delete')
            ->addColumn('approve', 'admin.reviews.actions.approve')
            ->addColumn('review_text', 'admin.reviews.actions.review_text')
            ->addColumn('created_at', 'admin.admins.actions.created_at')
          ->rawColumns([
                'checkbox', 'delete', 'product_id', 'approve', 'review_text', 'created_at'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Model\Review $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Review $model)
    {
        return $model->newQuery();
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
        ->setTableId('reviewsdatatable-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom' =>'Blfrtip', // this will make space under the lengthMenu
            'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, trans('admin.all-records')]],
            'buttons' => [
                [
                    'text' => '<i class="fa fa-plus mr-1"></i> ' . trans('admin.new_review'),
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
                this.api().columns([1, 2, 3]).every(function () {
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
            Column::make('reviewer_name')->title(trans('admin.reviewer_name')),
            Column::computed('product_id')->title(trans('admin.the_product')),
            Column::make('review')->title(trans('admin.review')),
//            Column::make('')->title(trans('admin.review_text')),
            Column::computed('review_text')
              ->title(trans('admin.review_text'))
              ->exportable(true)
              ->orderable(true)
              ->searchable(false)
              ->printable(true),
            Column::computed('created_at')
              ->title(trans('admin.column_created_at'))
              ->exportable(true)
              ->orderable(true)
              ->searchable(true)
              ->printable(true),
            Column::computed('approve')
              ->title(trans('admin.approve_status'))
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
        return 'Reviews_' . date('YmdHis');
    }
}
