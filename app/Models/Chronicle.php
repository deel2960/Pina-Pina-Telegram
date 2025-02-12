<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chronicle extends Model
{
    use HasFactory;
    protected $table = 'chronicle';
    protected $guarded = array('id');

    public static $rules = array(
        'pina_id' => 'required',
        'edited_at' => 'required',
    );
}
