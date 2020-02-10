<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Videos;
use App\Repositories\Interfaces\VideoRepositoryInterface;

class YoutubePlayerController extends Controller
{

    private $videoRepository;    

    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }


    /* Main Page */
    public function index()
    { 
        return view('youtube.index');
    }


    
    /* Search Videos */
    public function search(Request $request)
    {
        $max = 12;
        
        $options = [
            'maxResults' => $max,
            'q' => $request->input('query'),
            'type' => 'video'
        ];
       
        if ($request->input('page')) {
             $options['pageToken'] = $request->input('page');
        } 

        $youtube = \App::make('youtube');
        $videos = $youtube->search->listSearch("snippet", $options);

        try {
            /* DATABASE */		
            $data = [];        
            foreach ($videos as $video) {
            
                $data[] = [ 
                    'query' => $request->input('query'),              
                    'video_id' => ($video['id']['videoId']),
				    'videos_id' => ('b' . $video['id']['videoId']),
                    'title' => $video['snippet']['title'],                
                    'image' => $video['snippet']['thumbnails']['medium']['url'],
                    'published' => $video['snippet']['publishedAt']
                ];           
            
            }
        } 
        catch (\Exception $e)
        {            
            return $e;
        }

        $videosdb = new Videos();
        $videosdb->insert($data);        
        $videosdb->save();	
        
        $bdsearch = $this->videoRepository->getVideos($request);		

        // after video ends, use relatedToVideoId for suggestions
        return view("youtube.search", compact('bdsearch'), ['videos' => $videos, 'query' => $request->input('query')]);
        
    }




    /* Likes Video */
    public function favoriteVideo(Request $video_id)
    {		
        $vid = $video_id->video_id;
        $user = $this->videoRepository->favoritedVideos($video_id);
        Auth::user()->favorites()->attach('b' . $vid);
        Auth::user()->favorites()->attach($user->id);
        return back();
    }

    


    /* Remove Likes Video */
    public function unFavoriteVideo(Request $video_id)
    {			
        $vid = $video_id->video_id;
        $user = $this->videoRepository->favoritedVideos($video_id);
        Auth::user()->favorites()->detach('b' . $vid);
        Auth::user()->favorites()->detach($user->id);		
        return back();
    }

}