<x-base-layout title="Forgot Password" bodyClass="page-login">
    <main>
        <div class="container-small page-login">
          <div class="flex" style="gap: 5rem">
            <div class="auth-page-form">
              <div class="text-center">
                <a href="/">
                  <img src="/img/logoipsum-265.svg" alt="" />
                </a>
              </div>
              <h1 class="auth-page-title">Forgot Password</h1>
              <form method="POST" action="{{ route('password.email') }}">
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
                    <p>Remember your password? <a href="{{ route('auth.login') }}">Login</a></p>
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
