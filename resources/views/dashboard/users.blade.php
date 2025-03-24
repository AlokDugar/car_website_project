@extends('layouts.dashboard')

@section('title', 'Employee Dashboard')

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
                <h3 class="page-title">User Management</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add User</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Search Filter -->
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">User ID</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">User Name</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
        <form action="{{ route('dashboard_users.download-excel') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-block">Export</button>
        </form>

    </div>

    <!-- User Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th class="text-right no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="profile.html" class="avatar"><img alt="" src="assets/img/profiles/avatar-02.jpg"></a>
                                    <a href="profile.html"> {{ $user->name }}</a>
                                </h2>
                            </td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#edit_employee"
                                    onclick="editUser('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}')">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_employee"
                                onclick="deleteUser('{{ $user->id }}')">
                                <i class="fa fa-trash"></i> Delete
                                </a>

                            </div>
                        </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /User Table -->
</div>
</div>
<!-- Add User Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard_users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Phone </label>
                                <input class="form-control" type="text" name="phone">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div id="edit_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
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
                                <label class="col-form-label">Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name" id="edit_name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" id="edit_email" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Phone</label>
                                <input class="form-control" type="text" name="phone" id="edit_phone">
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
    function editUser(id, name, email, phone) {
        document.getElementById("edit_name").value = name;
        document.getElementById("edit_email").value = email;
        document.getElementById("edit_phone").value = phone;
        document.getElementById("editForm").action = "/dashboard_users/" + id;
    }
</script>


<!-- Delete User Modal -->
<div class="modal custom-modal fade" id="delete_employee" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete User</h3>
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
$(document).on('click', '.edit-user', function() {
    let id = $(this).data('id');
    let name = $(this).data('name');
    let email = $(this).data('email');
    let phone = $(this).data('phone');

    $('#edit_name').val(name);
    $('#edit_email').val(email);
    $('#edit_phone').val(phone);

    $('#editForm').attr('action', "/dashboard_users/" + id);
});

function deleteUser(id) {
    let action = "/dashboard_users/" + id;
    $('#deleteForm').attr('action', action);
}

document.querySelector("#exportForm").addEventListener("submit", function(e) {
    e.preventDefault();
    this.submit();
});

</script>
@endsection
