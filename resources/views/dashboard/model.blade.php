@extends('layouts.dashboard')

@section('title', 'Model Dashboard')

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

    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Model Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Model</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_model"><i class="fa fa-plus"></i> Add Model</a>
            </div>
        </div>
    </div>

    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating" name="model_id">
                <label class="focus-label">Model ID</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating" name="model_name">
                <label class="focus-label">Model Name</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Maker</th>
                            <th>Model</th>
                            <th class="text-right no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($models as $model)
                        <tr>
                            <td>{{ $model->id }}</td>
                            <td>{{ $model->maker->name }}</td>
                            <td>{{ $model->name }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="#" class="dropdown-item edit-model"
                                            data-id="{{ $model->id }}"
                                            data-name="{{ $model->name }}"
                                            data-maker="{{ optional($model->maker)->name }}"
                                            data-toggle="modal"
                                            data-target="#edit_model">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>


                                        <a href="#" class="dropdown-item delete-model" data-id="{{ $model->id }}" data-toggle="modal" data-target="#delete_model">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$models->onEachSide(1)->links()}}
            </div>
        </div>
    </div>
</div>

<!-- Add Model Modal -->
<div id="add_model" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Model</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard_models.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Maker <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="Maker" required>
                    </div>
                        </div>
                        <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Model <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="Model" required>
                    </div>
                        </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Model Modal -->
<div id="edit_model" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Model</h5>
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
                        <input class="form-control" type="text" name="maker_name" id="edit_maker_name" required>
                    </div>
                        </div>
                        <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-form-label">Model <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="model_name" id="edit_model_name" required>
                    </div>
                        </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Model Modal-->
<div class="modal custom-modal fade" id="delete_model" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Model</h3>
                    <p>Are you sure you want to delete this model?</p>
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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    console.log(typeof jQuery);

    $(document).ready(function () {
    $(document).on('click', '.edit-model', function () {
        let id = $(this).data('id');
        let modelName = $(this).data('name');
        let makerName = $(this).data('maker');

        console.log("Model ID: ", id);
        console.log("Model Name: ", modelName);
        console.log("Maker Name: ", makerName);

        $('#edit_model_name').val(modelName);
        $('#edit_maker_name').val(makerName);

        $('#editForm').attr('action', "/dashboard_models/" + id);
    });
});

$(document).on('click', '.delete-model', function() {
    let id = $(this).data('id');
    let action = "/dashboard_models/" + id;
    $('#deleteForm').attr('action', action);
});

</script>
@endsection
