<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;
    protected $table = 'admin';
    protected $fillable = [
        'phone',
        'otp',
        'created_at',
        'updated_at'
    ];
}
