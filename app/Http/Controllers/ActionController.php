<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Action;
use App\Models\Schedule;
use App\Models\Music;
use Validator;
use Auth;

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
        // バリデーション
        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required | exists:schedules,id',
            'start' => 'required',
            'finish' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($validator);
        }
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        // 🔽 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id, 'schedule_id' => $request->schedule_id])->all();
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
        $actions = Action::find($id);
        $schedules = Schedule::find($actions->schedule_id);

        return view('action.show', [
            'actions'   => $actions,
            'schedules' => $schedules,
        ]);

        
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

    public function act(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required',
            'start' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('schedule.index')
            ->withInput()
            ->withErrors($validator);
        }

        $schedule = Schedule::find($request->id);
        $musics = Music::getLimitedOrderByUpdated_at();
        return view('action.act', compact('request', 'schedule', 'musics'));
    }
}
