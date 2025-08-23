<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorDetail extends Model
{
    use HasFactory;

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $fillable = [
        'vendor_id',
        'business_name',
        'slogan',
        'type',
        'location',
        'gst_number',
        'lattitude',
        'longitude',
        'is_active',
        // 'shop_open',
        // 'shop_close',
        'buffer_timing',
        'salon_type_id'
    ];
}
