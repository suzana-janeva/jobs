<?php

namespace App\Models;

use App\Enum\GigStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gig extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'timestamp_start',
        'timestamp_end',
        'number_of_positions',
        'pay_per_hour',
        'status',
        'company_id',
    ];

    protected $casts = [
        'pay_per_hour' => 'double', 
        'status' => GigStatus::class,
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
