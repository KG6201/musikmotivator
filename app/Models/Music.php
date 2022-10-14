<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spotify;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        "spotify_track_id",
        "name",
        "url",
        "preview_url",
        "duration_ms",
        "spotify_artist_id",
        "artist_name",
        "artist_url",
    ];

    public static function downloadMusicInformation()
    {
        $query = 'Let it be';
        $tracks = Spotify::searchTracks($query)->get('tracks')['items'];
        return $tracks;
    }
    
    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }
}
