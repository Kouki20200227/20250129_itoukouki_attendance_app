<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Change_request extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = [
        'user_id',
        'work_id',
        'change_work_in',
        'change_work_out',
        'change_break_in1',
        'change_break_out1',
        'change_break_in2',
        'change_break_out2',
        'change_remarks',
    ];

    public static $rules = [
        'user_id' => 'required',
        'work_id' => 'required',
        'change_work_in' => 'required',
        'change_work_out' => 'required',
        'change_break_in1' => 'nullable',
        'change_break_out1' => 'nullable',
        'change_break_in2' => 'nullable',
        'change_break_out2' => 'nullable',
        'change_remarks' => 'required',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
