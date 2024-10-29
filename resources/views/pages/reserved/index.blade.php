<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MDB - MASAGE DE BOHOL </title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="app-url" content="{{ config('app.url') }}">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/sweetalert2.css') }}"></link>
  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <style>
    .valid {
      border: 2px solid green;
    }

    .invalid {
      border: 2px solid red;
    }
  </style>
</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <h1 class="sitename">MDB</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul id="nav-menu">
          <li><a href="#hero">Home</a></li>
          <li><a href="#contact" >Services</a></li>
          <li><a href="#portfolio">Packages</a></li>
          <li><a href="#team">Therapist</a></li>
          <li><a href="#recent-posts">Blog</a></li>
          <li><a href="#hero">Contact</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
    </div>
  </header>
  <div id="error-messages"></div>
  <div id="success-message" style="display: none"></div>
  <main class="main">
    <section id="hero" class="hero section dark-background" style="background-image: url({{ asset('assets/img/bg1.jpg') }}); background-size: cover; background-repeat: no-repeat;"><br><br>
      <div id="hero-carousel" class="container carousel carousel-fade" data-bs-ride="carousel" style="height: 650px;">

      <div style="display: flex; height: 100px; margin-top: 6%;">

          <div style="flex: 1;">
            @foreach($services as $service)
              <br><br><br>
              @if($service->upload)
                <center><img src="{{ asset($service->upload) }}" alt="{{ $service->title }}" class="img-fluid" style="height:300px;width:300px;"></center>
              @else
                <center><img src="http://mjb.test/assets/img/masonry-portfolio/masonry-portfolio-2.jpg" class="img-fluid" alt="" style="height:300px;width:300px;"></center>
              @endif

              <center><br>
                <div class="portfolio-info">
                  <h4>{{ $service->title }} ( ₱{{  $service->amount }} )</h4>
                  <p>{{ $service->description }}</p>
                </div>
              </center>
            @endforeach
          </div>

          <div class="reserved mb-5" style="flex: 1; background-color:white;padding:0px;margin:0px;">
            <section id="contact" class="contact section" >
            <center><h3>Reservation Details</h3></center><br>
              <div class="container" data-aos="fade" data-aos-delay="100">
                <div class="row gy-4">
                  <div class="col-lg-12">

                    <form action="{{ route('service.reservation') }}" method="post"  id="user" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    @csrf <!-- Add CSRF token field -->
                      <input type="hidden" name="service_id" value="{{ $id }}">
                      <div class="row gy-4">

                        <div class="col-md-4">
                          <input type="text" name="first_name" class="form-control" placeholder="Your First Name" required="">
                        </div>

                        <div class="col-md-4">
                          <input type="text" class="form-control" name="middle_name" placeholder="Your Middle Name">
                        </div>

                        <div class="col-md-4">
                        <input type="text" class="form-control" name="last_name" placeholder="Your Last Name">
                        </div>

                        <div class="col-md-4">
                          <select name="gender" class="form-control" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>


                        <div class="col-md-4">
                          <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                        </div>

                        <div class="col-md-4 pb-3">
                        <input type="text" id="phone" class="form-control" name="phone" placeholder="09512348350" required maxlength="12">
                        </div>



                        <div id="self" class="container pb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="type" class="form-control" required onchange="toggleGroupFields()">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="self">Self</option>
                                        <option value="group">Group</option>
                                    </select>
                                </div>

                                <div id="therapist-select" class="col-md-4">
                                    <select name="therapist_gender" class="form-control">
                                        <option value="" disabled selected>Preffered Therapist</option>
                                        <option value="girl">Girl</option>
                                        <option value="boy">Boy</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div id="group" class="container" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <small>Total Person</small>
                                    <input type="number" class="form-control" name="total_person" placeholder="Total Person">
                                </div>

                                <div class="col-md-4">
                                    <small>Boy Therapist</small>
                                    <input type="number" class="form-control" name="boy_therapist" placeholder="Boy Therapist">
                                </div>

                                <div class="col-md-4">
                                    <small>Girl Therapist</small>
                                    <input type="number" class="form-control" name="girl_therapist" placeholder="Girl Therapist">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <label for="time">Select a date</label>
                        <input type="date" name="date" class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                        </div>

                        <div class="col-md-6">
                        <label for="time">Select a time (between 09:00 and 18:00):</label>
                        <input type="time" id="time" name="time" class="form-control" min="09:00" max="18:00" required>
                        </div>




                        <div class="col-md-12">
                          <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                        </div>

                        <div class="col-md-12 text-center">
                          <div class="loading">Loading</div>
                          <div class="error-message"></div>
                          <div class="sent-message">Your message has been sent. Thank you!</div>

                          <button type="submit">Reserved</button>
                        </div>
                      </div>
                    </form>
                  </div><!-- End Contact Form -->
                </div>
              </div>
            </section><!-- /Contact Section -->
          </div>
   
        </div>
      </div>   

      <div style="margin-top: 5%;">
     
      </div>

    </section><!-- /Hero Section -->
  
  </main>

  <footer id="footer" class="footer dark-background pt-5">
    <div class="container">
      <h3 class="sitename">MJB</h3>
      <div class="social-links d-flex justify-content-center">
        <a href=""><i class="bi bi-twitter-x"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-skype"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
      <div class="container">
        <div class="copyright">
          <span>Copyright</span> <strong class="px-1 sitename">MJB</strong> <span>All Rights Reserved</span>
        </div>
        <div class="credits"></div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('admin/assets/js/sweetalert2.js') }}"></script>
  <script>
