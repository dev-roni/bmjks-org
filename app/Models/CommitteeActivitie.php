<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitteeActivitie extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_year_id',
        'title',
        'description',
        'activities_date'
    ];

    public function committeeYear(){
        return $this->belongsTo(CommitteeYear::class, 'committee_year_id', 'id');
    }
}
