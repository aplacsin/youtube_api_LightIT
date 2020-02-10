<?php
namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface VideoRepositoryInterface
{    
    public function getVideos(Request $request);

    public function favoritedVideos(Request $video_id);   
       
}