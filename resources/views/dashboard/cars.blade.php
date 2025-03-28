<?php
    use App\Models\Maker;
    use App\Models\CarModel;
    use App\Models\CarType;
    use App\Models\FuelType;
    use App\Models\State;
    use App\Models\City;

    $makers=Maker::all();
    $models=CarModel::all();
    $carTypes=CarType::all();
    $fuelTypes=FuelType::all();
    $states=State::all();
    $cities=City::all();
?>
@extends('layouts.dashboard')

@section('title', 'Car Dashboard')

@section('content')
<div class="content container-fluid">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Car Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Cars</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_car"><i class="fa fa-plus"></i> Add Car</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Search Filter -->
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Car ID</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">VIN</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
        <form action="{{ route('dashboard_cars.download-excel') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-block">Export</button>
        </form>
    </div>

    <!-- Car Table -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table datatable">
                <thead>
                    <tr>
                        <th>Car Image</th>
                        <th>Year</th>
                        <th>Maker</th>
                        <th>Model</th>
                        <th>City</th>
                        <th>Type</th>
                        <th>Fuel</th>
                        <th>Price</th>
                        <th class="text-right no-sort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                    <tr>
                        <td>
                            <img src="{{
                                filter_var($car->primaryImage->image_path, FILTER_VALIDATE_URL)
                                ? $car->primaryImage->image_path
                                : asset('storage/' . $car->primaryImage->image_path)
                            }}" alt="Car Image" style="width: 50px; height: auto;" />
                        </td>
                        <td>{{ $car->year }}</td>
                        <td>{{ optional($car->maker)->name ?? 'Unknown' }}</td>
                        <td>{{ optional($car->carModel)->name ?? 'Unknown' }}</td>
                        <td>{{ optional($car->city)->name ?? 'Unknown' }}</td>
                        <td>{{ optional($car->carType)->name ?? 'Unknown' }}</td>
                        <td>{{ optional($car->fuelType)->name ?? 'Unknown' }}</td>
                        <td>${{ number_format($car->price, 2) }}</td>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_car"
                                    onclick="editCar('{{ $car->id }}', '{{ $car->maker->id }}', '{{ $car->carModel->id }}', '{{ $car->year }}', '{{ $car->price }}')">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_car"
                                    onclick="deleteCar('{{ $car->id }}')">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$cars->onEachSide(1)->links()}}
        </div>
    </div>
</div>
<!-- /Car Table -->

