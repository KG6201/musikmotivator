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

    public function storeDownloadedMusicInformation()
    {
        $musics = Music::downloadMusicInformation();
        $items = $musics["tracks"]["items"];
        // ddd($musics["tracks"]["items"]);
        foreach ($items as $item) {
            $name = $item["name"];
            $url = "https://open.spotify.com/track/" . $item["id"];
            // create()は最初から用意されている関数
            // 戻り値は挿入されたレコードの情報
            $result = Music::create([
                "name" => $name,
                "url" => $url
            ]);
        }
            
        // ルーティング「music.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('music.index');
    }
}
