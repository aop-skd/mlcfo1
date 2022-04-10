<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    
    // Ticketsテーブルとのリレーション （主テーブル側）
    public function tickets() {
        return $this->hasMany('App\Models\Ticket');
    }

    
}
