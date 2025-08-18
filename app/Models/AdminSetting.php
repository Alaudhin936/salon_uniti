<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_logo',
        'favicon',
        'email',
        'phone',
        'address',
        'privacy_policy',
        'terms_conditions',
        'about_us',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'linkedin_url',
        'currency',
        'timezone',
        'maintenance_mode',
    ];
}
