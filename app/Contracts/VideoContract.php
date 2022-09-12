<?php

namespace App\Contracts;
use App\Models\Video;
use Illuminate\Support\Arr;

interface VideoContract
{
    public function update(array $data);

    public function upload(array $data);
    
    public function deleteVideo($id);
}

?>