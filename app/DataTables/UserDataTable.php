<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Video;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
 
class UserDataTable extends DataTable
{
  
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('image', function ($data) {
                $result = "<img src = $data->image height='50px' width='50px'>";
                return $result;
            })
            ->addColumn('action', function ($data) {
                $result = "<a href='profile-user/$data->id' class='btn-sm btn-info' style = 'padding:5px 6px;'><i class='fa fa-eye'></i></a> ";
                $result .= '<button type="button" id="deleteUserRecord" style = "padding:5px 6px;" class="btn btn-sm btn-danger" user_id="' . $data->id . '"><i class="fa fa-trash"></i></button>';
                $result .= "<a style = 'padding:5px 6px;' href='edit-user/$data->id' class='btn-sm btn-success'><i class='fa fa-key' style = 'margin-top:20px;'></i></a>";
                return $result;
            })  
            ->addColumn('video', function ($data) {
                return $data->video->count();
            })
            ->addColumn('like', function ($data) {
                return $data->like->count();
            })
            ->addColumn('comment', function ($data) {
                return $data->comment->count();
            })
            ->rawColumns(['action', 'image','like','comment'])
            ->addIndexColumn();
    }
  
    public function query(User $model)
    {
        return $model->with(['video', 'like','comment'])->newQuery(); 
    }
    
    public function html()
    {
        return $this->builder()
            ->setTableId('user-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('mobile'),
            Column::make('image'),
            Column::make('video'),
            Column::make('like'),
            Column::make('comment'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
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
        return 'User_' . date('YmdHis');
    }
}
