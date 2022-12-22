<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RzyUser extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'rzy_users';

    protected $guarded = ['id'];
}
