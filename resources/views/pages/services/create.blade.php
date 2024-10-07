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
                        <div class="card-title text-slate-900 dark:text-white">Services Information</div>
                    </div>
                </header>

                  <div class="input-area p-2"> 
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-7">
                        <div class="input-area p-2">
                            <label  class="form-label">Services</label>
                            <input  name="title" type="text" class="form-control" placeholder="Enter Services">
                        </div> 
                        <div class="input-area p-2"> 
                            <label  class="form-label">Type</label>
                            <input  name="type" type="text" class="form-control" placeholder="Enter type of services">
                        </div>
                    </div>
                    
                  </div>

          

                  <div class="input-area p-2"> 
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-7">
                        
                        <div class="input-area p-2">
                        <label  class="form-label">Duration</label>
                            <div class="grid grid-cols-2 gap-4">
                                <input name="hours" type="number" class="form-control" placeholder="Enter Hour(s) ">
                                <input name="minutes" type="number" class="form-control"  placeholder="Enter Minute(s) ">
                            </div>
                        </div>

                        <div class="input-area p-2"> 
                            <label  class="form-label">Prince</label>
                            <input  name="amount" type="number" class="form-control" placeholder="Enter the  price for this services">
                        </div>
                    </div>
                  </div>
          

                  <div class="input-area p-2"> 
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-7">
                        
                        <div class="input-area p-2"> 
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="5" class="form-control" placeholder="Your Message"></textarea>
                        </div>

                        <div class="input-area p-2"> 
                            <label  class="form-label">Image</label>
                            <input  name="upload" type="file" class="form-control" placeholder="Enter type of services">
                        </div>

                    </div>
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
        text: "Do you want to save this services?",
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
                        'An error occurred while saving the services.',
                        'error'
                    );
                    console.error(error);
                }
            });
        }
    });
});

</script>