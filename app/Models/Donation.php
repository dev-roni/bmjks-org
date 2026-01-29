<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'people_id',
        'event_id',
        'donate_amount',
        'date'
    ];

     public function event() {
        return $this->belongsTo(DonationEvent::class,'event_id','id');
    }

    public function person() {
        return $this->belongsTo(Person::class,'people_id','id');
    }
}
