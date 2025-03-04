<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarImages;
use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        CarType::factory()
        ->sequence(
            ['name'=>'Sedan'],
            ['name'=>'SUV'],
            ['name'=>'Jeep'],
            ['name'=>'Truck'],
            ['name'=>'Coupe'],
            ['name'=>'Van'],
            ['name'=>'Minivan'],
            ['name'=>'Crossover'],
            )
        ->count(7)->create();

        FuelType::factory()
        ->sequence(
            ['name'=>'Gas'],
            ['name'=>'Diesel'],
            ['name'=>'Electric'],
            ['name'=>'Hybrid'],
            )
        ->count(4)->create();

        $states=[
            'California'=>['Los Angeles','San Fransisco','San Diego'],
            'Texas'=>['Houston','San Antonio','Dallas','Austin'],
            'Florida'=>['Miami','Orlando','Tampa','Jacksonville'],
            'New York'=>['New York City','Buffalo','Rochester'],
        ];
        foreach ($states as $state=>$cities){
            State::factory()
            ->state(['name'=>$state])
            ->has(
                City::factory()
                ->count(count($cities))
                ->sequence(...array_map(fn($city)=>['name'=>$city],$cities))
            )
            ->create();
        };
        $makers = [
            'Toyota' => ['Corolla', 'Camry', 'RAV4', 'Highlander'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'Pilot'],
            'Ford' => ['F-150', 'Mustang', 'Explorer', 'Escape'],
            'Chevrolet' => ['Silverado', 'Malibu', 'Equinox', 'Tahoe'],
            'BMW' => ['3 Series', '5 Series', 'X5', 'X7'],
            'Mercedes-Benz' => ['C-Class', 'E-Class', 'GLC', 'GLE'],
            'Audi' => ['A3', 'A4', 'Q5', 'Q7'],
            'Nissan' => ['Altima', 'Sentra', 'Rogue', 'Murano'],
            'Hyundai' => ['Elantra', 'Sonata', 'Tucson', 'Santa Fe'],
            'Tesla' => ['Model 3', 'Model S', 'Model X', 'Model Y'],
        ];
        foreach ($makers as $maker=>$models){
            Maker::factory()
            ->state(['name'=>$maker])
            ->has(
                Model::factory()
                ->count(count($models))
                ->sequence(...array_map(fn($model)=>['name'=>$model],$models))
            )
            ->create();
        };
        User::factory()
        ->count(3)
        ->create();

        User::factory()
        ->count(2)
        ->has(
            Car::factory()
            ->count(50)
            ->has(
                CarImages::factory()
                ->state(new Sequence(
                    fn($seq) => [
                        'position' => $seq->index % 5 + 1,
                        'image_path' => 'https://www.stratstone.com/-/media/stratstone/blog/2024/top-10-best-supercars-of-2024/mclaren-750s-driving-dynamic-hero-1280x516px.ashx'
                    ]
                ))
            )
            ->hasFeatures(),
            'favouriteCars'

        )
        ->create();
    }
}
