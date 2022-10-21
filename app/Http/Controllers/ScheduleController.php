<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Models\Schedule;
use App\Models\Category;
use Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::getAllOrderBystart();
        return view('schedule.index',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  Category::getAll();
        $schedules = Schedule::getAllOrderBystart();
        return view('schedule.create',compact('categories','schedules'));
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
            'schedule_title' => 'required | max:191',
            'start' => 'required',
            'finish'=>'required | after:start'
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('schedule.create')
            ->withInput()
            ->withErrors($validator);
        }
        // create()は最初からmodelに用意されている関数
        // 戻り値は挿入されたレコードの情報
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $result = Schedule::create($data);
        // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('schedule.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = Schedule::find($id);
        $actions = $schedule
            ->scheduleActions()
            ->orderBy('created_at','desc')
            ->get();
        $categories =  Category::getAll();    
        return view('schedule.show', compact('schedule', 'actions','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $schedule = Schedule::find($id);
        $categories =  Category::getAll();   
        return view('schedule.edit', compact('schedule','categories'));
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
        // バリデーション
        $validator = Validator::make($request->all(), [
            'schedule_title' => 'required | max:191',
            'start' => 'required',
            'finish'=>'required | after:start'
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('schedule.edit')
            ->withInput()
            ->withErrors($validator);
        }
        // create()は最初からmodelに用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = Schedule::find($id)->update($request->all());
        // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
        return redirect()->route('schedule.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Schedule::find($id)->delete();
        return redirect()->route('schedule.index');
    }
}
