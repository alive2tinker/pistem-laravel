<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'mileage',
        'price',
        'for_sale',
        'details',
        'modele_id',
        'city_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function modele()
    {
        return $this->belongsTo(Modele::class);
    }

    public function uploads()
    {
        return $this->morphMany(Upload::class, 'uploadable');
    }
}
