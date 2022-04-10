<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket; //この行を上に追加
use Auth;//この行を上に追加
use Validator;//この行を上に追加

class SettlementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                    $tickets = Auth::user()
                        ->tickets()
                        ->orderBy('cfdate')
                        ->where('status_id', '2')
                        ->where('expense_amount', '>','0')
                        ->get();
            
             
            return view('settlement', compact('tickets'));
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
        
        $tickets = Auth::user()
                        ->tickets()
                        ->orderBy('cfdate')
                        ->where('status_id', '2')
                        ->where('expense_amount', '>','0')
                        ->update(['status_id' => 3]);


        return redirect('/settlement');
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
}
