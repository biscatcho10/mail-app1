<?php

namespace App\DataTables;

use App\Models\Mail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class MailsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $page = "mails";
        return datatables()
            ->eloquent($query)
            ->editColumn("receiver", function ($data) {
                return implode(" | ", json_decode($data->receiver));
            })
            ->editColumn('scheduled',function ($data) use ($page) {
                if ($data->scheduled){
                    $data->scheduled = "Yes";
                }
                else{
                    $data->scheduled = "No";
                }
                return $data->scheduled;
            })
            ->editColumn('sent', function ($data) use ($page) {
                if(Carbon::now()->gt($data->sent_time))
                    return 'Sent';
                else
                    return 'Not Sent';
            })
            ->addColumn('action', function ($data) use ($page) {
                return view('admin/components/datatable/actions', compact("data", "page"));
            })
            ->editColumn("created_at", function ($data) {
                return Carbon::parse($data->created_at)->diffForHumans();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Mail $model
     * @return Builder
     */
    public function query(Mail $model): Builder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->rowId("id")
            ->setTableId('dataTable')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->paging(true)
            ->info()
            ->dom('Blfrtip')
            ->lengthMenu([10, 25, 50, 100])
            ->parameters([
                'stateSave' => true,
            ])
            ->orderBy(4, "asce")
            ->buttons(
                Button::make('reset'),
                Button::make('reload'),
                Button::make('excel'),
//                Button::make('pdf'),
                Button::make('csv'),
                Button::make('print'),

            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title("ID"),
            Column::make('sender'),
            Column::make('receiver'),
            Column::make('subject'),
            Column::make('scheduled'),
            Column::make('sent_time'),
            Column::make('sent'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Mails_' . date('YmdHis');
    }
}
