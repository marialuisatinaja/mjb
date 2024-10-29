
<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Create') }}
    </h2>
</x-slot>

<div class="grid xl:grid-cols-1" style="padding:0%">
      <div class="card">
          <div class="card-body flex flex-col p-6">
              <div class="card-text h-full">

                <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                    <div class="flex-1">
                        <div class="card-title text-slate-900 dark:text-white">Walk-In Information</div>
                    </div>
                </header>
                <div class="grid grid-cols-12 gap-5">
                <div class="lg:col-span-7 col-span-12">
                    <div class="card">
                    <div class="card-body p-6">
                        <div class="overflow-x-auto -mx-6">
                        <div class="inline-block min-w-full align-middle">
                            <div class="overflow-hidden ">
                            <div class="card">
                                <div class="card-body flex flex-col p-6">
                                    <div class="card-text h-full">

                                            <div class="card-text h-full">
                                                <div>
                                                    <ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                        <a href="#tabs-home-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent active dark:text-slate-300" id="tabs-home-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-home-withIcon" role="tab" aria-controls="tabs-home-withIcon" aria-selected="true">
                                                            <iconify-icon class="mr-1" icon="heroicons-outline:home"></iconify-icon>
                                                            Service</a>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                        <a href="#tabs-profile-withIcon" class="nav-link w-full flex items-center font-medium text-sm font-Inter leading-tight capitalize border-x-0 border-t-0 border-b border-transparent px-4 pb-2 my-2 hover:border-transparent focus:border-transparent dark:text-slate-300" id="tabs-profile-withIcon-tab" data-bs-toggle="pill" data-bs-target="#tabs-profile-withIcon" role="tab" aria-controls="tabs-profile-withIcon" aria-selected="false">
                                                            <iconify-icon class="mr-1" icon="heroicons-outline:user"></iconify-icon>
                                                            Package</a>
                                                        </li>
                                                    </ul>
                                                        <div class="tab-content" id="tabs-tabContent">
                                                            <div class="tab-pane fade show active" id="tabs-home-withIcon" role="tabpanel" aria-labelledby="tabs-home-withIcon-tab">
                                                                <div class="overflow-x-auto -mx-6 dashcode-data-table">
                                                                    <span class="col-span-8 hidden"></span>
                                                                    <span class="col-span-4 hidden"></span>
                                                                    <div class="inline-block min-w-full align-middle">
                                                                        <div class="overflow-hidden">
                                                                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                                                                <thead class="bg-slate-200 dark:bg-slate-700">
                                                                                    <tr>
                                                                                        <th scope="col" class="table-th">Id</th>
                                                                                        <th scope="col" class="table-th">Title</th>
                                                                                        <th scope="col" class="table-th">Type</th>
                                                                                        <th scope="col" class="table-th">Ammount</th>
                                                                                        <th scope="col" class="table-th">Duration</th>
                                                                                        <th scope="col" class="table-th">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                                                @foreach($services as $service)
                                                                                    <tr>
                                                                                        <td class="table-td">{{ $loop->iteration }}</td>
                                                                                        <td class="table-td">
                                                                                            <span class="flex">
                                                                                                <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                                                                        
                                                                                                    @if($service->upload)
                                                                                                    <img src="{{ asset($service->upload) }}" alt="{{ $service->title }}" class="img-radius wid-40 align-top m-r-15">
                                                                                                    @else
                                                                                                    <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                                                                                    @endif

                                                                                                </span>
                                                                                                <span class="text-sm text-slate-600 dark:text-slate-300 capitalize pt-2">{{ $service->title }}</span>
                                                                                            </span>
                                                                                        </td>

                                                                                        <td class="table-td">{{ $service->type }}</td>
                                                                                        <td class="table-td">{{ $service->amount }}</td>
                                                                                        <td class="table-td">{{ $service->hours }}:{{ $service->minutes }}</td>
                                                                                        <td class="table-td">
                                                                                            <div class="flex space-x-3 rtl:space-x-reverse">
                                                                                                <button class="action-btn" type="button" onclick="putServices('{{ $service->id }}','{{ $service->title }}', '{{ $service->amount }}', 'services')" title="Preview">
                                                                                                    <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                                                                </button>
                                                                                            </div>
                                                                                        </td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="tabs-profile-withIcon" role="tabpanel" aria-labelledby="tabs-profile-withIcon-tab">
                                                                <div class="overflow-x-auto -mx-6 dashcode-data-table">
                                                                    <span class="col-span-8 hidden"></span>
                                                                    <span class="col-span-4 hidden"></span>
                                                                    <div class="inline-block min-w-full align-middle">
                                                                        <div class="overflow-hidden">
                                                                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                                                                <thead class="bg-slate-200 dark:bg-slate-700">
                                                                                    <tr>
                                                                                        <th scope="col" class="table-th">Id</th>
                                                                                        <th scope="col" class="table-th"> Name</th>
                                                                                        <th scope="col" class="table-th">Ammount</th>
                                                                                        <th scope="col" class="table-th">Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                                                @foreach($packages as $package)
                                                                                <tr>
                                                                                    <td class="table-td">{{ $loop->iteration }}</td>
                                                                                    <td class="table-td">
                                                                                        <span class="flex">
                                                                                            <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                                                                        
                                                                                                @if($package->upload)
                                                                                                <img src="{{ asset($package->upload) }}" alt="{{ $package->title }}" class="img-radius wid-40 align-top m-r-15">
                                                                                                @else
                                                                                                <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                                                                                @endif

                                                                                            </span>
                                                                                            <span class="text-sm text-slate-600 dark:text-slate-300 capitalize pt-2">{{ $package->name }}</span>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td class="table-td">{{ $package->amount }}</td>
                                                                                    <td class="table-td">
                                                                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                                                                            <button class="action-btn" type="button" onclick="putServices('{{ $package->id }}','{{ $package->name }}', '{{ $package->amount }}', 'package')" title="Preview">
                                                                                                <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                                                            </button>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                        </div>
                        <!-- END: Company Table -->
                    </div>
                    
                </div>
                
                    <div class="lg:col-span-5 col-span-12">
                    <div class="card">
                        <div class="card-header ">
                        <h4 class="card-title">Details</h4>
                        <div id="totalAmount">Total: 0.00</div>
                        </div>
                        <div class="card-body p-6">
                        <table id="serviceTable" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                <thead class="bg-slate-200 dark:bg-slate-700">
                                    <tr>
                                        <th scope="col" class="table-th">Title</th>
                                        <th scope="col" class="table-th">Amount</th>
                                        <th scope="col" class="table-th">Type</th>
                                        <th scope="col" class="table-th">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    <!-- This is where the data will be appended -->
                                </tbody>
                            </table>
                        </div>
                    <form action="{{ route('service.userWalkin') }}" method="post"  id="user">
                    <input type="hidden" name="service_ids[]" id="serviceIdsInput" value="">
                    <input type="hidden" name="service_type[]" id="ReservationType" value="">
                    <input type="hidden" name="payment_total" id="payment_total" value="">
                        <div class="grid grid-cols-12 gap-5 p-1">

                                <div class="lg:col-span-4 col-span-12 p-1">
                                <label>First Name</label>
                                <input class="form-control" type="text" name="first_name" required>
                                </div>

                                <div class="lg:col-span-4 col-span-12 p-1">
                                <label>Middle Name</label>
                                <input class="form-control" type="text" name="middle_name" required>
                                </div>

                                <div class="lg:col-span-4 col-span-12 p-1">
                                <label>Last Name</label>
                                <input class="form-control" type="text" name="last_name" required>
                                </div>

                        </div>

                        <div class="grid grid-cols-12 gap-5 p-1">

                        <div class="lg:col-span-4 col-span-12 p-1">
                        <label>Phone</label>
                        <input class="form-control" type="text" name="phone"  required>
                        </div>

                        <div class="lg:col-span-4 col-span-12 p-1">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email"  required>
                        </div>
                        </div>

                        <!-- <div class="grid grid-cols-12 gap-3 p-2">
                            <div class="lg:col-span-4 col-span-12 ">

                                <div id="self" class="container">
                                    <label>Select service type</label>
                                    <select name="type" class="form-control" required onchange="toggleGroupFields()">
                                        <option value="" disabled selected>Select Type</option>
                                        <option value="self">Self</option>
                                        <option value="group">Group</option>
                                    </select>
                                </div>

                            </div>
                
                            <div class="lg:col-span-4 col-span-12">
                            <div id="therapist-select" class="col-md-4">
                            <label>Select preffered therapist</label>
                                <select name="therapist_gender" class="form-control">
                                    <option value="" disabled selected>Preffered Therapist</option>
                                    <option value="girl">Girl</option>
                                    <option value="boy">Boy</option>
                                </select>
                            </div>
                            </div>
                            <div class="lg:col-span-4 col-span-12">
                            
                            </div>
                        </div> -->

                        <div class="grid grid-cols-12 gap-5 p-2">
                            <div class="lg:col-span-4 col-span-12">
                                <label>Select service type</label>
                                <select name="type" class="form-control" required onchange="toggleGroupFields()">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="self">Self</option>
                                    <option value="group">Group</option>
                                </select>
                            </div>

                            <div class="lg:col-span-4 col-span-12"  id="therapist-select">
                            <label>Select preffered therapist</label>
                                <select name="therapist_gender" class="form-control">
                                    <option value="" disabled selected>Preffered Therapist</option>
                                    <option value="girl">Girl</option>
                                    <option value="boy">Boy</option>
                                </select>
                            </div>
                    
                        </div>

                        <div id="group" style="display: none;" class="grid grid-cols-12 gap-5 p-2">
                            <div class="lg:col-span-4 col-span-12">
                            <label>Total Person</label>
                            <input type="number" class="form-control" name="total_person" placeholder="Total Person">
                            </div>

                            <div class="lg:col-span-4 col-span-12">
                            <label>Total Person</label>
                            <input type="number" class="form-control" name="boy_therapist" placeholder="Boy Therapist">
                            </div>

                            <div class="lg:col-span-4 col-span-12">
                            <label>Total Person</label>
                            <input type="number" class="form-control" name="girl_therapist" placeholder="Girl Therapist">
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-5  p-2">
                            <div class="lg:col-span-4 col-span-12">
                            <label for="humanFriendly_picker">Date</label>
                            <input class="form-control py-2 flatpickr flatpickr-input active" id="humanFriendly_picker" value="" type="text" name="date" readonly="readonly" required min="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                            </div>

                            <div class="lg:col-span-4 col-span-12">
                                <small for="time" class="form-label">Business Hours 11:00 am to 11:00 pm</small>
                                <input type="time" id="time" name="time" class="form-control" min="11:00" max="23:00" value="11:00" required>
                            </div>

                            <div class="lg:col-span-4 col-span-12">
                            </div>
                        </div>
                        
                        <div class="p-5">
                        <button class="btn flex justify-left btn-dark ml-auto">Submit</button>
                        </div>
                    </form>
                    </div>
                    </div>

                </div>


                </div>
              </div>
          </div>
      </div>
