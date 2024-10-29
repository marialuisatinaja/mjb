<form id="services" action="{{ route('reservation.update_details', $reservation->id) }}" method="POST" id="typeValidation">
@csrf
@method('PUT')
<div class="card-text h-full">


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
                            <option value="Male" class="dark:bg-slate-700"  {{ $reservation->gender == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" class="dark:bg-slate-700"  {{ $reservation->gender == 'Female' ? 'selected' : '' }}>Female</option>
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
                        <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" readonly>
                        </div>

                        <div class="input-area p-2"> 
                        <label  class="form-label">Select a time:</label>
                        <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required readonly>
                        </div>

                        <div class="input-area p-2"> 
                        <label  class="form-label">Total Payment:</label>
                        <input type="text" name="payment_total" value="{{ $reservation->payment_total }}" class="form-control" required readonly>
                        </div>

                        <div class="lg:col-span-5 col-span-12 pt-2">
                            <table id="serviceTable" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                <thead class="bg-slate-200 dark:bg-slate-700">
                                    <tr>
                                        <th scope="col" class="table-th">Title</th>
                                        <th scope="col" class="table-th">Amount</th>
                                        <th scope="col" class="table-th">Type</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @foreach($details as $row)
                                    <tr>
                                        <td class="table-td">
                                            <span class="flex">
                                                @if(@$row->service_type == 'services')
                                                <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                                    @if(@$row->services->upload)
                                                    <img src="{{ asset(@$row->services->upload) }}" alt="{{ @$row->services->title }}" class="img-radius wid-40 align-top m-r-15">
                                                    @else
                                                    <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                                    @endif
                                                </span>
                                                @else
                                                <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                                    @if(@$row->package->upload)
                                                    <img src="{{ asset(@$row->package->upload) }}" alt="{{ @$row->package->title }}" class="img-radius wid-40 align-top m-r-15">
                                                    @else
                                                    <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                                    @endif
                                                </span>
                                                @endif

                                                @if(@$row->service_type == 'services')
                                                <span class="text-sm text-slate-600 dark:text-slate-300 capitalize pt-2">{{ @$row->services->title }}</span>
                                                @else
                                                <span class="text-sm text-slate-600 dark:text-slate-300 capitalize pt-2">{{ @$row->package->name }}</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td  class="table-td">
                                            @if(@$row->service_type == 'services')
                                                <div class=" text-danger-500">
                                                ₱ {{ number_format((@$row->services->amount ), 2, '.', ',') }}
                                                </div>
                                            @else
                                            <div class=" text-danger-500">
                                                ₱ {{ number_format((@$row->package->amount ), 2, '.', ',') }}
                                                </div>
                                            @endif
                                        </td>
                                        <td  class="table-td">{{ $row->service_type }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    @if(Auth::user()->user_type == 'Admin')
                        <div class="flex justify-between p-2">
                            <button type="button" class="btn inline-flex justify-center text-white bg-blue-500 hover:bg-blue-600" id="next-1" style="float: right;">
                                Served
                            </button>
                        </div>
                    @endif

                </div>

                    <div class="step hidden" id="step-2">
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
                                <option value="Male" class="dark:bg-slate-700"  {{ $reservation->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" class="dark:bg-slate-700"  {{ $reservation->gender == 'Female' ? 'selected' : '' }}>Female</option>
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
                            <input type="date" name="date" value="{{ $reservation->date }}"  class="form-control" placeholder="Your Date" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}" readonly>
                            </div>

                            <div class="input-area p-2"> 
                            <label  class="form-label">Select a time:</label>
                            <input type="time" id="time" name="time" value="{{ $reservation->time }}" class="form-control" min="09:00" max="18:00" required readonly>
                            </div>

                            <div class="input-area p-2"> 
                            <label  class="form-label">Total Payment:</label>
                            <input type="text" name="payment_total" value="{{ $reservation->payment_total }}" class="form-control" required readonly>
                            </div>

                            <div class="lg:col-span-5 col-span-12 pt-2">
                                <table id="serviceTable" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                    <thead class="bg-slate-200 dark:bg-slate-700">
                                        <tr>
                                            <th scope="col" class="table-th">Name</th>
                                            <th scope="col" class="table-th">Gender</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                        @foreach($users as $row)
                                        <tr>
                                            <td class="table-td">{{ ucwords($row->user->first_name . ' ' . $row->user->middle_name . ' ' . $row->user->last_name) }}</td>
                                            <td class="table-td">{{ $row->user->gender }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        

                        </div>

                        @if($reservation->status != 'Paid')
                        <div class="flex justify-between">
                            <button type="button" class="bg-gray-300 text-gray-700 p-2 rounded" id="prev-2">Previous</button>
                            <button type="button" class="btn inline-flex justify-center text-white bg-blue-500 hover:bg-blue-600" id="submit" style="float: right;">
                                Pay
                            </button>
                        </div> 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

<br>




</form>

<script>
$(document).ready(function() {
    let maxServices = {{ $reservation->total_person }};;
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
            let maxServices = {{ $reservation->total_person }};
        });
    }

    // Function to add services
    window.putServices = function(serviceId, fullname, gender) {
        const tableBody = document.querySelector("#serviceTable1 tbody");
        
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



