<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Favorites;

class Videos extends Model
{
    /**
     * Fields that are mass assignable
     * @var array
     */
    protected $fillable = [        
        'video_id',
        'title',
        'image',
        'published'
    ];
    

    public function favorited()
    {
        return (bool) Favorites::where('user_id', Auth::id())
                                ->where('video_id', 'b' . $this->video_id)
                                ->first();
    }
    
}
