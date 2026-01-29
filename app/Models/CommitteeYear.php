<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommitteeYear extends Model {
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'committee_name',
        'committee_start_date',
    ];

    public function committee_members(): HasMany {
        return $this->hasMany(CommitteeMember::class,
                             'CommitteeYear_id',
                             'id');
    }

    public function committeeActivities(): HasMany{
        return $this->hasMany(CommitteeActivitie::class, 'committee_year_id', 'id');
    }
}