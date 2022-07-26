<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class DashboardController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->take(3)->get();
        return view('user.index',compact('cars'));
    }
}
