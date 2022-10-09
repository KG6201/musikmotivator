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

    public static function getSpecifiedMusics()
    {
        $musics = Spotify::searchTracks('Closed on Sunday')->get();
        return $musics;
    }
}
