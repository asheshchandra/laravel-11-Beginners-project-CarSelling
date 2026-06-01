<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'models';
    protected $fillable = ['maker_id', 'name'];

    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class, 'model_id');
    }
}
