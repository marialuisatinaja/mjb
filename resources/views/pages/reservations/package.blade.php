<div class="row gy-4">

<div class="col-md-4">

  <section id="portfolio" class="pricing section">

  <div class="container">
    <div class="row gy-3">
      <div class="row">
      <center><h4>Package Details</h4></center><br><br>
        <div class="row pricing-container">
            <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="pricing-item">
                    <span class="advanced">{{ $packages->persons }} person</span>
                    <h3>{{ $packages->name }}</h3>
                    <h4><sup>₱</sup>{{ $packages->amount }}<span> / pesos</span></h4>
                    <ul>
                        @foreach($svs as $val)
                            <li>{{ $val->services->title }}</li>
                        @endforeach
                    </ul>
                    <div class="btn-wrap">
                    </div>
                </div>
        </div>
      </div>
    </div>
  </div>
  </section>

</div>

<div class="col-md-8">
<section id="contact" class="contact section" >
  <center><h4>Reservation Details</h4></center><br>
    <div class="container" data-aos="fade" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-12">

          <form action="{{ route('service.reservation') }}" method="post"  id="services" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
          @csrf <!-- Add CSRF token field -->
            <div class="row gy-4">
            <input type="hidden" name="total_person" value="{{ $packages->persons }}">
                <input type="hidden" name="service_id" value="{{ $packages->id }}">
              <input type="hidden" name="service_type" value="package">
              <input type="hidden" name="type" value="group">
              <input type="hidden" name="service_ammount" value="{{ $packages->amount }}">
              <div class="col-md-4">
                <label for="time">Input First Name.</label>
                <input type="text" name="first_name" class="form-control" placeholder="Your First Name" required="">
              </div>

              <div class="col-md-4">
                <label for="time">Input Middle Name.</label>
                <input type="text" class="form-control" name="middle_name" placeholder="Your Middle Name">
              </div>

              <div class="col-md-4">
              <label for="time">Input Last Name.</label>
              <input type="text" class="form-control" name="last_name" placeholder="Your Last Name">
              </div>

              <div class="col-md-4">
                <label for="time">Select Gender.</label>
                <select name="gender" class="form-control" required>
                  <option value="" disabled selected>Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>


              <div class="col-md-4">
              <label for="time">Input Email.</label>
                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
              </div>

              <div class="col-md-4 pb-3">
              <label for="time">Input Phone #.</label>
              <input type="text" id="phone" class="form-control" name="phone" placeholder="09512348350" required maxlength="12">
              </div>

              <div class="col-md-6">
              <label for="time">Select a date</label>
              <input type="date" name="date" class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
              </div>

              <div class="col-md-6">
              <small for="time" class="form-label">Business Hours 11:00 am to 11:00 pm</small>
              <input type="time" id="time" name="time" class="form-control" min="11:00" max="23:00" value="11:00" required>
              </div>

              <input type="hidden" name="offers"  value="reservations">

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

<script>
    $(document).on('submit', '#services', function(event) {
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
                              'Your reservation has been submitted please wait check your  email for confirmation.',
                              'success'
                          ).then(() => {
                              // window.location.href = response.redirectUrl; // Make sure your backend sends this URL
                              window.location.reload();
                          });
                      },
                      error: function(error) {
                          Swal.fire(
                              'Error!',
                              'An error occurred while saving the reservations.',
                              'error'
                          );
                          console.error(error);
                      }
                  });
              }
          });

   
   });
</script>