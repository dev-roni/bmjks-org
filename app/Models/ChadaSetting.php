<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChadaSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'central_chada_amount',
        'branch_chada_amount',
    ];
}
