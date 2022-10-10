<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spotify;

class Music extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url',
    ];

    public static function downloadMusicInformation()
    {
        $musics = Spotify::searchTracks('Closed on Sunday')->get();
        return $musics;
    }
    
    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }
}
