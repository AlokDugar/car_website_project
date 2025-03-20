@extends('layouts.dashboard')

@section('title', 'Employee Dashboard')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">User</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">User</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add User</a>
                <div class="view-icons">
                    <a href="employees.html" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                    <a href="employees-list.html" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                </div>
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
    </div>

    <div class="row staff-grid-row">
        @foreach ($users as $user )
        <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
                <div class="profile-img">
                    <a href="profile.html" class="avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""></a>
                </div>
                <div class="dropdown profile-action">
                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_employee"
                        onclick="editUser('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->phone }}')">
                        <i class="fa fa-pencil m-r-5"></i> Edit
                        </a>

                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="#delete_employee"
                        onclick="deleteUser('{{ $user->id }}')">
                        <i class="fa fa-trash m-r-5"></i> Delete
                        </a>
                        <script>
                            function deleteUser(id) {
                                document.getElementById("deleteForm").action = "/dashboard_users/" + id;
                            }
                        </script>
                    </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="profile.html">{{$user->name}}</a></h4>
                <div class="small text-muted">{{$user->email}}</div>
            </div>
        </div>
        @endforeach
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
                                <label class="col-form-label">Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Confirm Password</label>
                                <input class="form-control" type="password" name="password_confirmation" required>
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
<!-- Delete User Modal -->
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

    $(document).on('click', '.delete-user', function() {
        let id = $(this).data('id');
        $('#delete_user_id').val(id);

        let action = $('#deleteUserForm').attr('action').replace(':id', id);
        $('#deleteUserForm').attr('action', action);
    });
</script>
@endsection
