<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorScheduleException extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'date',
        'open_time',
        'close_time',
        'is_closed',
        'note',
    ];

    public function breaks()
    {
        return $this->hasMany(VendorBreak::class, 'schedule_id')
            ->where('schedule_type', 'exception');
    }
}
