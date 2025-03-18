<x-base-layout title="SignUp" bodyClass="page-signup">
    <main>
    <div class="container-small page-login">
      <div class="flex" style="gap: 5rem">
        <div class="auth-page-form">
          <div class="text-center">
            <a href="/">
              <img src="/img/logoipsum-265.svg" alt="" />
            </a>
          </div>
          <h1 class="auth-page-title">Signup</h1>

          <form action="{{route('auth.register')}}" method="POST">
            @csrf
            <div class="form-group">
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Password" />
            </div>
            <div class="form-group">
              <input type="password" name ="password_confirmation" placeholder="Confirm Password" />
            </div>
            <hr />
            <div class="form-group">
              <input type="text" name="name" placeholder="Name" />
            </div>
            <div class="form-group">
              <input type="text" name="phone" placeholder="Phone" />
            </div>
            <button class="btn btn-primary btn-login w-full">Register</button>

            <div class="grid grid-cols-2 gap-1 social-auth-buttons">
              <button
                class="btn btn-default flex justify-center items-center gap-1"
              >
                <img src="/img/google.png" alt="" style="width: 20px" />
                Google
              </button>
              <button
                class="btn btn-default flex justify-center items-center gap-1"
              >
                <img src="/img/facebook.png" alt="" style="width: 20px" />
                Facebook
              </button>
            </div>
            <div class="login-text-dont-have-account">
              Already have an account? -
              <a href={{route('auth.login')}}> Click here to login </a>
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
