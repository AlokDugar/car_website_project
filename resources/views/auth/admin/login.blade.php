<x-auth-layout title="LogIn">
    <!-- Account Form -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              @endif
    <form action="{{ url('/adminlogin') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="form-control" type="text" name="email" value="{{ old('email') }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col">
                    <label>Password</label>
                </div>
                <div class="col-auto">
                    <a class="text-muted" href="{{route('password.adminRequest')}}">Forgot password?</a>
                </div>
            </div>
            <input class="form-control" type="password" name="password" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary account-btn" type="submit">Login</button>
        </div>
        <div class="account-footer">
            <p>Login as a User? <a href="{{ route('auth.login') }}">Click Here</a></p>
        </div>
    </form>
</x-auth-layout>
