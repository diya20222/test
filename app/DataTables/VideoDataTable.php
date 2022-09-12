<?php

namespace App\DataTables;

use App\Models\Video;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VideoDataTable extends DataTable
{
    
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('thumbnail', function ($data) {
                return "<img src= $data->thumbnail data-video=$data->video class='rounded showMediaVideo' width=200px height=200px/>";
            })
            ->addColumn('action', function ($data) {
                $myroute = route('admin.video_edit',$data->id);
                $result = '<a href='.$myroute.' class="btn btn-sm btn-success" style = "padding:5px 6px;"><i class="fa fa-edit"></i></a>';
                $result .=  '<button type="button" id="deleteRecord" style = "padding:5px 6px;" class="btn btn-sm btn-danger" video_id="' . $data->id . '"><i class="fa fa-trash"></i></button>';
                return $result;
            }) 
            // ->addcolumn('category_id', function($data){
            //     return $data->category->category_name;
            // })
            ->addColumn('likes', function ($data) {
                return $data->videoLike->count();
            })
            ->addColumn('comments', function ($data) {
                return $data->videoComment->count();
            })
            ->filterColumn('category_id', function ($data, $keyword) {
                $sql = "categories.category_name like ?";
                $data->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['action', 'thumbnail','category_id','likes','comments'])
            ->addIndexColumn();
    }
    
    public function query(Video $model)
    {
        $model = $model->leftjoin('categories', 'categories.id', '=', 'videos.category_id')
        ->select('videos.*', 'categories.category_name')
        ->newQuery();

        return $model->with(['videoLike','videoComment'])->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('video-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Blfrtip')
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
            Column::make('id')->data('DT_RowIndex')->orderable(false),
            Column::make('thumbnail'),
            Column::make('video_link'),
            Column::make('category_id'),
            Column::make('video_title'),
            Column::make('tag'),
            Column::make('description'),
            Column::make('published_at'),
            Column::make('likes'),
            Column::make('comments'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    protected function filename()
    {
        return 'Video_' . date('YmdHis');
    }
}
