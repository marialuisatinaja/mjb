<form id="services" action="{{ route('reservation.update_details', $reservation->id) }}" method="POST" id="typeValidation">
@csrf
@method('PUT')
@csrf <!-- Add CSRF token field -->

<div class="card-text h-full">
    <div class="profiel-wrap px-[35px] pb-10 md:pt-[84px] pt-10 rounded-lg bg-white dark:bg-slate-800 lg:flex lg:space-y-0
            space-y-6 justify-between items-end relative z-[1]">
                <div class="bg-slate-900 dark:bg-slate-700 absolute left-0 top-0 md:h-1/2 h-[150px] w-full z-[-1] rounded-t-lg" style="background-image: url({{ asset('assets/img/bg1.jpg') }});"></div>
                <div class="profile-box flex-none md:text-start text-center">
                <div class="md:flex items-end md:space-x-6 rtl:space-x-reverse">
                    <div class="flex-none">
                    <div class="md:h-[186px] md:w-[186px] h-[140px] w-[140px] md:ml-0 md:mr-0 ml-auto mr-auto md:mb-0 mb-4 rounded-full ring-4
                            ring-slate-100 relative">
                            
                        <img src="http://mjb.test/assets/img/masonry-portfolio/masonry-portfolio-2.jpg" alt="" class="w-full h-full object-cover rounded-full">

                    </div>
                    </div>
                    <div class="flex-1">
                    <div class="text-2xl font-medium text-slate-900 dark:text-slate-200 mb-[3px]">
                        {{ $reservation->services->title }}
                    </div>
                    <div class="text-sm font-light text-slate-600 dark:text-slate-400">
                        Services Offer
                    </div>
                    </div>
                </div>
                </div>
                <!-- end profile box -->
                <div class="profile-info-500 md:flex md:text-start text-center flex-1 max-w-[516px] md:space-y-0 space-y-4">
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                    ₱ {{ $reservation->services->amount }}
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                    Services Ammount
                    </div>
                </div>
                <!-- end single -->
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                        {{ $reservation->total_person }}
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                        No. of Persons
                    </div>
                </div>
                <!-- end single -->
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                    ₱ {{ number_format((@$reservation->services->amount * $reservation->total_person), 2, '.', ',') }}
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                        Total Payment
                    </div>
                </div>
                <!-- end single -->
                </div>
                <!-- profile info-500 -->
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-1">

    <input type="hidden" name="status"  value="{{ $status }}">
        <div class="input-area p-2">
            <label  class="form-label">First Name</label>
            <input  name="first_name" type="text" value="{{ $reservation->first_name }}" class="form-control" placeholder="Enter First Name" disabled>
        </div> 

        <div class="input-area p-2"> 
            <label  class="form-label">Middle Name</label>
            <input  name="middle_name" type="text" value="{{ $reservation->middle_name }}" class="form-control" placeholder="Enter Middle Name" disabled>
        </div>

        <div class="input-area p-2"> 
            <label  class="form-label">Last Name</label>
            <input  name="type" type="text" value="{{ $reservation->last_name }}" class="form-control" placeholder="Enter Last Name" disabled>
        </div>

        
        <div class="input-area p-2">
            <label  class="form-label">Gender</label>
            <select name="gender" class="form-control" disabled>
                <option value="" disabled selected>Select Gender</option>
                <option value="male" class="dark:bg-slate-700"  {{ $reservation->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" class="dark:bg-slate-700"  {{ $reservation->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>

        </div> 

        <div class="input-area p-2"> 
            <label  class="form-label">Email</label>
            <input  name="email"  value="{{ $reservation->email }}" type="email" class="form-control" placeholder="Enter your Email" disabled>
        </div>

        <div class="input-area p-2"> 
            <label  class="form-label">Phone</label>
            <input type="text" id="phone" value="{{ $reservation->phone }}" class="form-control" name="phone" placeholder="09512348350" required maxlength="12" disabled>
        </div>

        <div class="input-area p-2"> 
            <label  class="form-label">Date</label>
            <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
        </div>

        <div class="input-area p-2"> 
        <label  class="form-label">Select a time:</label>
            <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required>
        </div>

    </div>
</div>
<br>

@if($status == 'Resched')
    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
        <button data-bs-dismiss="modal" class="btn inline-flex justify-center text-white bg-green-500 hover:bg-green-600">
            Resched
        </button>
    </div>
@elseif($status == 'Paid')
    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
        <button data-bs-dismiss="modal" class="btn inline-flex justify-center text-white bg-blue-500 hover:bg-blue-600">
            Pay
        </button>
    </div>
@else
    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
        <button data-bs-dismiss="modal" class="btn inline-flex justify-center text-white bg-red-500 hover:bg-red-600">
            Cancel
        </button>
    </div>
@endif



</form>

<script>
    $(document).on('submit', '#services', function(event) {
    event.preventDefault(); // Prevent the default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want change the status?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData(this);
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            const serviceId = "{{ $reservation->id }}"; // Get the service id

            $.ajax({
                url: '{{ url("reservation/update_details") }}/' + serviceId, // Append the service id to the URL
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
                        window.location.reload();
                    });
                },
                error: function(error) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while saving the status.',
                        'error'
                    );
                    console.error(error);
                }
            });
        }
    });
});
</script>