</div>

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="large_modal" tabindex="-1" aria-labelledby="large_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
        rounded-md outline-none text-current">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
            <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                    <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                    Walk In Details
                    </h3>
                    <button type="button" class="text-slate-400 bg-transparent hover:text-slate-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center
                        dark:hover:bg-slate-600 dark:hover:text-white" data-bs-dismiss="modal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="#ffffff" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10
                                11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
            
                <div class="p-6 body-details">
                        
                </div>
          
                <!-- Modal footer -->
           
            </div>
        </div>
    </div>
</div>

<script>

    function get_details(id)
    {

      $('#large_modal').modal('show');
      $.ajax({
            type: "POST",
            url: '{{ route("point.details") }}', // Adjust the route
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

     function get_details_package(id)
    {
        $('#large_modal').modal('show');
        $.ajax({
            type: "POST",
            url: '{{ route("point.package") }}', // Adjust the route
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

    
document.addEventListener('DOMContentLoaded', function() {
          const userForm = document.getElementById('user'); // Replace with your actual form ID
      userForm.addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the default form submission

          const serviceIdsInput = document.getElementById('serviceIdsInput');

            if (!serviceIdsInput.value) {
                Swal.fire(
                    'Warning!!',
                    'Please select atleast 1 services or package.',
                    'warning'
                )
            } else {
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
                      url: '{{ route("service.userWalkin") }}', // Adjust the route
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
                              'An error occurred while saving the services.',
                              'error'
                          );
                          console.error(error);
                      }
                  });
              }
          });

            }

   

      });
  });

  document.addEventListener('DOMContentLoaded', function() {
    
    flatpickr("#humanFriendly_picker", {
            dateFormat: "Y-m-d",
            defaultDate: "{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}", // Set default to tomorrow
            minDate: "{{ \Carbon\Carbon::tomorrow()->format('Y-m-d') }}"       // Minimum selectable date is tomorrow
        });

    const totalPersonInput = document.querySelector('input[name="total_person"]');
    const boyTherapistInput = document.querySelector('input[name="boy_therapist"]');
    const girlTherapistInput = document.querySelector('input[name="girl_therapist"]');

    // Update boy and girl therapists based on total persons
    totalPersonInput.addEventListener('input', function() {

      const total = parseInt(this.value) || 0; // Get the total person input
      // Calculate the values for boy and girl therapists
      const boys = Math.floor(total / 2); // Half for boys
      const girls = Math.ceil(total / 2);  // Half for girls (rounded up)
  
      
      // Set the values in the inputs
      boyTherapistInput.value = boys;
      girlTherapistInput.value = girls;
   
    });
    // Adjust the number of girls based on boys input
    boyTherapistInput.addEventListener('input', function() {
      const total = parseInt(totalPersonInput.value) || 0;
      const boys = parseInt(this.value) || 0; // Get current boys input
      const girls = Math.max(0, total - boys); // Calculate girls as total - boys

      // Check if the total exceeds the limit
      if (boys + girls > total) {
        boyTherapistInput.value = Math.floor(total / 2);
        girlTherapistInput.value = Math.ceil(total / 2);
      } else {
        girlTherapistInput.value = girls; // Set the new girls value
      }
    });

    // Adjust the number of boys based on girls input
    girlTherapistInput.addEventListener('input', function() {
      const total = parseInt(totalPersonInput.value) || 0;
      const girls = parseInt(this.value) || 0; // Get current girls input
      const boys = Math.max(0, total - girls); // Calculate boys as total - girls

      // Check if the total exceeds the limit
      if (boys + girls > total) {
        boyTherapistInput.value = Math.floor(total / 2);
        girlTherapistInput.value = Math.ceil(total / 2);
      } else {
        boyTherapistInput.value = boys; // Set the new boys value
      }
    });

  });

