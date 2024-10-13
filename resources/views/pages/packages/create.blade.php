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
                                <form id="services" action="{{ route('package.store') }}" method="POST" id="typeValidation">
                                @csrf <!-- Add CSRF token field -->
                                <input type="hidden" name="service_ids[]" id="serviceIdsInput" value="">
                                    <div class="grid xl:grid-cols-1" style="padding:0%">
                                        <div class="card">
                                            <div class="card-body flex flex-col p-6">
                                                <div class="card-text h-full">

                                                    <div class="input-area p-2"> 
                                                        <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-5 gap-3">
                                                            
                                                            <div class="input-area p-2">
                                                                    <label  class="form-label">Package Name</label>
                                                                    <input name="name" type="text" class="form-control" placeholder="Enter Package Name">
                                                            </div>

                                                            <div class="input-area p-2">
                                                                <label  class="form-label">Ammount</label>
                                                                <input name="amount" type="number" class="form-control"  placeholder="Enter Ammount">
                                                            </div>

                                                            <div class="input-area p-2">
                                                                <label  class="form-label">Hours</label>
                                                                <input name="hours" type="number" class="form-control"  placeholder="Enter Hours">
                                                            </div>

                                                            <div class="input-area p-2"> 
                                                                <label  class="form-label">Total Persons</label>
                                                                <input  name="persons" type="number" class="form-control" placeholder="Total Persons">
                                                            </div>

                                                            <div class="input-area p-2"> 
                                                                <label  class="form-label">Image</label>
                                                                <input  name="upload" type="file" class="form-control" placeholder="Enter type of services">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="input-area p-2"> 
                                                        <label class="form-label">Description</label>
                                                        <textarea name="description" rows="3" class="form-control" placeholder="Your Message"></textarea>
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
                                                                        <!-- This is where the data will be appended -->
                                                                    </tbody>
                                                                </table>
                                                                </div>
                                                            </div>
                                                    </div>



                                                    <button class="btn flex justify-center btn-dark float-right">Submit</button>
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
$(document).on('submit', '#services', function(event) { // Replace '#yourFormId' with your form's actual ID
    event.preventDefault(); // Prevent the default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save this package?",
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
                url: '{{ route("package.store") }}', // Adjust the route
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
                        'An error occurred while saving the package.',
                        'error'
                    );
                    console.error(error);
                }
            });
        }
    });
});

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

    // Always add the service ID to the array, allowing duplicates
    serviceIds.push(serviceId);

    // Create a new row
    const newRow = document.createElement("tr");

    // Populate the row with the service details and add a delete button
    newRow.innerHTML = `
        <td class="table-td">${title}</td>
        <td class="table-td">${amount}</td>
        <td class="table-td">${duration}</td>
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
}

    function deleteRow(row, serviceId) {
    // Directly remove the row passed to the function
    row.remove();

    // Remove the service ID from the array
    serviceIds = serviceIds.filter(id => id != serviceId);

    // Update the hidden input value with the updated array of service IDs
    document.getElementById('serviceIdsInput').value = serviceIds.join(',');
}
</script>