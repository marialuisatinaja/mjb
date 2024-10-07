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
                        <div class="card-title text-slate-900 dark:text-white">Package Information</div>
                    </div>
                </header>

                  <div class="input-area p-2"> 
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-7">

                            <div class="input-area p-2">
                     
                                <div class="inline-block min-w-full align-middle">
                                    <div class="overflow-hidden">
                                    <label  class="form-label">Services</label>
                                    <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                                        <thead class="bg-slate-200 dark:bg-slate-700">
                                            <tr>
                                                <th scope="col" class="table-th">Title</th>
                                                <th scope="col" class="table-th">Type</th>
                                                <th scope="col" class="table-th">Amount</th>
                                                <th scope="col" class="table-th">Duration</th>
                                                <th scope="col" class="table-th">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                            @foreach($services as $service)
                                            <tr>
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
                                                <td class="table-td">{{ $service->hours }}:{{ $service->minutes ?? '00' }}</td>
                                                <td class="table-td">
                                                    <div class="flex space-x-3 rtl:space-x-reverse">
                                                        <button class="action-btn" type="button" onclick="putServices('{{ $service->id }}','{{ $service->title }}', '{{ $service->amount }}', '{{ $service->hours }}:{{ $service->minutes }}')" title="Preview">
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

                            <div class="input-area p-2">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-7">
                                    <div class="input-area p-2">
                                    </div>
                                    <div class="input-area p-2">
                                        <!-- <img src=" {{ asset('admin/assets/images/all-img/thumb-1.png') }}" class="rounded-md border-4 border-slate-100 float-right" alt="image"> -->
                                    </div>
                                </div>
                                <form id="services" action="{{ route('package.update', $packages->id) }}" method="POST" id="typeValidation">
                                @csrf
                                @method('PUT')
                                @csrf <!-- Add CSRF token field -->

                                <input type="hidden" name="service_ids[]" id="serviceIdsInput" value="">
                                    <div class="grid xl:grid-cols-1" style="padding:0%">
                                        <div class="card">
                                            <div class="card-body flex flex-col p-6">
                                                <div class="card-text h-full">

                                                    <div class="input-area p-2"> 
                                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-7">
                                                            
                                                            <div class="input-area p-2">
                                                            <label  class="form-label">Package Name</label>
                                                                <div class="grid grid-cols-2 gap-4">
                                                                    <input name="name" value="{{ $packages->name }}" type="text" class="form-control" placeholder="Enter Package Name">
                                                                    <input name="amount" value="{{ $packages->amount }}" type="number" class="form-control"  placeholder="Enter Ammount">
                                                                </div>
                                                            </div>

                                                            <div class="input-area p-2"> 
                                                                <label  class="form-label">Image</label>
                                                                <input  name="upload" type="file" class="form-control" placeholder="Enter type of services">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-area p-2"> 
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" rows="3" class="form-control" placeholder="Your Message">{{ $packages->description }}</textarea>
                                                    </div>

                                                    <div class="input-area p-2"> 
                                                            <div class="inline-block min-w-full align-middle">
                                                                <div class="overflow-hidden">
                                                                <table id="serviceTable" class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                                                    <thead class="bg-slate-200 dark:bg-slate-700">
                                                                        <tr>
                                                                            <th scope="col" class="table-th">Title</th>
                                                                            <th scope="col" class="table-th">Amount</th>
                                                                            <th scope="col" class="table-th">Duration</th>
                                                                            <th scope="col" class="table-th">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                                                        @foreach($svs as $row)
                                                                        <tr id="row-{{ $row->id }}">
                                                                            <td class="table-td">{{ $row->services->title }}</td>
                                                                            <td class="table-td">{{ $row->services->amount }}</td>
                                                                            <td class="table-td">{{ $row->services->hours }}:{{ $row->services->minutes ?? '00' }}</td>
                                                                            <td class="table-td">
                                                                                <button class="action-btn" type="button" onclick="delete_service({{ $row->id }})">
                                                                                    <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                    </div>



                                                    <button class="btn flex justify-center btn-dark float-right">Update</button>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                  </div>

              </div>
              
          </div>
      </div>
  </div>




</x-app-layout>
<script>
$(document).on('submit', '#services', function(event) {
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
            const serviceId = "{{ $packages->id }}"; // Get the service id

            $.ajax({
                url: '{{ url("package/update") }}/' + serviceId, // Append the service id to the URL
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
                        window.location.href = response.redirectUrl; // Ensure your backend sends this URL
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

function delete_service(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this service?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{ route("package.delServe") }}', // Adjust the route
                method: 'POST',
                data: { id: id },  // Pass the service ID as data
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        'The service has been deleted successfully.',
                        'success'
                    ).then(() => {
                        // Now this will work, as each row has a unique id
                        $('#row-' + id).remove(); // Ensure your row has an ID like 'row-1', etc.
                    });
                },
                error: function(error) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the service.',
                        'error'
                    );
                    console.error(error);
                }
            });
        }
    });
}



    function put_services(id)
    {
        $.ajax({
            type: "POST",
            url: '{{ route("package.data") }}', // Adjust the route
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: {
                    id: id,
                    },
            success: function(data) {
                // $(".intern-profile").show().html(data);
            }
        });
    }

 // Array to store service IDs
    let serviceIds = [];

    function putServices(serviceId, title, amount, duration) {
        // Get the second table's body
        const tableBody = document.querySelector("#serviceTable tbody");

        // Check if the service is already added
        // if (!serviceIds.includes(serviceId)) {
            // Add the service ID to the array
            serviceIds.push(serviceId);

            // Create a new row
            const newRow = document.createElement("tr");

            // Create a unique identifier for the row to facilitate deletion
            const uniqueId = 'row-' + serviceId;

            // Populate the row with the service details and add a delete button
            newRow.innerHTML = `
                <td class="table-td">${title}</td>
                <td class="table-td">${amount}</td>
                <td class="table-td">${duration}</td>
                <td class="table-td">
                    <button class="action-btn delete-btn" type="button" onclick="deleteRow('${uniqueId}', '${serviceId}')">
                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                    </button>
                </td>
            `;

            // Assign a unique ID to the row for deletion purposes
            newRow.id = uniqueId;

            // Append the new row to the table body
            tableBody.appendChild(newRow);

            // Update the hidden input value with the array of service IDs
            document.getElementById('serviceIdsInput').value = serviceIds.join(',');
        // } else {
        //     alert('Service already added');
        // }
    }

    function deleteRow(rowId, serviceId) {
    // Show SweetAlert confirmation dialog
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to delete this service?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, keep it'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirmed "Yes"
            
            // Find the row by its ID and remove it
            const row = document.getElementById(rowId);
            row.remove();

            // Remove the service ID from the array
            serviceIds = serviceIds.filter(id => id != serviceId);

            // Update the hidden input value with the updated array of service IDs
            document.getElementById('serviceIdsInput').value = serviceIds.join(',');

            // Optionally show a success message after deletion
            Swal.fire(
                'Deleted!',
                'The service has been removed.',
                'success'
            );
        }
    });
}


</script>