<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Order;

class Car extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
    protected $fillable = [];
    protected $with = ['Types','Brands'];

    public function Types()
    {
        return $this->hasOne(Type::class, 'id', 'type_id');
    }

    public function Brands()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function Orders()
    {
        return $this->hasOne(Order::class,'car_id','id')->latest();
    }
}
