<!-- resources/views/tickets.blade.php -->
@extends('layouts.app')
@push('css')
    <link href="{{ asset('css/tickets.css') }}" rel="stylesheet">
@endpush
@section('content')
 <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        @if( Auth::check() )
        <!-- バリデーションエラーの表示に使用-->
    	@include('common.errors')
        <!-- バリデーションエラーの表示に使用-->
        <!-- 投稿フォーム -->
        <form action="{{ url('settlement') }}" method="POST" class="form-horizontal" >
            {{ csrf_field() }}
            <div class="card-body">
                <div class="card shadow mb-4 CashFlowTi">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fa-solid fa-money-bill-transfer"></i>
                                Settlement</h6>
                        </div>
                        
                        <!--　登録ボタン -->
                        <div class="form-group2">
                            Sure to pay all of the list below?
                            <br><br>
                            If no, please back to <a href="{{ url('/ticketslist')}}">List</a>.
                            <div class="col-sm-offset-3 col-sm-6 button-save">
                                <button type="submit" class="btn btn-primary">
                                    Yes, proceed
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </form>
        @endif
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>		
    @endif


@endsection
