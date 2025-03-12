<x-auth-layout title="Reset Password">
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
            <label>Email Address</label>
            <input class="form-control" type="email" name="email" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input class="form-control" type="password" name="password" required>
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input class="form-control" type="password" name="password_confirmation" required>
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
        </div>
    </form>
</x-auth-layout>
