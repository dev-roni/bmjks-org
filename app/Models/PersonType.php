<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class PersonType extends Model
{
    protected $table = 'person_types';
    
        protected $fillable = [
            'person_type_name',
            'status'
        ];

    public function people(): HasManyThrough
    {

        return $this->hasManyThrough(
            Person::class,       // চূড়ান্ত মডেল (টার্গেট)
            PersonTag::class,    // মধ্যবর্তী মডেল
            'persontype_id',    // Foreign key on person_tags table
            'id',                // Foreign key on persons table
            'id',                // Local key on person_types table
            'person_id'          // Local key on person_tags table
        );
        

    }
}
