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
             

                    @if($reservation->service_type == 'services')
                        @if($reservation->services->upload)
                        <img src="{{ asset($reservation->services->upload) }}" alt="{{ $reservation->services->title }}" class="w-full h-full object-cover rounded-full">
                        @else
                        <img src="http://mjb.test/assets/img/masonry-portfolio/masonry-portfolio-2.jpg" alt="" class="w-full h-full object-cover rounded-full">
                        @endif
                    @else
                    @if($reservation->package->upload)
                        <img src="{{ asset($reservation->package->upload) }}" alt="{{ $reservation->package->title }}" class="w-full h-full object-cover rounded-full">
                        @else
                        <img src="http://mjb.test/assets/img/masonry-portfolio/masonry-portfolio-2.jpg" alt="" class="w-full h-full object-cover rounded-full">
                        @endif
                    @endif

             



                    </div>
                    </div>
                    <div class="flex-1">
                    <div class="text-2xl font-medium text-slate-900 dark:text-slate-200 mb-[3px]">
                        @if($reservation->service_type == 'services')
                            {{ $reservation->services->title }}
                        @else
                            {{ $reservation->package->name }}
                        @endif
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

                        @if($reservation->service_type == 'services')
                        ₱ {{ $reservation->services->amount }}
                        @else
                        ₱ {{ $reservation->package->amount }}
                        @endif

                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                    Services Ammount
                    </div>
                </div>
                <!-- end single -->
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                        
                        @if($reservation->service_type == 'services')
                            {{ $reservation->total_person }}
                        @else
                            {{ $reservation->package->persons }}
                        @endif

               
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                        No. of Persons
                    </div>
                </div>
                <!-- end single -->
                <div class="flex-1">
                    <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                        @if($reservation->service_type == 'services')
                        ₱ {{ number_format((@$reservation->services->amount * $reservation->total_person), 2, '.', ',') }}
                        @else
                        ₱ {{ number_format((@$reservation->package->amount ), 2, '.', ',') }}
                        @endif

                    
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                        Total Payment
                    </div>
                </div>
                <!-- end single -->
                </div>
                <!-- profile info-500 -->
    </div>

    @if($status == 'Serving')
    <div class="container mx-auto mt-2">
        <div class="bg-white shadow-md rounded-lg p-2">
            <div id="form-wizard">
                <div class="step" id="step-1">
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

                        @if($status == 'Resched')
                        <div class="input-area p-2"> 
                        <label  class="form-label">Date</label>
                        <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                        </div>

                        <div class="input-area p-2"> 
                        <label  class="form-label">Select a time:</label>
                        <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required>
                        </div>
                        @else
                        <div class="input-area p-2"> 
                        <label  class="form-label">Date</label>
                        <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" readonly>
                        </div>

                        <div class="input-area p-2"> 
                        <label  class="form-label">Select a time:</label>
                        <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required readonly>
                        </div>
                        @endif
                        </div>
                        <div class="flex justify-between p-2">
                            <button type="button" class="btn inline-flex justify-center text-white bg-blue-500 hover:bg-blue-600" id="next-1" style="float: right;">
                                Served
                            </button>
                        </div>
                </div>

                    <div class="step hidden" id="step-2">
                        <div class="mb-4">
                            <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-1 mb-2">
                                <div class="text-base text-slate-900 dark:text-slate-300 font-medium mb-1">
                                    Preffered Man {{ $reservation->boy_therapist }}     &nbsp;&nbsp;&nbsp;  Preffered Woman {{ $reservation->girl_therapist }}
                                </div>
                            </div>
                            <h6 class="font-medium">Therapist Lists:</h6>
                
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-1">
                                <div class="input-area p-2">
                                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                        <thead class="bg-slate-200 dark:bg-slate-700">
                                            <tr>
                                                <th scope="col" class="table-th" style="width: 50%;">Name</th>
                                                <th scope="col" class="table-th" style="width: 25%;">Gender</th>
                                                <th scope="col" class="table-th" style="width: 25%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                        @foreach($user as $row)
                                    <tr>
                                            <td class="table-td">{{ ucwords($row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name) }}</td>
                                            <td class="table-td">{{ $row->gender }}</td>
                                            <td class="table-td">
                                                <div class="flex space-x-3 rtl:space-x-reverse">
                                                    <button class="action-btn" type="button" 
                                                        onclick="putServices('{{ $row->id }}', '{{ ucwords($row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name) }}', '{{ $row->gender }}')" 
                                                        title="Preview" 
                                                        aria-label="Preview {{ ucwords($row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name) }}">
                                                        <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="input-area p-2">
                                    
                                <input type="hidden" name="service_ids[]" id="serviceIdsInput" value="">
                                <input type="hidden" name="offers"  value="reservations">

                                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" id="serviceTable">
                                        <thead class="bg-slate-200 dark:bg-slate-700">
                                            <tr>
                                                <th scope="col" class="table-th" style="width: 50%;">Name</th>
                                                <th scope="col" class="table-th" style="width: 25%;">Gender</th>
                                                <th scope="col" class="table-th" style="width: 25%;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                        </tbody>
                                    </table>
                                </div>  
                            </div>



                        <div class="flex justify-between">
                            <button type="button" class="bg-gray-300 text-gray-700 p-2 rounded" id="prev-2">Previous</button>
                            <button type="button" class="btn inline-flex justify-center text-white bg-blue-500 hover:bg-blue-600" id="submit" style="float: right;">
                                    Submit
                                </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
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

        @if($status == 'Resched')
        <div class="input-area p-2"> 
            <label  class="form-label">Date</label>
            <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
        </div>

        <div class="input-area p-2"> 
        <label  class="form-label">Select a time:</label>
            <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required>
        </div>
        @elseif($status == 'Pending')
        <div class="input-area p-2"> 
            <label  class="form-label">Date</label>
            <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
        </div>

        <div class="input-area p-2"> 
        <label  class="form-label">Select a time:</label>
            <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required>
        </div>
        @else
        <div class="input-area p-2"> 
            <label  class="form-label">Date</label>
            <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" readonly>
        </div>

        <div class="input-area p-2"> 
        <label  class="form-label">Select a time:</label>
            <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required readonly>
        </div>
        @endif
    </div>
    @endif
