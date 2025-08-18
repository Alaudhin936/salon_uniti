<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorBreak extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'schedule_type',
        'schedule_id',
        'break_start',
        'break_end'
    ];
}
