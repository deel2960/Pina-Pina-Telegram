<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pina extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'type' => 'required',
        'body' => 'required',
    );

    public function chronicles()
    {
        return $this->hasMany('App\Models\Chronicle');
    }
}
