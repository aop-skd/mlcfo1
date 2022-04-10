@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
    @include('common.errors')
        <form action="{{ url('tickets/update') }}" method="POST">
            <!-- item_name -->
                <!-- Ticket_費目 -->
                <div class="form-group">
                For what?
                <div class="col-sm-6">
                <input type="text" name="expense_id" class="form-control" value="{{$ticket->expense_id}}">
                </div>
                </div>
                <!-- Ticket_Outgo -->
                <div class="form-group">
                Outgo 
                <div class="col-sm-6">
                <input type="number" name="expense_amount" class="form-control number" value="{{$ticket->expense_amount}}">
                </div>
                <!-- Ticket_Income -->
                <div class="form-group">
                Income
                <div class="col-sm-6">
                <input type="number" name="income_amount" class="form-control number" value="{{$ticket->income_amount}}">
                </div>
                </div>
                <!-- Ticket_date -->
                <div class="form-group">
                Due date
                <div class="col-sm-6">
                <input type="date" name="cfdate" class="form-control" value="{{$ticket->cfdate}}">
                </div>
                </div>
                 <!-- Ticket_Memo -->
                <div class="form-group">
                Memo
                <div class="col-sm-6">
                <input type="text" name="memo" class="form-control" value="{{$ticket->memo}}">
                </div>
                </div>
                <!-- Ticket_Status -->
                <div class="form-group">
                Status
                <div class="col-sm-6">
                    <input type="radio" name="status_id" value=1>Estimated
                    <input type="radio" name="status_id" value=2>Confirmed
                    <input type="radio" name="status_id" value=3>Done
                </div>
            </div>
            
            <!--/ item_name -->
            <!-- Save ボタン/Back ボタン -->
            <div class="well well-sm">
                <button type="submit" class="btn btn-primary">Save</button>
                <a class="btn btn-link pull-right" href="{{ url('/') }}"> Back</a>
            </div>
            <!--/ Save ボタン/Back ボタン -->
            <!-- id 値を送信 -->
            <input type="hidden" name="id" value="{{$ticket->id}}" /> <!--/ id 値を送信 -->
            <!-- CSRF -->
            {{ csrf_field() }}
            <!--/ CSRF -->
        </form>
    </div>
</div>
@endsection