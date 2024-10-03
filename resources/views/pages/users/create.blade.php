<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create') }}
    </h2>
</x-slot>



<form id="services" action="{{ route('service.store') }}" method="POST" id="typeValidation">
@csrf <!-- Add CSRF token field -->

  <div class="grid xl:grid-cols-1" style="padding:0%">
      <div class="card">
          <div class="card-body flex flex-col p-6">
              <div class="card-text h-full">

                <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                    <div class="flex-1">
                        <div class="card-title text-slate-900 dark:text-white">User Information</div>
                    </div>
                </header>

                  <div class="input-area p-2"> 
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">First Name</label>
                              <input type="text" class="form-control" placeholder="Enter First Name">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Middle Name</label>
                              <input type="text" class="form-control" placeholder="Enter Middle Name">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Last Name</label>
                              <input type="text" class="form-control" placeholder="Enter Last Name">
                            </div>
                       
                            <div class="input-area">
                              <label for="select" class="form-label">Gender</label>
                              <select  class="form-control">
                                <option value="" class="dark:bg-slate-700">Select Gender</option>
                                <option value="male" class="dark:bg-slate-700">Male</option>
                                <option value="female" class="dark:bg-slate-700">Female</option>
                              </select>
                            </div>

                            <div class="input-area relative">
                              <label  class="form-label">Birth Date</label>
                              <input type="date" class="form-control" >
                            </div>

                            <div class="input-area">
                              <label for="select" class="form-label">User Type</label>
                              <select id="select" class="form-control">
                                <option value="therapist" class="dark:bg-slate-700">Therapist</option>
                                <option value="supervisor" class="dark:bg-slate-700">Supervisor</option>
                                <option value="staff" class="dark:bg-slate-700">Staff</option>
                              </select>
                            </div>
                        </div>
                  </div>

                  <div class="input-area p-2"> 
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Phone No.</label>
                              <input type="text" class="form-control" placeholder="Enter Phone no.">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Email</label>
                              <input type="email" class="form-control" placeholder="Enter Email">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Password</label>
                              <input type="password" class="form-control" placeholder="Enter Password">
                            </div>
                        </div>
                  </div>
          
                  <div class="input-area p-2"> 
                      <label  class="form-label">Image</label>
                      <input  name="upload" type="file" class="form-control" placeholder="Enter type of services">
                  </div>

                  <div class="input-area p-2"> 
                      <label class="form-label">Address</label>
                      <textarea name="address" rows="5" class="form-control" placeholder="Your Address"></textarea>
                  </div>

                  <button class="btn flex justify-center btn-dark float-right">Submit</button>
              </div>
              
          </div>
      </div>
  </div>
</form>




</x-app-layout>
<script>
$(document).on('submit', '#services', function(event) { // Replace '#yourFormId' with your form's actual ID
    event.preventDefault(); // Prevent the default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save this course?",
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
                url: '{{ route("service.store") }}', // Adjust the route
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
                        'An error occurred while saving the course.',
                        'error'
                    );
                    console.error(error);
                }
            });
        }
    });
});

</script>