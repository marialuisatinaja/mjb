<!DOCTYPE html>
<html lang="en" dir="ltr" class="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <title>MJB - Massaje Bohol</title>
  <link rel="icon" type="image/png" href="assets/images/logo/favicon.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/rt-plugins.css">
  <link href="https://unpkg.com/aos@2.3.0/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/app.css') }}"   />
  <!-- START : Theme Config js-->
  <script src="assets/js/settings.js" sync></script>
  <!-- END : Theme Config js-->
</head>

<body class=" font-inter skin-default">
  <!-- [if IE]> <p class="browserupgrade">
            You are using an <strong>outdated</strong> browser. Please
            <a href="https://browsehappy.com/">upgrade your browser</a> to improve
            your experience and security.
        </p> <![endif] -->

  <div class="loginwrapper bg-cover bg-no-repeat bg-center" style="background-image: url(assets/img/bg.jpg);">
    <div class="lg-inner-column">
      <div class="left-columns lg:w-1/2 lg:block hidden">
        <div class="logo-box-3">
          <a heref="index.html" class="">
            <img src="assets/images/logo/logo-white.svg" alt="">
          </a>
        </div>
      </div>
      <div class="lg:w-1/2 w-full flex flex-col items-center justify-center">
        <div class="auth-box-3">
          <div class="mobile-logo text-center mb-6 lg:hidden block">
            <a heref="index.html">
              <img src="assets/images/logo/logo.svg" alt="" class="mb-10 dark_logo">
              <img src="assets/images/logo/logo-white.svg" alt="" class="mb-10 white_logo">
            </a>
          </div>
          <div class="text-center 2xl:mb-10 mb-5">
            <h4 class="font-medium">Sign In</h4>
            <div class="text-slate-500 dark:text-slate-400 text-base">
              Sign in to your account
            </div>
          </div>

          <!-- BEGIN: Registration Form -->
          <form class="space-y-4"  method="POST" action="{{ route('login') }}">
          @csrf
            <div class="fromGroup">
            <x-input-label class="block capitalize form-label" for="email" :value="__('Email')" />
                <div class="relative">
                    <x-text-input id="email" class="form-control py-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

   

            <div class="fromGroup">
              <x-input-label class="block capitalize form-label"  for="password" :value="__('Password')" />
                <x-text-input  class="form-control py-2"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Enter your email"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
              </div>

            <div class="fromGroup">
                <button class="btn btn-dark block w-full text-center">Sign in</button>
            </div>
          </form>


          <div class="mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-6 uppercase text-sm text-center">
            Already registered?
            <a href="{{ route('register') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
            Sign up
            </a>
          </div>
        </div>
      </div>
      <div class="auth-footer3 text-white py-5 px-5 text-xl w-full">
        Unlock your Project performance
      </div>
    </div>
  </div>

  <!-- scripts -->
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="assets/js/rt-plugins.js"></script>
  <script src="assets/js/app.js"></script>
</body>
</html>