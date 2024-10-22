<form id="services" method="POST" id="typeValidation">
@csrf <!-- Add CSRF token field -->

<div class="card-text h-full">
    <div class="profiel-wrap px-[35px] pb-10 md:pt-[84px] pt-10 rounded-lg bg-white dark:bg-slate-800 lg:flex lg:space-y-0  space-y-6 justify-between items-end relative z-[1]">
        <div class="bg-slate-900 dark:bg-slate-700 absolute left-0 top-0 md:h-1/2 h-[150px] w-full z-[-1] rounded-t-lg" style="background-image: url({{ asset('assets/img/bg1.jpg') }});"></div>
            <div class="profile-box flex-none md:text-start text-center">
                <div class="md:flex items-end md:space-x-6 rtl:space-x-reverse">
                    <div class="flex-none">
                        <div class="md:h-[186px] md:w-[186px] h-[140px] w-[140px] md:ml-0 md:mr-0 ml-auto mr-auto md:mb-0 mb-4 rounded-full ring-4
                            ring-slate-100 relative">
                            @if($services->upload)

                            <img src="{{ asset($services->upload) }}" alt="{{ $services->title }}" class="w-full h-full object-cover rounded-full">
                            @else
                            <img src="http://mjb.test/assets/img/masonry-portfolio/masonry-portfolio-2.jpg" alt="" class="w-full h-full object-cover rounded-full">
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <div class="text-2xl font-medium text-slate-900 dark:text-slate-200 mb-[3px]">
                        {{ $services->name }}
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
                    ₱ {{ $services->amount }}
                    </div>
                    <div class="text-sm text-slate-600 font-light dark:text-slate-300">
                    Services Ammount
                    </div>
                </div>
            </div>
    </div>

    <div class="container mx-auto mt-2">
        <div class="bg-white shadow-md rounded-lg p-2">
            <div id="form-wizard">
                <div class="step" id="step-1">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-1">

                        <div class="input-area p-2">
                            <label  class="form-label">First Name</label>
                            <input  id="first_name" name="first_name" type="text"  class="form-control" placeholder="Enter First Name">
                        </div> 

                        <div class="input-area p-2"> 
                            <label  class="form-label">Middle Name</label>
                            <input  name="middle_name" type="text"class="form-control" placeholder="Enter Middle Name">
                        </div>

                        <div class="input-area p-2"> 
                            <label  class="form-label">Last Name</label>
                            <input  id="last_name" name="last_name" type="text"  class="form-control" placeholder="Enter Last Name">
                        </div>

                        <div class="input-area p-2">
                            <label  class="form-label">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male" class="dark:bg-slate-700"  >Male</option>
                                <option value="female" class="dark:bg-slate-700" >Female</option>
                            </select>
                        </div> 

                        <div class="input-area p-2"> 
                            <label  class="form-label">Email</label>
                            <input  name="email" id="email"  type="email" class="form-control" placeholder="Enter your Email" >
                        </div>

                        <div class="input-area p-2"> 
                            <label  class="form-label">Phone</label>
                            <input type="text" id="phone"  class="form-control" name="phone" placeholder="09512348350" required maxlength="12" >
                        </div>

                    </div>
                </div>


                <div class="flex justify-between p-2">
                    <button type="button" class="btn inline-flex justify-center text-white bg-blue-500 hover:bg-blue-600" id="next-1" style="float: right;">
                        Served
                    </button>
                </div>

                <div class="step hidden" id="step-2">

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
                            <input type="hidden" name="id_service"  value="{{ $services->id }}">
                            <input type="hidden" name="service_type"  value="services">
                            <input type="hidden" name="total_person"  value="{{ $services->persons }}">
                            
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

<script>
    $(document).ready(function() {

        let serviceIds = [];
        let maxServices = {{ $services->persons }}; // Declare maxServices inside the ready function

        $('select[name="type"]').on('change', function() {
            var selectedValue = $(this).val(); // Get the value of the selected option

                if (selectedValue === 'self') { // Check for 'self'
                    maxServices = 1; // maxServices is 1 for 'self'
                } else if (selectedValue === 'group') { // Check for 'group'
                    maxServices = $('#total_person').val(); // Get the value from the input field
                }

                    // Clear the service table
                const tableBody = document.querySelector("#serviceTable tbody");
                tableBody.innerHTML = ''; // Remove all rows

                // Reset the serviceIds array
                serviceIds = [];

                // Update the hidden input value to be empty
                document.getElementById('serviceIdsInput').value = '';
        });

        $('#total_person').on('input', function() {
            var totalPersonValue = $(this).val(); // Get the value from the input field
            maxServices = totalPersonValue;

            // Clear the service table
            const tableBody = document.querySelector("#serviceTable tbody");
            tableBody.innerHTML = ''; // Remove all rows

            // Reset the serviceIds array
            serviceIds = [];

            // Update the hidden input value to be empty
            document.getElementById('serviceIdsInput').value = '';
        });

        initializeSteps(); 

        function validateCurrentStep() {
            const inputs = steps[currentStep].querySelectorAll('input, textarea, select');
            for (const input of inputs) {
                if (input.required && !input.value) {
                    input.classList.add('error'); // Optionally, add an error class for visual feedback
                    return false; // Return false if any required field is empty
                } else {
                    input.classList.remove('error'); // Remove error class if field is filled
                }
            }
            return true; // Return true if all required fields are filled
        }

        function initializeSteps() {
            const steps = document.querySelectorAll('.step');
            let currentStep = 0;

            // Handle the next step button
            document.getElementById('next-1').onclick = function() {
                steps[currentStep].classList.add('hidden');
                currentStep++;
                steps[currentStep].classList.remove('hidden');
                
                // Hide the "Served" button after it's clicked
                this.style.display = 'none';
            };

            // Handle the previous step button
            document.getElementById('prev-2').onclick = function() {
                steps[currentStep].classList.add('hidden');
                currentStep--;
                steps[currentStep].classList.remove('hidden');
                
                // Show the "Served" button again when going back to the previous step
                document.getElementById('next-1').style.display = 'inline-flex';
            };

            // Submit button logic
            document.getElementById('submit').onclick = function() {
                const firstName = $('#first_name').val();
                const lastName = $('#last_name').val();
                const email = $('#email').val();
                const phone = $('#phone').val();

                    if (!firstName || !lastName || !email || !phone) {
                        Swal.fire(
                            'Error!',
                            'Complete all the details',
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
                                const serviceId = "{{ $services->id }}"; // Get the service id

                                $.ajax({
                                    url: '{{ url("point/store") }}', 
                                    method: 'POST',
                                    data: formData,serviceId,
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
                // Ensure the "Served" button is visible
                document.getElementById('next-1').style.display = 'inline-flex';
            }

            $('#large_modal').on('hidden.bs.modal', function() {
                resetSteps();
                serviceIds = []; // Reset the service IDs when the modal closes
                maxServices = 1; // Reset maxServices if needed
            });
        }

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

    function toggleGroupFields() {
      const selectType = document.querySelector('select[name="type"]');
      const groupFields = document.getElementById('group');
      const therapist_select = document.getElementById('therapist-select');
      // Show or hide the group fields based on the selected value
      if (selectType.value === 'group') {
          groupFields.style.display = 'grid'; // Show group fields
          therapist_select.style.display = 'none'; // Hide group fields
      } else {
          groupFields.style.display = 'none'; // Hide group fields
          therapist_select.style.display = 'block'; // Hide group fields
      }
    }


</script>

