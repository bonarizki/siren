<?php

namespace App\Service;

use App\Models\Car;

class AddUpdateCar
{
    public function handle($request)
    {
        $request->merge([
            'car_image' => $this->uploadFile($request),
            'car_price' => str_replace('.', '', str_replace('Rp. ', '', $request->car_price))
        ]);
        return Car::UpdateOrCreate(["id" => $request->id],$request->except(['image','filepond']));
    }

    public function uploadFile($request)
    {
        $car_image = $request->file('image');
        if ($car_image) {
            $car_image->move(public_path('file_upload/car_image'),$car_image->getClientOriginalName());
            return $car_image->getClientOriginalName();
        }else{
            return 'default.jpg';
        }
    }
}