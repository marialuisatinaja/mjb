<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>MDB - MASAGE DE BOHOL </title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/sweetalert2.css') }}"></link>

</head>

<body class="index-page">

<style>
  .pricing-container {
    display: flex;
    flex-wrap: wrap;
}

.pricing-item {
    display: flex;
    flex-direction: column;
    height: 100%;
    justify-content: space-between; /* Align items within the container */
}

.btn-wrap {
    margin-top: auto; /* Push the button to the bottom */
}

.pricing-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* Change number based on layout */
    gap: 20px; /* Adjust as needed */
}

.pricing-item {
    display: flex;
    flex-direction: column;
    height: 100%; /* Ensures each item stretches to full height */
    width: 300px;
    justify-content: space-between; /* Aligns items within the container */
}

</style>
  <header id="header" class="header d-flex align-items-center fixed-top" style="background-color: #2a2c39;">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">MDB</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#portfolio">Packages</a></li>
          <li><a href="#team">Therapist</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background " style="background-image: url(assets/img/bg1.jpg); background-size: cover; background-repeat: no-repeat;"
    >

      <div id="hero-carousel" data-bs-interval="5000" class="container carousel carousel-fade" data-bs-ride="carousel">

        <!-- Slide 1 -->
        <div class="carousel-item active">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">Masaje de Bohol  <span>Sauna & Spa</span></h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">Lorem Ipsum Dolor</h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
          <div class="carousel-container">
            <h2 class="animate__animated animate__fadeInDown">Sequi ea ut et est quaerat</h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>

      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
      </svg>

    </section><!-- /Hero Section -->


    <!-- Portfolio Section -->
    <section id="services" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
      <h2>Services</h2>
      <p>What we do offer</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">



          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

          @foreach($services as $service)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ $service->id }}">

                @if($service->upload)
                <img src="{{ asset($service->upload) }}" alt="{{ $service->title }}" class="img-fluid" style="height:250px;width:300px;">
                @else
                <img src="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" class="img-fluid" alt=""  style="height:250px;width:300px;">
                @endif

    
              <div class="portfolio-info">
                <h4>{{ $service->title }}  ( ₱{{  $service->amount }} )</h4>
                <p>{{ $service->description }} </p>

                <div class="btn-wrap center">
                    <a href="javascript:(0);" onclick="get_details1(1)" class="btn-buy ml-3">Reserve Now</a>
                </div>
                <!-- <a href="{{ asset($service->upload) }}" title="{{ $service->title }} ( ₱{{  $service->amount }} )" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                <a href="javascript:(0);" onclick="get_details1({{ $service->id }})" title="reserved" class="details-link"><i class="bi bi-book"></i></a> -->
              </div>
            </div><!-- End Portfolio Item -->
      

            @endforeach
      

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->


    <!-- Pricing Section -->
    <section id="portfolio" class="pricing section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Packages</h2>
        <p>What We Have Bucketlist</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-3">
          <div class="row">
            <div class="row pricing-container">
                @foreach($packages as $row)
                <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="pricing-item">
                        <span class="advanced">{{ $row->persons }} person</span>
                        <h3>{{ $row->name }}</h3>
                        <h4><sup>₱</sup>{{ $row->amount }}<span> / pesos</span></h4>
                        <ul>
                            @foreach($svs as $val)
                              @if($row->id == $val->package_id)
                                <li>{{ $val->services->title }}</li>
                              @endif
                            @endforeach
              

                        </ul>
                        <div class="btn-wrap">
                            <!-- <a href="javascript:(0);" onclick="get_details({{ $row->id }})" class="btn-buy">Reserve Now</a> -->
                            <a href="javascript:(0);" onclick="get_register()" class="btn-buy">Reserve Now</a>
                        </div>
                    </div>
                </div><!-- End Pricing Item -->
                @endforeach
            </div>
          </div>
      </div>

    </section><!-- /Pricing Section -->

    <!-- Team Section -->
    <section id="team" class="team section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Our Hardworking Team</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
          @foreach($therapist as $row)
          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member">

              <div class="member-img">
                @if($row->image)
                <img src="{{ asset($row->image) }}" alt="{{ $row->first_name }}" class="img-fluid">
                @else
                <img src="assets/img/team/user.png" class="img-fluid" alt="" style="width: 100%;">
                @endif
    
              </div>

              <div class="member-info">
                <h4>{{ ucwords($row->first_name.' '.$row->middle_name.' '.$row->last_name) }}</h4>
                <span>{{ $row->user_type}}</span>
              </div>
            </div>
          </div><!-- End Team Member -->
          @endforeach

        </div>

      </div>

    </section><!-- /Team Section -->



<div class="modal fade" id="large_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body body-details">

            </div>
    
        </div>
    </div>
</div>

<div class="modal fade" id="register_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body body-details">
                  
            </div>
    
        </div>
    </div>
</div>

  </main>

  <footer id="footer" class="footer dark-background">
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
        <div class="credits">
        </div>
      </div>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{ asset('admin/assets/js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/sweetalert2.js') }}"></script>
  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
  </script>
  <script>



    function get_register(id)
    {

      Swal.fire({
    title: 'You must create an account first',
    text: "Do you want to create an account?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, I will create an account',
    cancelButtonText: 'No, I have an account already!'
}).then((result) => {
    if (result.isConfirmed) {
        // Redirect to the registration page if user confirms
        window.location.href = 'http://mjb.test/register';
    } else {
        // Redirect to the login page if user cancels
        window.location.href = 'http://mjb.test/login';
    }
});


    }



    function get_details(id) {
      $('#large_modal').modal('show');
      $.ajax({
          type: "POST",
          url: '{{ route("service.package") }}', // Adjust the route
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          data: {
              id: id, // Your data
          },
          success: function(data) {
              $(".body-details").show().html(data);
              
              // Add the following event to reset the steps when the modal is closed
              $('#large_modal').on('hidden.bs.modal', function() {
                  resetSteps();
              });
          }
      });
    }


    function get_details1(id)
      {

        $('#large_modal').modal('show');
        $.ajax({
              type: "POST",
              url: '{{ route("service.service") }}', // Adjust the route
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              data: {
                  id: id, // Your data
              },
              success: function(data) {
                  $(".body-details").show().html(data);
              }
          });
      }
      
  </script>
</body>

</html>