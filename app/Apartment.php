<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['description', 'rooms_number', 'beds_number', 'baths_number', 'surface', 'address', 'image', 'lat', 'lng'];

}
