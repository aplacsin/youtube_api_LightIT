<?php
namespace App\Repositories;
use App\Videos;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\VideoRepositoryInterface;

class VideoRepository implements VideoRepositoryInterface
{    
    public function getVideos(Request $request)
    {
        return Videos::where('query', $request->input('query'))->orderBy('id', 'desc')->limit(12)->get();
    }

    public function favoritedVideos(Request $video_id)
    {
        return Videos::where('video_id', $video_id->video_id)->first();
    }    

}