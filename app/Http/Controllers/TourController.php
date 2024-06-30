<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index(){
      return view('frontend.tourPlans.tours');
    }
    public function upcomming(){
        return view('frontend.tourPlans.upcomming');
    }
}