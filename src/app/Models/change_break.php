<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Change_break extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = ['change_request_id', 'change_break_in', 'change_break_out'];

    public static $rules = array(
        'change_request_id' => 'required',
        'change_break_in' => 'required',
        'change_break_out' => 'required',
    );
}
