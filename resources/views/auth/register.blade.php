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
  <link rel="stylesheet" href="{{ asset('admin/assets/css/sweetalert2.css') }}"></link>
  <!-- START : Theme Config js-->
  <script src="{{ asset('assets/js/settings.js') }}"></script>
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
            <h4 class="font-medium">Sign Up</h4>
            <div class="text-slate-500 dark:text-slate-400 text-base">
             Create your Account
            </div>
          </div>

          <!-- BEGIN: Registration Form -->
          <form method="POST" id="user" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">
                  <div class="input-area relative">
                      <label for="largeInput" class="form-label">First Name</label>
                      <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                  </div>

                  <div class="input-area relative">
                      <label for="largeInput" class="form-label">Middle Name</label>
                      <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                  </div>

                  <div class="input-area relative">
                      <label for="largeInput" class="form-label">Last Name</label>
                      <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                  </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-3">
                  <div class="input-area">
                      <label for="select" class="form-label">Gender</label>
                      <select  class="form-control" name="gender" required>
                      <option value="" class="dark:bg-slate-700">Select Gender</option>
                      <option value="Male" class="dark:bg-slate-700">Male</option>
                      <option value="Female" class="dark:bg-slate-700">Female</option>
                      </select>
                  </div>

                  <div class="input-area">
                      <label  class="form-label">Birth Date</label>
                      <input name="birth_date" type="date" class="form-control" >
                  </div>
                  
                  <div class="input-area">
                      <label for="largeInput" class="form-label">Phone No.</label>
                      <input type="number" name="phone" class="form-control" placeholder="Enter Phone no." required>
                  </div>

                  <div class="input-area">
                      <label for="largeInput" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                  </div>

            </div>
            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-3">
              <div class="input-area relative">
                  <label for="largeInput" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
              </div>
            </div>
            <br>
            <div class="fromGroup">
                  <button class="btn btn-dark block w-full text-center">Sign Up</button>
              </div> 
          </form>


          <div class="mx-auto font-normal text-slate-500 dark:text-slate-400 2xl:mt-12 mt-6 uppercase text-sm text-center">
            Already registered?
            <a href="{{ route('login') }}" class="text-slate-900 dark:text-white font-medium hover:underline">
            Sign in
            </a>
          </div>
        </div>
      </div>
      <div class="auth-footer3 text-white py-5 px-5 text-xl w-full">
        Unlock your Project performance
      </div>
    </div>
  </div>


  <script src="{{ asset('admin/assets/js/rt-plugins.js') }}"></script>
  <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/app.js') }}"></script>
  <script src="{{ asset('admin/assets/js/sweetalert2.js') }}"></script>
  <script>
$(document).on('submit', '#user', function(event) { // Replace '#yourFormId' with your form's actual ID
    event.preventDefault(); // Prevent the default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save this user?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData(this);
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{ route("register") }}', // Adjust the route
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    Swal.fire(
                        'Submitted!',
                        'Your form has been submitted.',
                        'success'
                    ).then(() => {
                        // Handle the redirection here
                        window.location.href = response.redirectUrl; // Make sure your backend sends this URL
                    });
                },
                error: function(error) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while saving the user.',
                        'error'
                    );
                    console.error(error);
                }
            });
        }
    });
});
</script>

</body>
</html>