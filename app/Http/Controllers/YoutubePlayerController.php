<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use App\Videos;

class YoutubePlayerController extends Controller
{
    /* Main Page */
    public function index()
    { 
        return view('youtube.index');
    }


    
    /* Search Videos */
    public function search(Request $request)
    {
        $options = [
            'maxResults' => 12,
            'q' => $request->input('query'),
            'type' => 'video'
        ];
       
        if ($request->input('page')) {
             $options['pageToken'] = $request->input('page');
        } 

        $youtube = \App::make('youtube');
        $videos = $youtube->search->listSearch("snippet", $options);

        
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

        $videosdb = new Videos();
        $videosdb->insert($data);        
        $videosdb->save();		
		
		$bdsearch = Videos::where('query', $request->input('query'))->orderBy('id', 'desc')->limit(12)->get();

        // after video ends, use relatedToVideoId for suggestions
        return view("youtube.search", compact('bdsearch'), ['videos' => $videos, 'query' => $request->input('query')]);
        
    }




    /* Likes Video */
    public function favoriteVideo(Request $video_id)
    {   
		Auth::user()->favorites()->attach('b' . $video_id->video_id);
        $vid = $video_id->video_id;
        $user = Videos::where('video_id', $vid)->first();
        Auth::user()->favorites()->attach($user->id);
        return back();
    }

    


    /* Remove Likes Video */
    public function unFavoriteVideo(Request $video_id)
    {	
		Auth::user()->favorites()->detach('b' . $video_id->video_id);
        $vid = $video_id->video_id;
        $user = Videos::where('video_id', $vid)->first();
        Auth::user()->favorites()->detach($user->id);		
        return back();
    }
}