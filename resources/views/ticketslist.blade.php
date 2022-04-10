<!-- resources/views/tickets.blade.php -->
@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/tickets.css') }}" rel="stylesheet">
@endpush
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        @if( Auth::check() )
        
        <div class="card shadow mb-4 CashFlowTi">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa-solid fa-clipboard-list"></i>
                    Imput new Ticket</h6>
            </div>
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム -->
        <form action="{{ url('tickets') }}" method="POST" class="form-horizontal ticketform">
            {{ csrf_field() }}
            <!-- Ticket_費目 -->
            <div class="form-group">
                For what?
                <div class="col-sm-60">
                    <select name="expense_id">
                        @foreach ($expenses as $expense)
                        <option value="{{ $expense->id }}">{{ $expense->id}}.{{ $expense->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="OutgoIncome">
                <!-- Ticket_Outgo -->
                <div class="form-group">
                    Outgo 
                    <div class="col-sm-60">
                        <input type="number" name="expense_amount" class="form-control number">
                    </div>
                </div>
                <!-- Ticket_Income -->
                <div class="form-group">
                    Income
                    <div class="col-sm-60">
                        <input type="number" name="income_amount" class="form-control number">
                    </div>
                </div>
            </div>
            <div class="OutgoIncome">
                <!-- Ticket_date -->
                <div class="form-group">
                    Due date
                    <div class="col-sm-60">
                        <input type="date" name="cfdate" class="form-control">
                    </div>
                </div>
                <!-- Ticket_Status -->
                <div class="form-group form-status">
                    Status
                    <div class="col-sm-60">
                        <input type="radio" name="status_id" value=1 checked="checked">Estimated
                        <input type="radio" name="status_id" value=2>Confirmed
                    </div>
                </div>
            </div>
            <!-- Ticket_Memo -->
            <div class="form-group">
                Memo
                <div class="col-sm-60">
                    <input type="text" name="memo" class="form-control">
                </div>
            </div>

            <!--　登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-60">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </form>
        @endif
    </div>
    </div>
    
    <!-- 全ての投稿リスト -->
     @if (count($tickets) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>DueDate</th>
                        <th>Type</th>
                        <th>Memo</th>
                        <th>Outgo</th>
                        <th>Income</th>
                        <th>Status</th>
                        <th>Company</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <!-- 収支日付 -->
                                <td class="table-text">
                                    <div>{{ $ticket->cfdate }}</div>
                                </td>
                                
                                <!-- type -->
                                <td class="table-text">
                                    <div>{{ $ticket->expense_id }}</div>
                                </td>
                                
                                <!-- 明細 -->
                                <td class="table-text">
                                    <div>{{ $ticket->memo }}</div>
                                </td>
                                
                                <!-- キャッシュフロー（支払い） -->
                                <td class="table-text">
                                    <div>{{number_format($ticket->expense_amount)}}</div>
                                </td>
                                <!-- キャッシュフロー（入金） -->
                                <td class="table-text">
                                    <div>{{number_format($ticket->income_amount)}}</div>
                                </td>
                                
                                <!-- Status -->
                                <td class="table-text">
                                    <div>{{ $ticket->status->name }}</div>
                                </td>
				
                                 <!-- 投稿者名の表示 -->
                                <td class="table-text">
                                    <div>{{ $ticket->user->name }}</div>
                                </td>
                                
                                <!-- 更新ボタン　-->
                                <td>
	                            <form action="{{ url('ticketsedit/'.$ticket->id) }}" method="GET"> {{ csrf_field() }}
	                            <button type="submit" class="btn btn-success">
	                                <i class="fa-solid fa-pen"></i>
	                            </button> 
	                            </form>
                                </td>
                                
 				                <!-- 削除ボタン -->
 				                <td>
                                <form action="{{ url('ticket/'.$ticket->id) }}" method="POST">
                                 {{ csrf_field() }}
                                 {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger">
                                 <i class="fa-solid fa-trash-can"></i>
                                </button>
                                </form>
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>		
    @endif
    

@endsection
