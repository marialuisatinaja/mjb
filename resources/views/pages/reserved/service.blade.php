<div class="row gy-4">

<div class="col-md-4">

  <section id="portfolio" class="pricing section">

  <div class="container">
    <div class="row gy-3">
      <div class="row">
      <center><h4>Service Details</h4></center><br><br>
        <div class="row pricing-container">
            <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
                <div class="pricing-item">
                    @if($services->upload)
                        <center><img src="{{ asset($services->upload) }}" alt="{{ $services->title }}" class="img-fluid" style="height:200px;width:300px;"></center>
                    @else
                        <center><img src="http://mjb.test/assets/img/masonry-portfolio/masonry-portfolio-2.jpg" class="img-fluid" alt="" style="height:200px;width:300px;"></center>
                    @endif
                    <center><br>
                        <div class="portfolio-info">
                        <h4>{{ $services->title }} <br> ( ₱{{  $services->amount }} )</h4>
                        <p>{{ $services->description }}</p>
                        </div>
                    </center>
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

        <form action="{{ route('service.reservation') }}" method="post"  id="user" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                    @csrf <!-- Add CSRF token field -->
                      <input type="hidden" name="service_id" value="{{ $id }}">
                      <div class="row gy-4">

                        <div class="col-md-4">
                        <small>Input First Name</small>
                          <input type="text" name="first_name" class="form-control" placeholder="Your First Name" required="">
                        </div>

                        <div class="col-md-4">
                        <small>Input Middle Name</small>
                          <input type="text" class="form-control" name="middle_name" placeholder="Your Middle Name">
                        </div>

                        <div class="col-md-4">
                        <small>Input Last Name</small>
                        <input type="text" class="form-control" name="last_name" placeholder="Your Last Name">
                        </div>

                        <div class="col-md-4">
                        <small>Select Gender</small>
                          <select name="gender" class="form-control" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>


                        <div class="col-md-4">
                        <small>Input Email</small>
                          <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                        </div>

                        <div class="col-md-4 pb-3">
                        <small>Input phone</small>
                        <input type="text" id="phone" class="form-control" name="phone" placeholder="09512348350" required maxlength="12">
                        </div>



                        <div id="self" class="container pb-3">
                            <div class="row">
                                <div class="col-md-4">
                                <small>Select Type</small>
                                    <select name="type" class="form-control" required onchange="toggleGroupFields()">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="self">Self</option>
                                        <option value="group">Group</option>
                                    </select>
                                </div>

                                <div id="therapist-select" class="col-md-4">
                                <small>Preffered Therapist</small>
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
                        <input type="time" id="time" name="time" class="form-control" required>
                        <!-- <input type="time" id="time" name="time" class="form-control" min="09:00" max="18:00" required> -->
                        </div>




                        <div class="col-md-12">
                          <textarea class="form-control" name="message" rows="6" placeholder="Message" ></textarea>
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

<script>

  $(document).on('submit', '#user', function(event) {
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
                            window.location.reload();
                          });
                      },
                      error: function(error) {
                          Swal.fire(
                              'Error!',
                              'An error occurred while saving the reservation.',
                              'error'
                          );
                          console.error(error);
                      }
                  });
              }
          });


  });

  $(document).ready(function() {
  const $phoneInput = $('#phone');
  const phonePattern = /^0\d{11}$/; // Matches a string that starts with '0' and followed by 11 digits (total 12 digits)

  // Input event listener for real-time validation
  $phoneInput.on('input', function() {
    // Remove non-numeric characters
    $(this).val($(this).val().replace(/[^\d]/g, ''));

    // Check if the current value matches the phone number format
    const value = $phoneInput.val();
    if (phonePattern.test(value)) {
      $phoneInput.addClass('valid').removeClass('invalid');
    } else {
      $phoneInput.addClass('invalid').removeClass('valid');
    }
  });

  const $totalPersonInput = $('input[name="total_person"]');
  const $boyTherapistInput = $('input[name="boy_therapist"]');
  const $girlTherapistInput = $('input[name="girl_therapist"]');

  // Update boy and girl therapists based on total persons
  $totalPersonInput.on('input', function() {
    const total = parseInt($(this).val()) || 0; // Get the total person input
    // Calculate the values for boy and girl therapists
    const boys = Math.floor(total / 2); // Half for boys
    const girls = Math.ceil(total / 2);  // Half for girls (rounded up)

    // Set the values in the inputs
    $boyTherapistInput.val(boys);
    $girlTherapistInput.val(girls);
  });

  // Adjust the number of girls based on boys input
  $boyTherapistInput.on('input', function() {
    const total = parseInt($totalPersonInput.val()) || 0;
    const boys = parseInt($(this).val()) || 0; // Get current boys input
    const girls = Math.max(0, total - boys); // Calculate girls as total - boys

    // Check if the total exceeds the limit
    if (boys + girls > total) {
      $boyTherapistInput.val(Math.floor(total / 2));
      $girlTherapistInput.val(Math.ceil(total / 2));
    } else {
      $girlTherapistInput.val(girls); // Set the new girls value
    }
  });

  // Adjust the number of boys based on girls input
  $girlTherapistInput.on('input', function() {
    const total = parseInt($totalPersonInput.val()) || 0;
    const girls = parseInt($(this).val()) || 0; // Get current girls input
    const boys = Math.max(0, total - girls); // Calculate boys as total - girls

    // Check if the total exceeds the limit
    if (boys + girls > total) {
      $boyTherapistInput.val(Math.floor(total / 2));
      $girlTherapistInput.val(Math.ceil(total / 2));
    } else {
      $boyTherapistInput.val(boys); // Set the new boys value
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

</script>