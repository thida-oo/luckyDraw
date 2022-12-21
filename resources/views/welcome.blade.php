<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>OPPO</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        

        <script src="{{ asset('js/app.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
<style type="text/css">
.welcome-text{
    padding-top: 10%;
}
.login-form{
    padding-top: 3%;
}
.img-fluid{
    border-radius: 10px 10px 10px 10px;
}
.no-gutters {
  margin-right: 0;
  margin-left: 0;
}
/* > .col, > [class*="col-"] {
    padding-right: 0;
    padding-left: 0;
  } */

.or-container {
    align-items: center;
    color: #ccc;
    display: flex;
    margin: 25px 0;
}

.line-separator {
    background-color: #ccc;
    flex-grow: 5;
    height: 1px;
}

.or-label {
    flex-grow: 1;
    margin: 0 15px;
    text-align: center;
}

</style>
    <body class="antialiased ">

        <div class="container text-center">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="row no-gutters">

                    <div class="col-sm-12 col-lg-12 col-md-12 welcome-text">
                        <h2>
                         Welcome To The OPPO Lucky Draw
                         </h2>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-md-12 login-form">
<!-- Start Login  -->
    <div class="row justify-content-center">
        <div class="col-md-10 col-sm-10 col-lg-10">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <div class="row no-gutters">
                        <div class="col-sm-5 col-lg-5 col-md-5">
                                <img src="{{URL('oppo.jpg')}}"  class="img-fluid"  alt="Responsive image" />
                        </div>
                        <div class="col-md-7 col-lg-7 col-sm-7 pt-4">
                                <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 no-gutters">
                            <label for="email" class="col-md-4 col-form-label text-md-start text-sm-start text-lg-start">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-1 no-gutters">
                            <div class="col-md-6 offset-md-4 ">
                                <div class="form-check">
                                    <input class="form-check-input p-0 m-0"  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label  p-0 m-0" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0 ">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                     
                        <div class="or-container">
                            <div class="line-separator"></div>
                            <div class="or-label">or</div>
                            <div class="line-separator"></div>
                        </div>
                       
                        <a href="{{ url('auth/dingtalk') }} " role="button" class="btn btn-secondary" type="button">                            
                            <img src="{{ asset('image/dingTalk.png') }} " width="35" height="35"> Sigin with DingTalk
                        </a>
                    </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Login -->
                    </div>
                </div>
            </div>
        </div>



    
    </body>
</html>
