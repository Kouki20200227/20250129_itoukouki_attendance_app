<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_hour extends Model
{
    use HasFactory;

// 主テーブル
    //User（単数）
    public function user(){
        return $this->hasOne(User::class);
    }
    // Working_day(単数)
    public function working_day(){
        return $this->belongsTo(Working_day::class);
    }

// 従テーブル
    // Break_time(複数)
    public function break_times(){
        return $this->hasMany(Break_time::class);
    }
}