</div>
<!-- Add Car Modal -->
<div id="add_car" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard_cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-content">
                        <div class="form-details">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Maker</label>
                                        <select name="maker_id" id="Maker" required>
                                            <option value="">Maker</option>
                                            @foreach ($makers as $maker)
                                                <option value="{{$maker->id}}">{{$maker->name}}</option>
                                            @endforeach
                                        </select>
                                        <p class="error-message">This field is required</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Model</label>
                                        <select name="carModel_id" id="Model" required>
                                            <option value="">Model</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select name="year" required>
                                            <option value="">Year</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input class="form-control" type="number" name="price" placeholder="Price" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Vin Code</label>
                                        <input class="form-control" type="text" name="vin" placeholder="Vin Code" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Mileage (ml)</label>
                                        <input class="form-control" type="number" name="mileage" placeholder="Mileage" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Car Type</label>
                                <div class="row">
                                    @foreach ($carTypes as $carType)
                                        <div class="col">
                                            <label class="inline-radio">
                                                <input type="radio" name="car_type_id" value="{{$carType->id}}" required>
                                                {{$carType->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fuel Type</label>
                                <div class="row">
                                    @foreach ($fuelTypes as $fuelType)
                                        <div class="col">
                                            <label class="inline-radio">
                                                <input type="radio" name="fuel_type_id" value="{{$fuelType->id}}" required>
                                                {{$fuelType->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>State/Region</label>
                                        <select name="state_id" id="State" required>
                                            <option value="">State/Region</option>
                                            @foreach ($states as $state)
                                                <option value="{{$state->id}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <select name="city_id" id="City" required>
                                            <option value="">City</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input class="form-control" type="text" name="address" placeholder="Address" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" type="text" name="phone" placeholder="Phone" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label class="checkbox">
                                            <input type="checkbox" name="air_conditioning" value="1">
                                            Air Conditioning
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="power_windows" value="1">
                                            Power Windows
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="power_door_locks" value="1">
                                            Power Door Locks
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="abs" value="1">
                                            ABS
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="cruise_control" value="1">
                                            Cruise Control
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="bluetooth_connectivity" value="1">
                                            Bluetooth Connectivity
                                        </label>
                                    </div>
                                    <div class="col">
                                        <label class="checkbox">
                                            <input type="checkbox" name="remote_start" value="1">
                                            Remote Start
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="gps_navigation" value="1">
                                            GPS Navigation System
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="heated_seats" value="1">
                                            Heated Seats
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="climate_control" value="1">
                                            Climate Control
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="rear_parking_sensors" value="1">
                                            Rear Parking Sensors
                                        </label>

                                        <label class="checkbox">
                                            <input type="checkbox" name="leather_seats" value="1">
                                            Leather Seats
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Detailed Description</label>
                                <textarea rows="5" name="description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label class="checkbox">
                                    <input type="checkbox" name="published" value="1">
                                    Published
                                </label>
                            </div>
                            <div class="form-images">
                                <div class="form-image-upload">
                                    <div class="upload-placeholder">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 48px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </div>
                                    <input id="carFormImageUpload" type="file" name="image" />
                                </div>
                                <div id="imagePreviews" class="car-form-images"></div>
                            </div>

                        </div>
                        <div class="p-medium" style="width: 100%">
                            <div class="flex justify-end gap-1">
                                <button type="reset" class="btn btn-default">Reset</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Car Modal -->
<div id="edit_car" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Car</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Maker <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="maker_id" id="edit_maker" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Car Model <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="carModel_id" id="edit_carModel" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Year</label>
                                <input class="form-control" type="number" name="year" id="edit_year" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Price</label>
                                <input class="form-control" type="text" name="price" id="edit_price" required>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editCar(id, maker_id, carModel_id, year, price) {
        document.getElementById("edit_maker").value = maker_id;
        document.getElementById("edit_carModel").value = carModel_id;
        document.getElementById("edit_year").value = year;
        document.getElementById("edit_price").value = price;
        document.getElementById("editForm").action = "/dashboard_cars/" + id;
    }
</script>

<!-- Delete Car Modal -->
<div class="modal custom-modal fade" id="delete_car" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Car</h3>
                    <p>Are you sure you want to delete?</p>
                </div>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
$(document).on('click', '.edit-car', function() {
    let id = $(this).data('id');
    let maker = $(this).data('maker_id');
    let carModel = $(this).data('carModel_id');
    let year = $(this).data('year');
    let price = $(this).data('price');

    $('#edit_maker').val(maker_id);
    $('#edit_carModel').val(carModel_id);
    $('#edit_year').val(year);
    $('#edit_price').val(price);

    $('#editForm').attr('action', "/dashboard_cars/" + id);
});

function deleteCar(id) {
    let action = "/dashboard_cars/" + id;  // This should match your route definition
    $('#deleteForm').attr('action', action);  // Dynamically set the form action
    $('#delete_car').modal('show');  // Show the modal
}


</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    $(document).ready(function(){

        $("#State").change(function(){

            var state_id = $(this).val();
            if(state_id == ""){
                $("#City").html("<option value=''>City</option>");
            }

            $.ajax({
                url:"/get-cities/"+state_id,
                type:"GET",
                success:function(data){
                    var cities = data.cities;
                    var html = "<option value=''>City</option>";
                    for(let i =0;i<cities.length;i++){
                        html += `
                        <option value="`+cities[i]['id']+`">`+cities[i]['name']+`</option>
                        `;
                    }
                    $("#City").html(html);
                }
            });

        });

    });



    $(document).ready(function(){

        $("#Maker").change(function(){

            var maker_id = $(this).val();
            if(maker_id == ""){
                $("#Model").html("<option value=''>Model</option>");
            }

            $.ajax({
                url:"/get-models/"+maker_id,
                type:"GET",
                success:function(data){
                    var models = data.models;
                    var html = "<option value=''>Model</option>";
                    for(let i =0;i<models.length;i++){
                        html += `
                        <option value="`+models[i]['id']+`">`+models[i]['name']+`</option>
                        `;
                    }
                    $("#Model").html(html);
                }
            });

        });

    });



    const select = document.querySelector('select[name="year"]');
    const currentYear = new Date().getFullYear();

    for (let year = currentYear; year >= 2000; year--) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        select.appendChild(option);
    }
</script>
@endsection
