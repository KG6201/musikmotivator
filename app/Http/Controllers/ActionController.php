<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Schedule;
use App\Models\Music;
use Validator;
use Auth;
use Carbon\Carbon;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Action DB取得
        $actions = Action::getAllOrderByFinish();

        return view('action.index', compact('actions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start = Carbon::createFromTimeString($request->start, 'Asia/Tokyo');
        $finish = Carbon::now('Asia/Tokyo');
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        // 🔽 編集 フォームから送信されてきたデータとユーザID, 終了時刻をマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id, 'start' => $start, 'finish' => $finish])->all();

        // バリデーション
        $validator = Validator::make($data, [
            'schedule_id' => 'required | exists:schedules,id',
            'start' => 'required',
            'finish' => 'required | after:start',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }

        $result = Action::create($data);
        
        // ルーティング「action.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('action.index');
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
        $action = Action::find($id);
        $schedule = Schedule::find($action->schedule_id);
        return view('action.show', compact('action', 'schedule'));
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

    public function act($id)
    {
        $start = Carbon::now('Asia/Tokyo');
        $schedule = Schedule::find($id);
        $musics = Music::getLimitedOrderByUpdated_at();
        return view('action.act', compact('start', 'schedule', 'musics'));
    }
}
