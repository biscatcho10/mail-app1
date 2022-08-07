<?php

namespace App\DataTables;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $page = "categories";
        return datatables()
            ->eloquent($query)
            ->addColumn('name', function ($data) use ($page) {
                return ucfirst($data->name);
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
     * @param Category $model
     * @return Builder
     */
    public function query(Category $model): Builder
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
            ->dom('Blfrtip')
            ->lengthMenu([10, 25, 50, 100])
            ->parameters([
                'stateSave' => true,
            ])
            ->orderBy(0, "asce")
            ->buttons(
                Button::make('reset'),
                Button::make('reload'),
                Button::make('excel'),
//                Button::make('pdf'),
                Button::make('csv'),
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
            Column::make('name'),
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
        return 'Categories_' . date('YmdHis');
    }

//    public function pdf()
//    {
//        $data = Category::all()->toArray();
//
//        view()->share('employee',$data);
//        $pdf = PDF::loadView('admin.components.category.pdf_view', $data );
//
//        // download PDF file with download method
//        return $pdf->download('pdf_file.pdf');
//    }
}
