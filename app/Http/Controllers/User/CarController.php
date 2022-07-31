<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class CarController extends Controller
{
    public function index(Request $request)
    {
        $cars = Car::select('*')->with('Orders');
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


        $cars = $cars->paginate(6);
        return view('user.cars',compact('cars'));
    }

    public function store(Request $request)
    {
        $date_order = explode('-',$request->order_days);
        $request->merge([
            "user_id" => Auth::user()->id,
            "order_start" => Carbon::parse($date_order[0])->format('Y-m-d'),
            "order_end" =>Carbon::parse($date_order[1])->format('Y-m-d'),
            "order_code" => "B". Str::random(5)
        ]);
        $request->request->remove('order_days');

        Order::create($request->except('_token'));
        return response()->json(["status" => "success", "message" => "Booking Created"]);
    }

    public function edit(Car $car)
    {
        return response()->json(["status" => "success", "data" => $car]);
    }

}
