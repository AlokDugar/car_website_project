<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\CarFeatures;
use App\Models\CarImage;
use App\Models\CarType;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index(){
        /*$car=new Car();
        $car=Car::get();
        $car=Car::first();
        $car=Car::where('id',1)->get();
        $car=Car::find(3);
        $car=Car::orderBy('year','asc')->get();

        //change price of car with id 1
        $car=Car::find(1);
        $car->price=1000;
        $car->save();

        //create new record
        $car=Car::create([
            'maker_id'=>1,
            'model_id'=>1,
            'year'=>1,
            'price'=>1,
            'vin'=>'991',
            'mileage'=>1,
            'car_type_id'=>1,
            'fuel_type_id'=>1,
            'user_id'=>1,
            'city_id'=>1,
            'address'=>'1',
            'phone'=>'1',
            'description'=>null,
            'published_at'=>now()
        ]);

        //array for entire record change
        $cardata=[
            'maker_id'=>1,
            'model_id'=>1,
            'year'=>1,
            'price'=>1,
            'vin'=>'991',
            'mileage'=>1,
            'car_type_id'=>1,
            'fuel_type_id'=>1,
            'user_id'=>1,
            'city_id'=>5,
            'address'=>'1',
            'phone'=>'1',
            'description'=>null,
            'published_at'=>now(),
        ];
        //changes 1 attribute of only 1 record
        $car=Car::updateOrCreate(
            ['id'=>1],
            ['price'=>3000000]
        );
        //changes entry of all the attributes in the array $copydata //for one recod
        $car=Car::updateOrCreate(
            ['id'=>1],
            $cardata
        );

        //for multiple records
        $car=Car::where(['published_at'=>null,'user_id'=>1])
        ->update(['published_at'=>now()]);

        //delete car with id 1
        $car=Car::find(1);
        $car->delete();

        //mass delete
        $car=Car::destroy([4,7]);

        //upload value of published_at into created_at
        DB::table('cars')
        ->whereNull('created_at')
        ->update(['created_at' => DB::raw('IFNULL(published_at, NOW())')]);

        //deletes all records
        Car::truncate();

        $car=Car::where('price',1)->update(['price'=>25000]);

        $car=Car::where('price','>=',20000)->get();
        Car::find(6)->delete();
        dump($car);

        $car=Car::find(5);
        dump($car->features, $car->primaryImage);

    //update value of features through car
        //approach 1
        $car->features->abs=0;
        $car->features->save();

        //aproach 2
        $car->features->update(['abs'=>1]);

    //delete primaryImage selected value of oldest position
        $car->primaryImage->delete();

        //insert new record in features for car of id 7
        $car=Car::find(7);

        $carFeatures=new CarFeatures([
            'abs'=>false,
            'air_conditioning'=>false,
            'power_windows'=>false,
            'power_door_locks'=>false,
            'cruise_control'=>false,
            'bluetooth_connectivity'=>false,
            'remote_start'=>false,
            'gps_navigation'=>false,
            'heater_seats'=>false,
            'climate_control'=>false,
            'rear_parking_sensors'=>false,
            'leather_seats'=>false

        ]);
        $car->features()->save($carFeatures);

        $car = Car::find(5);
        dump($car->images);

        //Create new image
        //approach1
        $image= new CarImage(['image_path'=>'something','position'=>3]);
        $car->images()->save($image);

        //aproach 2
        $car->images()->create(['image_path'=>'something','position'=>3]);

        $car = Car::find(5);
        //multiple creations
        //approach1
        $car->images()->saveMany([
            new CarImage(['image_path'=>'something1','position'=>4]),
            new CarImage(['image_path'=>'something2','position'=>5]),
            new CarImage(['image_path'=>'something3','position'=>6])
        ]);

        //approach 2
        $car->images()->createMany([
            ['image_path'=>'something4','position'=>7],
            ['image_path'=>'something5','position'=>8]
        ]);
*/

        $car = Car::find(5);
        dump($car->carType);

        $carType=CarType::where('name','Alok')->first();
        if (!$carType) {
            dd("CarType with name 'Alok' not found.");
        }
        $cars=Car::whereBelongsTo($carType)->get();
        dump($carType->cars);
        dump($cars);

        return view('home.index');
    }
}
