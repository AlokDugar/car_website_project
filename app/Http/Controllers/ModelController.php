<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\CarModel; // Assuming your model is named 'Model'

class ModelController extends Controller
{
    public function filter(Request $request)
    {
        $makers = Maker::all(); // Fetch all makers
        $models = [];

        if ($request->has('maker_id') && !empty($request->maker_id)) {
            $models = CarModel::where('maker_id', $request->maker_id)->get();
        }

        return view('car.create', compact('makers', 'models'));
    }
}