<br>

@if($status == 'Resched')
    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
        <button  class="btn inline-flex justify-center text-white bg-green-500 hover:bg-green-600">
            Resched
        </button>
    </div>
@elseif($status == 'Pending')
    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
        <button  class="btn inline-flex justify-center text-white bg-green-500 hover:bg-green-600">
            Resched
        </button>
    </div>
    @elseif($status == 'Cancelled')
    <div class="flex items-center justify-end p-6 space-x-2 border-t border-slate-200 rounded-b dark:border-slate-600">
        <button  class="btn inline-flex justify-center text-white bg-red-500 hover:bg-red-600">
            Cancel
        </button>
    </div>
@endif



</form>

<script>
$(document).ready(function() {
    let maxServices = {{ $reservation->total_person }}; // Declare maxServices inside the ready function
    let serviceIds = []; // Ensure this is accessible to all functions

    initializeSteps(); // Make sure steps are initialized when the page or modal content is loaded

    function initializeSteps() {
        const steps = document.querySelectorAll('.step');
        let currentStep = 0;

        // Handle the next step button
        document.getElementById('next-1').onclick = function() {
            steps[currentStep].classList.add('hidden');
            currentStep++;
            steps[currentStep].classList.remove('hidden');
        };

        // Handle the previous step button
        document.getElementById('prev-2').onclick = function() {
            steps[currentStep].classList.add('hidden');
            currentStep--;
            steps[currentStep].classList.remove('hidden');
        };

        // Submit button logic
        document.getElementById('submit').onclick = function() {
            if ($('#serviceIdsInput').val() == '') {
                Swal.fire(
                    'Error!',
                    'Therapist not be empty.',
                    'error'
                );
            } else {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want to change the status?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData(document.getElementById('services'));
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
            }
        };

        // Function to reset the steps
        function resetSteps() {
            // Hide all steps
            steps.forEach(step => step.classList.add('hidden'));
            // Reset to the first step
            currentStep = 0;
            // Show the first step
            steps[currentStep].classList.remove('hidden');
        }

        // Listen for modal close event to reset steps
        $('#large_modal').on('hidden.bs.modal', function() {
            resetSteps();
            serviceIds = []; // Reset the service IDs when the modal closes
            maxServices = {{ $reservation->total_person }}; // Reset maxServices if needed
        });
    }

    // Function to add services
    window.putServices = function(serviceId, fullname, gender) {
        const tableBody = document.querySelector("#serviceTable tbody");

        // Check if the maximum number of services has been reached
        if (serviceIds.length >= maxServices) {
            alert("You can only add up to as per total person.");
            return; // Exit the function if limit is reached
        }

        // Check if the service ID already exists in the array
        if (!serviceIds.includes(serviceId)) {
            // Add the service ID to the array
            serviceIds.push(serviceId);

            // Create a new row
            const newRow = document.createElement("tr");

            // Populate the row with the service details and add a delete button
            newRow.innerHTML = `
                <td class="table-td">${fullname}</td>
                <td class="table-td">${gender}</td>
                <td class="table-td">
                    <button class="action-btn delete-btn" type="button" onclick="deleteRow(this.closest('tr'), '${serviceId}')">
                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                    </button>
                </td>
            `;

            // Append the new row to the table body
            tableBody.appendChild(newRow);

            // Update the hidden input value with the array of service IDs
            document.getElementById('serviceIdsInput').value = serviceIds.join(',');
        } else {
            alert(`Therapist is already added.`);
        }
    }

    // Function to delete a row
    window.deleteRow = function(row, serviceId) {
        // Directly remove the row passed to the function
        row.remove();

        // Remove the service ID from the array
        serviceIds = serviceIds.filter(id => id != serviceId);

        // Update the hidden input value with the updated array of service IDs
        document.getElementById('serviceIdsInput').value = serviceIds.join(',');
    }
});
</script>



