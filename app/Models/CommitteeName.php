<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ChadaCollection;

class CommitteeName extends Model {

    use HasFactory;

    protected $fillable = [
        'committee_name',
        'committee_slug',
    ];
    public function chada() {
        return $this->hasMany(ChadaCollection::class,'committee_id','id');
    }

}
