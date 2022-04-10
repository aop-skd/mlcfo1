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
        <form action="{{ url('balance') }}" method="POST" class="form-horizontal" >
            {{ csrf_field() }}
            <div class="card-body">
                <div class="card shadow mb-4 CashFlowTi">

                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fa-solid fa-yen-sign"></i>
                                Current Balance(JPY)</h6>
                        </div>
                        
                        <!--　登録ボタン -->
                        <div class="form-group2">
                            <div class="col-sm-6">
                                <input type="number" name="balance" class="form-control number">
                            </div>
                            <div class="col-sm-offset-3 col-sm-6 button-save">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>
        </form>
        @endif
    </div>
    
        <!-- 全ての投稿リスト -->
     @if (count($balances) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>Date</th>
                        <th>Balance(JPY)</th>
                        <th>Comapny</th>
                        <th></th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($balances as $balance)
                            <tr>
                                <!-- 収支日付 -->
                                <td class="table-text">
                                    <div>{{ $balance->created_at }}</div>
                                </td>
                                
                                <!-- キャッシュフロー（支払い） -->
                                <td class="table-text">
                                    <div>{{number_format($balance->balance)}}</div>
                                </td>
                                
                                 <!-- 投稿者名の表示 -->
                                <td class="table-text">
                                    <div>{{ $balance->user->name }}</div>
                                </td>
                            
                                <!-- 削除ボタン -->
 				                <td>
                                <form action="{{ url('balance/'.$balance->id) }}" method="POST">
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
