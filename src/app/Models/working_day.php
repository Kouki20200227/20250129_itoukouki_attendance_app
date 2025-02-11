<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Working_day extends Model
{
    use HasFactory;

// 従テーブル
    // Working_hour(複数)
    public function working_hours(){
        return $this->hasMany(Working_hour::class);
    }
}
