<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    // Mass assignment
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
