<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Maker;
use App\Models\CarModel;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\State;
use App\Models\City;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("car.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("car.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("car.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("car.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function search(Request $request)
    {
        // Get filter parameters from query string
        $maker_id = $request->query('maker_id');
        $model_id = $request->query('model_id');
        $state_id = $request->query('state_id');
        $city_id = $request->query('city_id');
        $car_type_id = $request->query('car_type_id');
        $year_from = $request->query('year_from');
        $year_to = $request->query('year_to');
        $price_from = $request->query('price_from');
        $price_to = $request->query('price_to');
        $fuel_type_id = $request->query('fuel_type_id');

        // Build query with filters
        $query = Car::query();

        if ($maker_id) {
            $query->where('maker_id', $maker_id);
        }
        if ($model_id) {
            $query->where('model_id', $model_id);
        }
        if ($car_type_id) {
            $query->where('car_type_id', $car_type_id);
        }
        if ($fuel_type_id) {
            $query->where('fuel_type_id', $fuel_type_id);
        }
        if ($city_id) {
            $query->where('city_id', $city_id);
        }
        if ($year_from) {
            $query->where('year', '>=', $year_from);
        }
        if ($year_to) {
            $query->where('year', '<=', $year_to);
        }
        if ($price_from) {
            $query->where('price', '>=', $price_from);
        }
        if ($price_to) {
            $query->where('price', '<=', $price_to);
        }

        // For state filter, we need to join through cities
        if ($state_id) {
            $query->whereHas('city', function ($q) use ($state_id) {
                $q->where('state_id', $state_id);
            });
        }

        $cars = $query->with(['maker', 'model', 'carType', 'fuelType', 'city.state'])->paginate(12);

        // Get all filter options
        $makers = Maker::all();
        $models = CarModel::all();
        $carTypes = CarType::all();
        $fuelTypes = FuelType::all();
        $states = State::all();
        $cities = City::all();

        return view("car.search", [
            'cars' => $cars,
            'makers' => $makers,
            'models' => $models,
            'carTypes' => $carTypes,
            'fuelTypes' => $fuelTypes,
            'states' => $states,
            'cities' => $cities,
            'filters' => [
                'maker_id' => $maker_id,
                'model_id' => $model_id,
                'state_id' => $state_id,
                'city_id' => $city_id,
                'car_type_id' => $car_type_id,
                'year_from' => $year_from,
                'year_to' => $year_to,
                'price_from' => $price_from,
                'price_to' => $price_to,
                'fuel_type_id' => $fuel_type_id,
            ]
        ]);
    }
}
