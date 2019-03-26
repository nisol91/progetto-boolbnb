<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['description', 'rooms_number', 'beds_number', 'baths_number', 'surface', 'address', 'image', 'lat', 'lng', 'user_id'];

    public function users() {

        return $this->belongsTo('App\User');
    }
        public function services()
    {
        return $this->belongsToMany('App\Service');
    }
        public function messages()
    {
        return $this->belongsToMany('App\Message');
    }
}
