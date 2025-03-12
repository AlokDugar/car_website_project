<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars=Car::where('user_id',1)
            ->orderBy('published_at','asc')
            ->with(['primaryImage','maker'])
            ->paginate(15);
        return view('car.index',['cars'=>$cars]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create');
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
    public function show(Car $car)
    {
        return view('car.show',['car'=>$car]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        return view('car.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }

    public function search(){
        $query=Car::where('published_at','<',now())
        ->with(['city.state','primaryImage','carType','fuelType','maker','carModel'])
        ->orderBy('published_at','desc');
/*
        $query->join('cities','cities.id','=','cars.city_id')
        ->where('cities.state_id',1);

        $carCount=$query->count();
*/

        $cars=$query->paginate(15);
        return view('car.search',['cars'=>$cars]);
    }

    public function watchlist(){
        $cars=User::find(4)->favouriteCars()->limit(10)->with(['city.state','primaryImage','carType','fuelType','maker','carModel'])->paginate(15);
        return view('car.watchlist',['cars'=>$cars]);
    }
}
