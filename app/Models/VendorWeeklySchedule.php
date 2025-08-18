<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorWeeklySchedule extends Model
{
    use HasFactory;
    protected $table = "vendor_weekly_schedule";

    protected $fillable = [
        'vendor_id',
        'day_of_week',
        'open_time',
        'close_time',
        'is_closed',
    ];

    public function breaks()
    {
        return $this->hasMany(VendorBreak::class, 'schedule_id')
            ->where('schedule_type', 'weekly');
    }
}
