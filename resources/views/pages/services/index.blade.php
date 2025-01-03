<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Services') }}
    </h2>
</x-slot>
<div class="space-y-5">
    <div class="card">
        <header class="card-header noborder">
        </header>
        <div class="card-body px-6 pb-6">
            <!-- Add Button -->
            <div class="mb-4 flex items-center justify-between">
                <h4 class="card-title">Services</h4>
                <a href="{{ route('service.create') }}" class="btn inline-flex justify-center btn-dark dark:bg-slate-800">
                    <span class="flex items-center">
                        <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                        <span>Add Services</span>
                    </span>
                </a>
            </div>
            <div id="error-messages"></div>
            <div id="success-message" style="display: none"></div>
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
                                    <td class="table-td">₱ {{ $service->amount }}</td>
                                    <td class="table-td text-wrap" style="width: 35%;">{{ $service->description }}</td>
                                    
                                    <td class="table-td">@if (!empty($service->hours) && !empty($service->minutes))
                                        {{ $service->hours }} hrs {{ $service->minutes }} mins
                                        @elseif (!empty($service->hours))
                                            {{ $service->hours }} hrs
                                        @elseif (!empty($service->minutes))
                                            {{ $service->minutes }} mins
                                        @else
                                            00:00 hrs
                                        @endif
                                    </td>

                                    <td class="table-td">
                                        <div class="flex space-x-3 rtl:space-x-reverse">
                                        <a href="{{ route('service.edit', ['id' => $service->id]) }}" class="action-btn">
                                            <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                        </a>

                                            <button class="action-btn" type="button" onclick="delete_service({{ $service->id }})">
                                                <iconify-icon icon="heroicons:trash"></iconify-icon>
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