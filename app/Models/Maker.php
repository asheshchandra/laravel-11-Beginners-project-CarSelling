<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maker extends Model
{
    protected $fillable = ['name'];

    public function models()
    {
        return $this->hasMany(Model::class);
    }

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
