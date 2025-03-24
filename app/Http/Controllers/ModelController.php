<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\Maker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models=CarModel::paginate(10);
        return view('dashboard.model',compact('models'));
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
        $request->validate([
            'Model' => 'required|string|max:255',
            'Maker' => 'required|string|max:255',
        ]);

        $maker = Maker::firstOrCreate(
            ['name' => $request->Maker]
        );

        CarModel::create([
            'name' => $request->Model,
            'maker_id' => $maker->id,
        ]);

        return redirect()->route('dashboard_models.index')->with('success', 'Model created successfully!');
    }

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
    $request->validate([
        'model_name' => 'required|string|max:255',
        'maker_name' => 'required|string|max:255',
    ]);
    $model = CarModel::findOrFail($id);
    $maker = Maker::firstOrCreate(
        ['name' => $request->maker_name]
    );

    $model->update([
        'name' => $request->model_name,
        'maker_id' => $maker->id,
    ]);

    return redirect()->route('dashboard_models.index')->with('success', 'Model updated successfully!');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = CarModel::findOrFail($id);
        $model->delete();

        return redirect()->route('dashboard_models.index')->with('success', 'Model deleted successfully!');
    }
}
