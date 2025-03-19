<x-base-layout title="LogIn" bodyClass="page-login">
    <main>
        <div class="container-small page-login">
          <div class="flex" style="gap: 5rem">
            <div class="auth-page-form">
              <div class="text-center">
                <a href="/">
                  <img src="/img/logoipsum-265.svg" alt="" />
                </a>
              </div>
              <h1 class="auth-page-title">Login</h1>
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

              <form action="{{route('auth.login')}}" method="POST">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" placeholder="Email" required/>
                  @error('email')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" name="password" placeholder="Password" required/>
                  @error('password')
                  <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="text-right mb-medium">
                  <a href="{{route('password.request')}}" class="auth-page-password-reset"
                    >Forgot Password?</a
                  >
                </div>

                <button class="btn btn-primary btn-login w-full">Login</button>

                <div class="grid grid-cols-2 gap-1 social-auth-buttons">
                    <a href="{{ route('auth.google') }}" class="btn btn-default flex justify-center items-center gap-1">
                        <img src="/img/google.png" alt="" style="width: 20px" />
                        Google
                    </a>

                  </button>
                  <button
                    class="btn btn-default flex justify-center items-center gap-1"
                  >
                    <img src="/img/facebook.png" alt="" style="width: 20px" />
                    Facebook
                  </button>
                </div>
                <div class="login-text-dont-have-account">
                  Don't have an account? -
                  <a href={{route('auth.register')}}> Click here to create one</a>
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

