<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance; //この行を上に追加
use App\Models\User;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加

class BalancesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            if (Auth::check()) {
             //ログインユーザーの登録分を取得
            $balances = Auth::user()->balances()->orderBy('created_at', 'desc')->get();
             
            return view('balance', compact('balances'));
            
        }else{
            $balances = Balance::orderBy('created_at', 'desc')->get();
            
            return view('balance', compact('balances'));
            
        }
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
              //バリデーション 
        $validator = Validator::make($request->all(), [
           
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $balances = new Balance;
        $balances->balance = $request->balance;
        $balances->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $balances->save();
        
        return redirect('/balance');
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
    public function destroy(Balance $balance)
    {
        $balance->delete();
        return redirect('/balance');
    }
}
