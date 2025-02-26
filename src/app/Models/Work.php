<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = ['user_id', 'work_in', 'work_out'];

    public static $rules = array(
        'user_id' => 'required',
        'work_in' => 'required',
        'work_out' => 'required',
    );

    public function User(){
        return $this->belongsTo(User::class);
    }
    public function Break_times(){
        return $this->hasMany(Break_time::class);
    }
}
