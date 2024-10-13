<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create') }}
    </h2>
</x-slot>



<form id="user" action="{{ route('user.update', $users->id) }}" method="POST" id="typeValidation">
@csrf
@method('PUT')
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
                              <input type="text" name="first_name" value="{{ $users->first_name }}" class="form-control" placeholder="Enter First Name">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Middle Name</label>
                              <input type="text" name="middle_name" value="{{ $users->middle_name }}" class="form-control" placeholder="Enter Middle Name">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Last Name</label>
                              <input type="text" name="last_name" value="{{ $users->last_name }}"  class="form-control" placeholder="Enter Last Name">
                            </div>
                       
                            <div class="input-area">
                              <label for="select" class="form-label">Gender</label>
                              <select class="form-control" name="gender">
                                <option value="" class="dark:bg-slate-700">Please Select Gender</option>
                                <option value="Male" class="dark:bg-slate-700" {{ $users->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" class="dark:bg-slate-700" {{ $users->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            </div>

                            <div class="input-area relative">
                              <label  class="form-label">Birth Date</label>
                              <input name="birth_date" value="{{ $users->birth_date }}" type="date" class="form-control" >
                            </div>

                            <div class="input-area">
                              <label for="select" class="form-label">User Type</label>
                              <select id="select" class="form-control"  name="user_type">
                                <option value="" class="dark:bg-slate-700">Please Select User Type</option>
                                <option value="Therapist" class="dark:bg-slate-700"  {{ $users->user_type == 'Therapist' ? 'selected' : '' }}>Therapist</option>
                                <option value="Receptionist" class="dark:bg-slate-700" {{ $users->user_type == 'Receptionist' ? 'selected' : '' }}>Receptionist</option>
                                <option value="Admin" class="dark:bg-slate-700" {{ $users->user_type == 'Admin' ? 'selected' : '' }}>Admin</option>
                                
                              </select>
                            </div>
                        </div>
                  </div>

                  <div class="input-area p-2"> 
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7">

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Phone No.</label>
                              <input type="text" name="phone" value="{{ $users->phone }}"  class="form-control" placeholder="Enter Phone no.">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Email</label>
                              <input type="email" name="email" value="{{ $users->email }}"  class="form-control" placeholder="Enter Email">
                            </div>

                            <div class="input-area relative">
                              <label for="largeInput" class="form-label">Password</label>
                              <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                        </div>
                  </div>
          
                  <div class="input-area p-2"> 
                      <label  class="form-label">Image</label>
                      <input  name="image" type="file" name="email" value="{{ $users->image }}" class="form-control" placeholder="Enter type of services">
                  </div>

                  <div class="input-area p-2"> 
                      <label class="form-label">Address</label>
                      <textarea name="address" rows="5" class="form-control" placeholder="Your Address">{{ $users->address }}</textarea>
                  </div>

                  <button class="btn flex justify-center btn-dark float-right">Submit</button>
              </div>
              
          </div>
      </div>
  </div>
</form>




</x-app-layout>
<script>
$(document).on('submit', '#user', function(event) { // Replace '#yourFormId' with your form's actual ID
    event.preventDefault(); // Prevent the default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to update this user?",
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
                url: '{{ route("user.update", $users->id) }}',
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