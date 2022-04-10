<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket; //この行を上に追加
use App\Models\User;//この行を上に追加
use App\Models\Expense;//この行を上に追加
use App\Models\Balance;//この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加

class TicketsController extends Controller
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

            $tickets = Auth::user()
                        ->tickets()
                        ->orderBy('cfdate')
                        ->select('cfdate')
                        ->whereDate('cfdate', '>=', today())
                        ->selectRaw('SUM(expense_amount) as sum_expense')
                        ->selectRaw('SUM(income_amount) as sum_income')
                        ->groupBy('cfdate')
                        ->get();
            
            $balances = Auth::user()
                        ->balances()
                        ->orderBy('created_at','desc')
                        ->first();
            
            $expenses = Expense::all();
            
            $ticket2s = Auth::user()
                        ->tickets()
                        ->orderBy('cfdate')
                        ->where('status_id', '2')
                        ->where('expense_amount', '>','0')
                        ->get();
             
            return view('tickets', compact('tickets', 'expenses', 'balances','ticket2s'));
            
        }else{
            $tickets = Ticket::orderBy('cfdate', 'asc')
                        ->select('cfdate')
                        ->selectRaw('SUM(expense_amount) as sum_expense')
                        ->selectRaw('SUM(income_amount) as sum_income')
                        ->groupBy('cfdate')
                        ->get();
                        
            $balances = Balance::orderBy('created_at','desc')
                        ->first();
            
            $expenses = Expense::all();
            
            $ticket2s = Ticket::orderBy('cfdate')
                        ->where('status_id', '2')
                        ->where('expense_amount', '>','0')
                        ->get();
            
            return view('tickets', compact('tickets','expenses', 'balances','ticket2s'));
            
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
            'memo' => 'required|max:255',
        ]);
        
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        //以下に登録処理を記述（Eloquentモデル）
        $tickets = new Ticket;
        $tickets->expense_id = $request->expense_id;
        $tickets->expense_amount = $request->expense_amount;
        $tickets->income_amount = $request->income_amount;
        $tickets->cfdate = $request->cfdate;
        $tickets->memo = $request->memo;
        $tickets->status_id = $request->status_id;
        $tickets->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $tickets->save();
        
        return redirect('/ticketslist');
        
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
    public function edit(Ticket $ticket)
    {
        return view('ticketsedit',[
            'ticket'=>$ticket
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'memo' => 'required|max:255',
            
        ]);
        
        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        // Eloquent モデル
        $tickets = Ticket::find($request->id);
        $tickets->expense_id = $request->expense_id;
        $tickets->expense_amount = $request->expense_amount;
        $tickets->income_amount = $request->income_amount;
        $tickets->cfdate = $request->cfdate;
        $tickets->memo = $request->memo;
        $tickets->status_id = $request->status_id;
        $tickets->save(); 
        
        return redirect('/');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy (Ticket $ticket)
    {
     $ticket->delete();
     return redirect('/ticketslist');
    }
    
    
}
