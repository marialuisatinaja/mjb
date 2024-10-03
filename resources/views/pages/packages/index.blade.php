<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Packages') }}
    </h2>
</x-slot>
<div class="space-y-5">
    <div class="card">
        <header class="card-header noborder">
        </header>
        <div class="card-body px-6 pb-6">
            <!-- Add Button -->
            <div class="mb-4 flex items-center justify-between">
                <h4 class="card-title">Packages</h4>
                <a href="" class="btn inline-flex justify-center btn-dark dark:bg-slate-800">
                    <span class="flex items-center">
                        <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                        <span>Add Package</span>
                    </span>
                </a>
            </div>

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
                                    <th scope="col" class="table-th">Description</th>
                                    <th scope="col" class="table-th">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<script>
    function delete_service(id)
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
                        url: '{{ route("service.delete") }}', // Adjust the route
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
</script>
</x-app-layout>