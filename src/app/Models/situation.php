<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Situation extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    protected $fillable = ['user_id', 'situation'];

    public static $rules = array(
        'user_id' => 'required',
        'situation' => 'required',
    );

    public function User(){
        return $this->belongsTo(User::class);
    }
}
