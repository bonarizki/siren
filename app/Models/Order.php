<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [];
    protected $guarded = ['id'];
    protected $with = ['Car','User'];

    public function Car()
    {
        return $this->hasOne(Car::class, 'id', 'car_id');
    }

    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
