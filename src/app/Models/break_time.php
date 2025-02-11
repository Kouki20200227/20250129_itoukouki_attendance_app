<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_time extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = ['working_hour_id', 'break_in', 'break_out',];

    public static $rules = array(
        'working_hour_id' => 'required',
        'break_in' => 'required',
        'break_out' => 'required',
    );

// 主テーブル
    // Working_hour(単数)
    public function working_hour(){
        return $this->belongsTo(Working_hour::class);
    }
}