let serviceIds = [];
let ReservationType = [];
let totalAmount = 0; // Initialize total amount

function putServices(serviceId, title, amount, duration) {
    // Get the second table's body
    const tableBody = document.querySelector("#serviceTable tbody");

    // Add the service ID to the array
    serviceIds.push(serviceId);

    ReservationType.push(duration);
    // Create a new row
    const newRow = document.createElement("tr");

    // Populate the row with the service details and a delete button
    newRow.innerHTML = `
        <td class="table-td">${title}</td>
        <td class="table-td">${amount}</td>
        <td class="table-td">${duration}</td>
        <td class="table-td">
            <button class="action-btn delete-btn" type="button" onclick="deleteRow(this.closest('tr'), '${serviceId}', ${amount})">
                <iconify-icon icon="heroicons:trash"></iconify-icon>
            </button>
        </td>
    `;

    // Append the new row to the table body
    tableBody.appendChild(newRow);

    // Update the total amount
    totalAmount += parseFloat(amount);
    updateTotalAmount(totalAmount);

    // Update the hidden input value with the array of service IDs
    document.getElementById('serviceIdsInput').value = serviceIds.join(',');
    document.getElementById('ReservationType').value = ReservationType.join(',');
}

function updateTotalAmount(totalAmount) {
    // Display the updated total amount
    document.getElementById('totalAmount').innerText = `Total: ${totalAmount.toFixed(2)}`;
    
    document.getElementById('payment_total').value = totalAmount;
    
}

