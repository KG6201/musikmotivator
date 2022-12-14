<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Music;
use Spotify;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musics = Music::getAllOrderByUpdated_at();
        return view('music.index',compact('musics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('music.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeDownloadedMusicInformation($query = 'Let it be', $type = 'track')
    {
        switch ($type) {
            case 'track':
                $tracks = Music::downloadTracksInformationByQuery($query);
                break;
            case 'playlist':
                $playlists = Music::searchPlaylistsByQuery($query);
                $tracks_in_playlist = Music::downloadTracksInformationByPlaylist($playlists[0]['id']);
                foreach ($tracks_in_playlist as $track_in_playlist) {
                    $tracks[] = $track_in_playlist['track'];
                }
                break;
            default:
                $tracks = Music::downloadTracksInformationByQuery($query);
        }

        foreach ($tracks as $track) {
            if (is_null($track)) continue;

            $spotify_track_id = $track['id'];
            $name = $track['name'];
            $url = $track['external_urls']['spotify'];
            $preview_url = 'https://open.spotify.com/track/' . $spotify_track_id;
            $duration_ms = $track['duration_ms'];

            $artist = $track['artists'][0];
            $spotify_artist_id = $artist['id'];
            $artist_name = $artist['name'];
            $artist_url = $artist['external_urls']['spotify'];

            $album_images = $track['album']['images'];
            foreach ($album_images as $album_image) {
                $height = $album_image['height'];
                $album_image_url = $album_image['url'];
                $album_image_urls[$height] = $album_image_url;
            }
            $image_url = $album_image_urls[64];

            $request = compact(
                'spotify_track_id',
                'name',
                'url',
                'preview_url',
                'duration_ms',
                'spotify_artist_id',
                'artist_name',
                'artist_url',
                'image_url',
            );

            // ?????????????????????
            $validator = Validator::make($request, [
                'spotify_track_id' => 'required | max:191 | unique:music,spotify_track_id',
                'name' => 'required | max:191',
                'url' => 'required',
                'preview_url' => 'required',
                'duration_ms' => 'required',
                'spotify_artist_id' => 'required | max:191',
                'artist_name' => 'required | max:191',
                'artist_url' => 'required',
                'image_url' => 'required',
            ]);
            // ?????????????????????:?????????
            if ($validator->fails()) {
                return redirect()
                ->route('music.index')
                ->withInput()
                ->withErrors($validator);
            }

            // create()??????????????????????????????????????????
            // ????????????????????????????????????????????????
            $result = Music::create($request);
        }
            
        // ?????????????????????music.index?????????????????????????????????????????????????????????
        return redirect()->route('music.index');
    }
}