document.addEventListener('DOMContentLoaded', function() {
  const phoneInput = document.getElementById('phone');
  const phonePattern = /^0\d{11}$/; // Matches a string that starts with '0' and followed by 11 digits (total 12 digits)

  // Input event listener for real-time validation
  phoneInput.addEventListener('input', function() {
    // Remove non-numeric characters
    this.value = this.value.replace(/[^\d]/g, '');
    
    // Check if the current value matches the phone number format
    const value = phoneInput.value;
    if (phonePattern.test(value)) {
      phoneInput.classList.add('valid');
      phoneInput.classList.remove('invalid');
    } else {
      phoneInput.classList.add('invalid');
      phoneInput.classList.remove('valid');
    }
  });

  // Auto-fill boy and girl therapist fields based on total persons
  const totalPersonInput = document.querySelector('input[name="total_person"]');
  const boyTherapistInput = document.querySelector('input[name="boy_therapist"]');
  const girlTherapistInput = document.querySelector('input[name="girl_therapist"]');

  // Update boy and girl therapists based on total persons
  totalPersonInput.addEventListener('input', function() {
    const total = parseInt(this.value) || 0; // Get the total person input
    // Calculate the values for boy and girl therapists
    const boys = Math.floor(total / 2); // Half for boys
    const girls = Math.ceil(total / 2);  // Half for girls (rounded up)

    // Set the values in the inputs
    boyTherapistInput.value = boys;
    girlTherapistInput.value = girls;
  });

  // Adjust the number of girls based on boys input
  boyTherapistInput.addEventListener('input', function() {
    const total = parseInt(totalPersonInput.value) || 0;
    const boys = parseInt(this.value) || 0; // Get current boys input
    const girls = Math.max(0, total - boys); // Calculate girls as total - boys

    // Check if the total exceeds the limit
    if (boys + girls > total) {
      boyTherapistInput.value = Math.floor(total / 2);
      girlTherapistInput.value = Math.ceil(total / 2);
    } else {
      girlTherapistInput.value = girls; // Set the new girls value
    }
  });

  // Adjust the number of boys based on girls input
  girlTherapistInput.addEventListener('input', function() {
    const total = parseInt(totalPersonInput.value) || 0;
    const girls = parseInt(this.value) || 0; // Get current girls input
    const boys = Math.max(0, total - girls); // Calculate boys as total - girls

    // Check if the total exceeds the limit
    if (boys + girls > total) {
      boyTherapistInput.value = Math.floor(total / 2);
      girlTherapistInput.value = Math.ceil(total / 2);
    } else {
      boyTherapistInput.value = boys; // Set the new boys value
    }
  });

});

  function toggleGroupFields() {
      const selectType = document.querySelector('select[name="type"]');
      const groupFields = document.getElementById('group');
      const therapist_select = document.getElementById('therapist-select');
      // Show or hide the group fields based on the selected value
      if (selectType.value === 'group') {
          groupFields.style.display = 'block'; // Show group fields
          therapist_select.style.display = 'none'; // Hide group fields
      } else {
          groupFields.style.display = 'none'; // Hide group fields
          therapist_select.style.display = 'block'; // Hide group fields
      }
  }

  document.addEventListener('DOMContentLoaded', function() {
          const userForm = document.getElementById('user'); // Replace with your actual form ID
      userForm.addEventListener('submit', function(event) {
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
                      url: '{{ route("service.reservation") }}', // Adjust the route
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
                              window.location.href = response.redirectUrl; // Make sure your backend sends this URL
                          });
                      },
                      error: function(error) {
                          Swal.fire(
                              'Error!',
                              'An error occurred while saving the services.',
                              'error'
                          );
                          console.error(error);
                      }
                  });
              }
          });
      });
  });

</script>


</body>

</html>
