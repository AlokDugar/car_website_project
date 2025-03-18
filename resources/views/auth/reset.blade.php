<x-base-layout title="Reset Password" bodyClass="page-login">
    <main>
        <div class="container-small page-login">
          <div class="flex" style="gap: 5rem">
            <div class="auth-page-form">
              <div class="text-center">
                <a href="/">
                  <img src="/img/logoipsum-265.svg" alt="" />
                </a>
              </div>
              <h1 class="auth-page-title">Reset Password</h1>
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
            </div>
            <div class="auth-page-image">
              <img src="/img/car-png-39071.png" alt="" class="img-responsive" />
            </div>
          </div>
        </div>
    </main>
</x-base-layout>


