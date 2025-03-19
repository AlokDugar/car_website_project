<x-auth-layout title="Forgot Password">
    <form method="POST" action="{{ route('password.adminEmail') }}">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <input class="form-control" type="email" name="email" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group text-center">
            <button class="btn btn-primary account-btn" type="submit">Send Reset Link</button>
        </div>
        <div class="account-footer">
            <p>Remember your password? <a href="{{ route('auth.adminLogin') }}">Login</a></p>
        </div>
    </form>
</x-auth-layout>
