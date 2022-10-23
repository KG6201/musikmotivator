<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spotify;
use SpotifySeed;

class Music extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public static function downloadTracksInformationByQuery($query)
    {
        $tracks = Spotify::searchTracks($query)->get('tracks')['items'];
        return $tracks;
    }
    
    public static function searchPlaylistsByQuery($query = 'study')
    {
        // $type = 'album';
        // $items = Spotify::searchItems($query, $type)->get('albums')['items'];
        // $albums = Spotify::searchAlbums($query)->get('albums')['items'];
        // $artists = Spotify::searchArtists($query)->get('artists')['items'];
        // $episodes = Spotify::searchEpisodes($query)->get('episodes')['items'];
        $playlists = Spotify::searchPlaylists($query)->get('playlists')['items'];
        // $shows = Spotify::searchShows($query)->get('shows')['items'];
        return $playlists;
    }
    
    public static function downloadTracksInformationByPlaylist($playlist_id = '37i9dQZF1DX9c7yCloFHHL')
    {
        $tracks = Spotify::playlistTracks($playlist_id)->get('items');
        return $tracks;
    }
    
    public static function downloadPlaylistsByCategoryId($category_id)
    {
        // ddd(Spotify::categories()->get('categories')['items']);
        $category_id = '0JQ5DAqbMKFLjmiZRss79w';
        $playlists = Spotify::categoryPlaylists($category_id)->get('playlists')['items'];
        return $playlists;
    }

    public static function downloadfeaturedPlaylists()
    {
        $playlists = Spotify::featuredPlaylists()->get('playlists')['items'];
        return $playlists;
    }

    public static function downloadRecommendedTracksInformationByGenres($genres)
    {
        $genres = Spotify::availableGenreSeeds()->get('genres');
        $seed = SpotifySeed::setGenres(['gospel', 'pop', 'funk'])
            ->setTargetValence(1.00)
            ->setSpeechiness(0.3, 0.9)
            ->setLiveness(0.3, 1.0);
        $tracks = Spotify::recommendations($seed)->get('tracks');
        return $tracks;
    }

    public static function getAllOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->get();
    }
    
    public static function getLimitedOrderByUpdated_at()
    {
        return self::orderBy('updated_at', 'desc')->limit(20)->get();
    }
}
