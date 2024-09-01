<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoteAnimals extends Model
{
    use HasFactory;

    protected $fillable = ['photeAnimal', 'animal_id'];


    public function animal()
    {

        return $this->belongsTo(Animal::class);
    }
}
