<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    
    // Userテーブルとのリレーション （従テーブル側）
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    // Statusテーブルとのリレーション （従テーブル側）
    public function status() {
        return $this->belongsTo('App\Models\Status');
    }
    
    // Expenseテーブルとのリレーション （従テーブル側）
    public function expense() {
        return $this->belongsTo('App\Models\Expense');
    }
    
    
}

