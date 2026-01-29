<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
     use HasFactory;
     
     protected $fillable = [
        'CommitteeYear_id',
        'name',
        'photo',
        'role',
        'address',
        'mobile',
        'email',
        'facebook',
    ];

    public function committeeYear(){
        return $this->belongsTo(CommitteeYear::class, 'CommitteeYear_id', 'id');
    }
}