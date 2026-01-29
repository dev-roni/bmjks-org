<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class PersonTag extends Model
{
    use HasFactory;
    
    protected $table = 'person_tag';
    protected $fillable = [
        'persontype_id',
        'person_id',
    ];
}
