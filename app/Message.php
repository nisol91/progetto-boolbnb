<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name','email','body','apartment_id'];

    public function apartments() {

        return $this->belongsTo('App\Apartment');
    }
       
}
