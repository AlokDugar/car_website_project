<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarModel;
use App\Models\City;
use Illuminate\Http\Request;

class DashboardCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::paginate(15);
        return view('dashboard.cars', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate incoming request
    $validated = $request->validate([
        'maker_id' => 'required|integer',
        'carModel_id' => 'required|integer',
        'year' => 'required|integer',
        'price' => 'required|numeric',
        'vin' => 'required|string',
        'mileage' => 'required|integer',
        'car_type_id' => 'required|integer',
        'fuel_type_id' => 'required|integer',
        'city_id' => 'required|integer',
        'address' => 'required|string',
        'phone' => 'required|string',
        'description' => 'required|string',
        'published' => 'nullable|boolean',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $car = Car::create([
        'maker_id' => $validated['maker_id'],
        'carModel_id' => $validated['carModel_id'],
        'year' => $validated['year'],
        'price' => $validated['price'],
        'vin' => $validated['vin'],
        'user_id'=>6,
        'mileage' => $validated['mileage'],
        'car_type_id' => $validated['car_type_id'],
        'fuel_type_id' => $validated['fuel_type_id'],
        'city_id' => $validated['city_id'],
        'address' => $validated['address'],
        'phone' => $validated['phone'],
        'description' => $validated['description'],
        'published' => $validated['published'] ?? false,
    ]);

    $carFeatureData = [
        'car_id' => $car->id,
        'air_conditioning' => $request->has('air_conditioning'),
        'power_windows' => $request->has('power_windows'),
        'power_door_locks' => $request->has('power_door_locks'),
        'abs' => $request->has('abs'),
        'cruise_control' => $request->has('cruise_control'),
        'bluetooth_connectivity' => $request->has('bluetooth_connectivity'),
        'remote_start' => $request->has('remote_start'),
        'gps_navigation' => $request->has('gps_navigation'),
        'heated_seats' => $request->has('heated_seats'),
        'climate_control' => $request->has('climate_control'),
        'rear_parking_sensors' => $request->has('rear_parking_sensors'),
        'leather_seats' => $request->has('leather_seats'),
    ];

    CarFeatures::create($carFeatureData);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imagePath = $image->store('car_images', 'public');

        $car->carImages()->create([
            'car_id' => $car->id,
            'image_path' => $imagePath,
            'position' => [1, 2, 3, 4, 5][array_rand([1, 2, 3, 4, 5])]
        ]);
    }


    return redirect()->route('dashboard_cars.index')->with('success', 'Car added successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{

    $car = Car::find($id);

    $request->validate([
        'maker_id' => 'required|integer|exists:makers,id',
        'carModel_id' => 'required|integer|exists:car_models,id',
        'price' => 'required|integer',
        'year'=>'required|integer'
    ]);

    $car->update([
        'maker_id' => $request->maker_id,
        'carModel_id' => $request->carModel_id,
        'price' => $request->price,
        'year' => $request->year,
    ]);

    return redirect()->route('dashboard_cars.index')->with('success', 'Car updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $dashboard_car) {
        $dashboard_car->delete();
        return redirect()->route('dashboard_cars.index')->with('success', 'Car deleted successfully.');
    }

    public function getModels($maker_id)
    {
        $models = CarModel::where('maker_id',$maker_id)->get();
        return response()->json(['models'=>$models]);
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id',$state_id)->get();
        return response()->json(['cities'=>$cities]);
    }
}
