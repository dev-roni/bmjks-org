<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\CommitteeName;
use App\Models\ChadaName;

class ChadaCollection extends Model
{
    use HasFactory;
    protected $fillable = [
        'chada_names_id',
        'committee_id',
        'amount',
        'payment_date',
        'payment_status'
    ];
    public function chadaName() {
        return $this->belongsTo(ChadaName::class,'chada_names_id','id');
    }

    public function committee() {
        return $this->belongsTo(CommitteeName::class,'committee_id','id');
    }
}
