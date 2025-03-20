<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class DashboardCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
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
            'model_id' => 'required|integer',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'vin_code' => 'required|string',
            'mileage' => 'required|integer',
            'car_type_id' => 'required|integer',
            'fuel_type_id' => 'required|integer',
            'city_id' => 'required|integer',
            'address' => 'required|string',
            'phone' => 'required|string',
            'description' => 'required|string',
            'published' => 'nullable|boolean',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Create a new car entry
        $car = Car::create([
            'maker' => $validated['maker'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'price' => $validated['price'],
            'vin_code' => $validated['vin_code'],
            'mileage' => $validated['mileage'],
            'car_type' => $validated['car_type'],
            'fuel_type' => $validated['fuel_type'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
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
            'description' => $validated['description'],
            'published' => $validated['published'] ?? false,
        ]);

        // Handle the images
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            foreach ($images as $image) {
                $imagePath = $image->store('car_images', 'public');
                // Save the image paths to the database or associate them with the car model
                $car->images()->create(['path' => $imagePath]);
            }
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
}
