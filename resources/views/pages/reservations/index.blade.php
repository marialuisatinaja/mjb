<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Reservations') }}
    </h2>
</x-slot>
<div class="space-y-5">
    <div class="card">
        <header class="card-header noborder">
        </header>
        <div class="card-body px-6 pb-6">
            <!-- Add Button -->
            <div class="mb-4 flex items-center justify-between">
                <h4 class="card-title">Reservations</h4>
                <a href="" class="btn inline-flex justify-center btn-dark dark:bg-slate-800">
                    <span class="flex items-center">
                        <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="ph:plus-bold"></iconify-icon>
                        <span>Add Reservation</span>
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
                                    <th scope="col" class="table-th">Name</th>
                                    <th scope="col" class="table-th">Services</th>
                                    <th scope="col" class="table-th">Services Type</th>
                                    <th scope="col" class="table-th">Services Amount</th>
                                    <th scope="col" class="table-th">Reserved Type</th>
                                    <th scope="col" class="table-th text-center">No. of Person</th>
                                    <th scope="col" class="table-th">Payment</th>
                                    <th scope="col" class="table-th">Status</th>
                                    <th scope="col" class="table-th">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                            @foreach($reservations as $row)
                                <tr>
                                    <td class="table-td">{{ $loop->iteration }}</td>
                                    <td class="table-td">{{ ucwords($row->first_name.' '.$row->middle_name.' '.$row->last_name) }}</td>
                                    <td class="table-td">
                                        <span class="flex">
                                            <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                       
                                                @if($row->services->upload)
                                                <img src="{{ asset($row->services->upload) }}" alt="{{ $row->services->title }}" class="img-radius wid-40 align-top m-r-15">
                                                @else
                                                <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                                @endif

                                            </span>
                                            <span class="text-sm text-slate-600 dark:text-slate-300 capitalize pt-2">{{ $row->services->title }}</span>
                                        </span>
                                    </td>
                                    <td class="table-td"> {{ $row->service_type }}</td>
                                    <td  class="table-td text-success-500">
                                        <div class=" text-success-500">
                                        ₱ {{ number_format($row->services->amount, 2, '.', ',') }}
                                        </div>
                                    </td>
                              
                                    <td  class="table-td">{{ $row->type }}</td>
                                    <td  class="table-td">{{ $row->total_person }}</td>
                                    <td  class="table-td">
                                        <div class=" text-danger-500">
                                        ₱ {{ number_format(($row->services->amount * $row->total_person), 2, '.', ',') }}
                                        </div>
                                    </td>
                                    <td  class="table-td">
                                    @if($row->status == 'Pending')
                                        <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500 bg-warning-500">
                                            Pending
                                        </div>
                                    @elseif($row->status == 'Paid')
                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-success-500
                                                    bg-success-500">
                                        paid
                                      </div>
                                    @else
                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-danger-500
                                                    bg-danger-500">
                                        cancled
                                      </div>
                                    @endif

                                    </td>
                                    <td class="table-td">
                                        <div class="flex space-x-3 rtl:space-x-reverse">

                                            <button class="action-btn" type="button" onclick="delete_service({{ $row->id }})" title="Resched">
                                                <iconify-icon icon="heroicons:calendar"></iconify-icon>
                                            </button>

                                            <button class="action-btn" type="button" onclick="delete_service({{ $row->id }})" title="Pay">
                                                <iconify-icon icon="heroicons:printer"></iconify-icon>
                                            </button>

                                            <button class="action-btn" type="button" onclick="delete_service({{ $row->id }})" title="Cancelled">
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