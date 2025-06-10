<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewslatterMail extends Model
{
    protected $fillable = ['mail', 'active'];
    protected $timestamp = true;
}