function deleteRow(row, serviceId, amount) {
    // Parse amount to ensure it's a number
    amount = parseFloat(amount);

    // Remove the row from the table
    row.remove();
    totalAmount -= amount;
    document.getElementById('totalAmount').innerText = `Total: ${totalAmount.toFixed(2)}`;
    document.getElementById('payment_total').value = totalAmount;
    // Remove the service ID from the array
    serviceIds = serviceIds.filter(id => id !== serviceId);

    // Update the hidden input value with the array of service IDs
    document.getElementById('serviceIdsInput').value = serviceIds.join(',');
    // Subtract the amount of the deleted row from the total amount
    // updateTotalAmount;
}

function toggleGroupFields() {
    const selectType = document.querySelector('select[name="type"]');
    const groupFields = document.getElementById('group');
    const therapist_select = document.getElementById('therapist-select');
    // Show or hide the group fields based on the selected value
    if (selectType.value === 'group') {
        groupFields.style.display = ''; // Show group fields
        therapist_select.style.display = 'none'; // Hide group fields
    } else {
        groupFields.style.display = 'none'; // Hide group fields
        therapist_select.style.display = ''; // Hide group fields
    }
}

  const totalPersonInput = document.querySelector('input[name="total_person"]');
  const boyTherapistInput = document.querySelector('input[name="boy_therapist"]');
  const girlTherapistInput = document.querySelector('input[name="girl_therapist"]');

  // Update boy and girl therapists based on total persons
  totalPersonInput.addEventListener('input', function() {
    const total = parseInt(this.value) || 0; // Get the total person input
    // Calculate the values for boy and girl therapists
    const boys = Math.floor(total / 2); // Half for boys
    const girls = Math.ceil(total / 2);  // Half for girls (rounded up)

    // Set the values in the inputs
    boyTherapistInput.value = boys;
    girlTherapistInput.value = girls;
  });

  // Adjust the number of girls based on boys input
  boyTherapistInput.addEventListener('input', function() {
    const total = parseInt(totalPersonInput.value) || 0;
    const boys = parseInt(this.value) || 0; // Get current boys input
    const girls = Math.max(0, total - boys); // Calculate girls as total - boys

    // Check if the total exceeds the limit
    if (boys + girls > total) {
      boyTherapistInput.value = Math.floor(total / 2);
      girlTherapistInput.value = Math.ceil(total / 2);
    } else {
      girlTherapistInput.value = girls; // Set the new girls value
    }
  });

  // Adjust the number of boys based on girls input
  girlTherapistInput.addEventListener('input', function() {
    const total = parseInt(totalPersonInput.value) || 0;
    const girls = parseInt(this.value) || 0; // Get current girls input
    const boys = Math.max(0, total - girls); // Calculate boys as total - girls

    // Check if the total exceeds the limit
    if (boys + girls > total) {
      boyTherapistInput.value = Math.floor(total / 2);
      girlTherapistInput.value = Math.ceil(total / 2);
    } else {
      boyTherapistInput.value = boys; // Set the new boys value
    }
  });

</script>
</x-app-layout>