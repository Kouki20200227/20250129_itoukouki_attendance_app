<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_time extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = ['work_id', 'break_in', 'break_out',];

    public static $rules = array(
        'work_id' => 'required',
        'break_in' => 'required',
        'break_out' => 'required',
    );

// 主テーブル
    // Work(単数)
    public function work(){
        return $this->belongsTo(Work::class);
    }
}
