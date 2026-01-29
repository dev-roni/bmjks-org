<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;
     protected $table = 'people';

     protected $fillable = [
        'name',
        'relation_type',
        'father_husband_name',
        'mother_name',
        'photo',
        'date_of_birth',
        'gender',
        'caste',
        'marital_status',
        'mobile_number',
        'village',
        'post_office',
        'thana',
        'district',
        'profession',
        'blood_group',
        'donator',
        'member_aproved',
        'gm_id'
    ];

    public function personType()
    {
        return $this->hasManyThrough(
            PersonType::class,   // Final Model (target)
            PersonTag::class,    // Intermediate Model
            'person_id',         // Foreign key on person_tags table (links to persons.id)
            'id',                // Foreign key on person_types table
            'id',                // Local key on persons table
            'persontype_id'      // Local key on person_tags table
        );
    }

    public function donations() {
        return $this->hasMany(Donation::class,'people_id','id');
    }
}
