<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::select('*');
        if($request->search != null) :
            $cars->orWhereHas('Brands',function($q) use($request){
                $q->where('brand_name', $request->search)
                    ->orWhere('brand_code', $request->search);
            });

            $cars->orWhereHas('Types',function($q) use($request){
                $q->where('type_name', $request->search)
                    ->orWhere('type_code', $request->search);
            });

        endif;


        $cars = $cars->paginate(2);
        return view('user.cars',compact('cars'));
    }
}
