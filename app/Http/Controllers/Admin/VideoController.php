<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use  App\Http\Requests\Admin\VideoRequest;
use  App\Http\Requests\Admin\EditVideoRequest;

use App\DataTables\VideoDataTable;

use App\Models\Video;

use App\Contracts\VideoContract;

class VideoController extends Controller
{
    public function __construct(VideoContract $videoService)
	{
		$this->videoService = $videoService;
	}

    public function index(VideoDataTable $dataTable)
    {
        return $dataTable->render('admin/my_video_list');
    }

    public function create()
    {
        //
    }

    public function store(VideoRequest $request)
    {
         return $this->videoService->upload($request->all());
     
    }

    public function show($id)
    {
        //
    }

    public function edit(Video $video)
    {
        return view('admin.form.edit_video_details', compact('video'));
    }

    public function update(EditVideoRequest $request)
    {
        return $this->videoService->update($request->all());
    }

    public function destroy(Video $video)
    {
        return $this->videoService->deleteVideo($video->id);
    }
}
