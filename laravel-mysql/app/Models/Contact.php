<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;
    public $table = "contact_form";
    protected $fillable = [
        'name',
        'email',
        'message',
    ];
}
