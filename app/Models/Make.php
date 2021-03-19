<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function modeles()
    {
        return $this->hasMany(Modele::class);
    }

    public function cars()
    {
        return $this->hasManyThrough(Car::class, Modele::class);
    }
}
