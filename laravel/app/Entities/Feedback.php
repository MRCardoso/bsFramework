<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $fillable = ['name', 'email', 'message', 'view_home', 'user_agent','ip_address'];
    protected $hidden = ['user_agent','ip_address'];
}
