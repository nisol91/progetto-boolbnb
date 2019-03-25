<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Apartment;

class FilterController extends Controller
{
    public function filter(){

      $apartments = Apartment::all();
      return response()->json($apartments);
      
    }
}
