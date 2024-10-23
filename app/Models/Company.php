<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }

    public function numberOfGigsByStatus($status){

        return $this->gigs()->where('status', $status)->count();
    }
}
