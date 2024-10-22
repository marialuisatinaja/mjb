<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Sales') }}
    </h2>
</x-slot>
<div class="space-y-5">
    <div class="card">
        <header class="card-header noborder">
        </header>
        <div class="card-body px-6 pb-6">
            <!-- Add Button -->
            <div class="mb-4 flex items-center justify-between">
                <h4 class="card-title">Certificate</h4>
                <button class="btn inline-flex justify-center btn-dark dark:bg-slate-800" type="button" onclick="get_details()" title="Pay">
                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                <span>Add Certificate</span>
                </button>
        
            </div>

            <div class="overflow-x-auto -mx-6 dashcode-data-table">
                <span class="col-span-8 hidden"></span>
                <span class="col-span-4 hidden"></span>
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                            <thead class="bg-slate-200 dark:bg-slate-700">
                                <tr>
                                    <th scope="col" class="table-th">#</th>
                                    <th scope="col" class="table-th">Name</th>
                                    <th scope="col" class="table-th">Amenities</th>
                                    <th scope="col" class="table-th">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            @foreach($certificates as $certificate)
                            <tr>
                                <td class="table-td">{{ $loop->iteration}}</td>
                                <td class="table-td">{{ $certificate->name }}</td>
                                <td class="table-td">{{ $certificate->amenities }}</td>

                                <td class="table-td">

                                <div class="flex space-x-3 rtl:space-x-reverse">

                                    <button class="action-btn" type="button" onclick="delete_certificate({{ $certificate->id }})">
                                        <iconify-icon icon="heroicons:trash"></iconify-icon>
                                    </button>

                                    <button class="action-btn"  onclick="print_certificate({{ $certificate->id }})">
                                        <iconify-icon icon="heroicons:printer"></iconify-icon>
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

<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="large_modal" tabindex="-1" aria-labelledby="large_modal" aria-hidden="true">
<div class="modal-dialog relative w-auto pointer-events-none">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white bg-clip-padding
        rounded-md outline-none text-current">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-700">
            <!-- Modal header -->
                <div class="flex items-center justify-between p-5 border-b rounded-t dark:border-slate-600 bg-black-500">
                    <h3 class="text-xl font-medium text-white dark:text-white capitalize">
                    Reservation Details
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

                <div class="card">
                    <div class="card-body flex flex-col p-3">
                        <div class="card-text h-full">
                            <form class="space-y-4" id="loginForm" action="{{ route('user.store') }}" method="POST">
                                @csrf <!-- Add CSRF token field -->

                                <div class="input-area">
                                    <label class="form-label">Name</label>
                                    <div class="relative">
                                        <input id="name" type="text" name="name" class="form-control pr-9" placeholder="Please Enter Name" required>
                                    </div>
                                    <span id="nameErrorMsg" class="font-Inter text-sm text-danger-500 pt-2 hidden mt-1">This is valid Name.</span>
                                </div>

                                <div class="input-area">
                                    <label class="form-label">Amenities</label>
                                    <div class="relative">
                                        <input id="amenities" type="text" name="amenities" class="form-control" placeholder="Please Enter Amenities" required>
                                    </div>
                                </div>

                                <button class="btn flex justify-center btn-dark ml-auto" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                  </div>
          
                <!-- Modal footer -->
           
            </div>
        </div>
    </div>
</div>

<script>
const appUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to save this certificate?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, save it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById('loginForm');
            const formData = new FormData(form); // Collect form data
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Get CSRF token

            $.ajax({
                url: '{{ route("certificate.store") }}', // Adjust the route
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Include CSRF token
                },
                success: function(response) {
                    Swal.fire(
                        'Submitted!',
                        'Your form has been submitted.',
                        'success'
                    ).then(() => {
                        // Redirect to the provided URL
                        window.location.href = response.redirectUrl; // Make sure the backend returns this
                    });
                },
                error: function(error) {
                    Swal.fire(
                        'Error!',
                        'An error occurred while saving the certificate.',
                        'error'
                    );
                    console.error('Error:', error);
                }
            });
        }
    });
});



function print_certificate(id)
{   
    var win = window.open(appUrl + "/print/pdfcertificate/" + id, '_blank');
}

function delete_certificate(id)
{
    Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: '{{ route("certificate.delete") }}', // Adjust the route
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Ensure 'csrfToken' is defined and valid
                    },
                    data: {
                        id: id // Your data
                    }
                }).done(function(data) {
                    // Successful deletion
                    Swal.fire(
                        'Deleted!',
                        'The item has been deleted.',
                        'success'
                    ).then(() => {
                        // Optionally, remove the row from the table
                        window.location.reload();
                    });
                }).fail(function(xhr, status, error) {
                    // Handle error
                    Swal.fire(
                        'Error!',
                        'There was an error deleting the item.',
                        'error'
                    );
                    console.error('Error:', error);
                });
            } else {
                Swal.fire(
                    'Cancelled',
                    'The item was not deleted.',
                    'info'
                );
            }
        });
}

function get_details(id, email, status) {
    $('#large_modal').modal('show');
}


</script>
</x-app-layout>