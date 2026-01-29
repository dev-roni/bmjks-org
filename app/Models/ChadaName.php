<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ChadaCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChadaName extends Model
{
    use HasFactory;
    protected $fillable = [
        'chada_name',
        'date'
    ];
    public function chada() {
        return $this->hasMany(ChadaCollection::class,'chada_names_id','id');
    }
}
