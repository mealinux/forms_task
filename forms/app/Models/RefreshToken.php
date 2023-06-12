<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefreshToken extends Model
{
   protected $table = 'refresh_token';

   use HasFactory;

   protected $fillable = ['token'];
}