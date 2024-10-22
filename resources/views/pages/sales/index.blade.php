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
                <h4 class="card-title">Sales</h4>
            </div>

            <div class="overflow-x-auto -mx-6 dashcode-data-table">
            
            <form method="GET" action="{{ route('sale.index') }}" class="flex space-x-4 mb-4 pl-4">
                <!-- Start Date Calendar -->
                <div class="flex flex-col">
                    <label for="start_date" class="text-sm text-slate-600 dark:text-slate-300">Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control py-2" value="{{ request()->get('start_date') }}">
                </div>
                <!-- End Date Calendar -->
                <div class="flex flex-col">
                    <label for="end_date" class="text-sm text-slate-600 dark:text-slate-300">End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control py-2" value="{{ request()->get('end_date') }}">
                </div>

                <div class="flex flex-col">
                    <label for="type" class="text-sm text-slate-600 dark:text-slate-300">Type</label>
                    <select name="type" id="type" class="form-control py-2">
                        <option value="" selected>All</option>
                        <option value="walkin" {{ request()->get('type') == 'walkin' ? 'selected' : '' }}>Walk-in</option>
                        <option value="reserved" {{ request()->get('type') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex flex-col justify-end">
                    <button type="submit" class="btn inline-flex justify-center btn-dark dark:bg-slate-800">Filter</button>
                </div>

                <div class="flex flex-col justify-end">
                    <button type="submit" class="btn inline-flex justify-center btn-dark dark:bg-slate-800" onclick="pdf_form()"> <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2" icon="heroicons-outline:printer"></iconify-icon>Print</button>
                </div>

                

            </form>

                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700 data-table">
                            <thead class="bg-slate-200 dark:bg-slate-700">
                                <tr>
                                <th scope="col" class="table-th"  style="width:15%;">Customer Name</th>
                                    <th scope="col" class="table-th"  style="width:12%;">Email</th>
                                    <th scope="col" class="table-th"  style="width:10%;">Type</th>
                                    <th scope="col" class="table-th"  style="width:15%;">Service Name</th>
                                    <th scope="col" class="table-th"  style="width:10%;">Date</th>
                                    <th scope="col" class="table-th"  style="width:10%;">Time</th>
                                    <th scope="col" class="table-th"  style="width:8%;">Payment</th>
                                    <th scope="col" class="table-th"  style="width:10%;">Status</th>
                                    <th scope="col" class="table-th"  style="width:10%;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                @foreach($reservations as $row)
                                <tr>
                                    <td class="table-td">{{ ucwords($row->first_name.' '.$row->middle_name.' '.$row->last_name) }} <br> Tel. : {{ $row->phone}} </td>
                                    <td class="table-td" style="text-transform: lowercase;">{{ $row->email }}</td>

                                    <td>
                                        @if($row->service_type == 'walkin')

                                        <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-black-500
                                                    bg-info-500">
                                        Walkin
                                      </div>

                                        @else
                                        
                                        <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-black-500
                                                    bg-info-500">
                                        Reservations
                                      </div>

                                        @endif
                                        <!-- {{ $row->service_type }} -->
                                    </td>
                                    <td class="table-td">
                                        <span class="flex">
                                            @if(@$row->service_type == 'services')
                                            <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                                @if(@$row->services->upload)
                                                <img src="{{ asset($row->services->upload) }}" alt="{{ $row->services->title }}" class="img-radius wid-40 align-top m-r-15">
                                                @else
                                                <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                                @endif
                                            </span>
                                            @else
                                            <span class="w-7 h-7 rounded-full ltr:mr-3 rtl:ml-3 flex-none">
                                                @if(@$row->package->upload)
                                                <img src="{{ asset($row->package->upload) }}" alt="{{ $row->package->title }}" class="img-radius wid-40 align-top m-r-15">
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
                                    
                                    <td  class="table-td">{{ date('F j, Y', strtotime($row->date)) }}</td>
                                    <td class="table-td">{{ \Carbon\Carbon::parse($row->time)->format('g:i A') }}</td>
                                    <td  class="table-td">
                                        @if(@$row->service_type == 'services')
                                            <div class=" text-danger-500">
                                            ₱ {{ number_format((@$row->services->amount * $row->total_person), 2, '.', ',') }}
                                            </div>
                                        @else
                                        <div class=" text-danger-500">
                                            ₱ {{ number_format((@$row->package->amount ), 2, '.', ',') }}
                                            </div>
                                        @endif
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
                                      @elseif($row->status == 'Resched')
                                    <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500
                                                    bg-warning-500">
                                        Resched
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
                                            <button class="action-btn" type="button" onclick="get_details({{ $row->id }}, '{{ $row->email }}', 'Paid')" title="Pay">
                                                <iconify-icon icon="heroicons-outline:view-grid-add"></iconify-icon>
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
    <div class="modal-dialog modal-xl relative w-auto pointer-events-none">
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
                        
                </div>
          
                <!-- Modal footer -->
           
            </div>
        </div>
    </div>
</div>

<script>
    const appUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');
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

    function get_details(id, email, status) {
    // Show the modal
    $('#large_modal').modal('show');
        // Make an AJAX request
        $.ajax({
            type: "POST",
            url: '{{ route("reservation.edit_details") }}', // Adjust the route
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token from meta tag
            },
            data: {
                id: id,         // Send the ID
                status: status, // Send the status
                email: email    // Send the email
            },
            success: function(data) {
                // Update modal body with the response data
                $(".body-details").show().html(data);
            }
        });
    }



    function pdf_form() {
        // Get values from form inputs
        var type = document.getElementById('type').value;
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        // Construct the URL with query parameters for type, start_date, and end_date
        var url = appUrl + "/print/pdfrequest/" + "?type=" + type + "&start_date=" + startDate + "&end_date=" + endDate;
 
        // Open the URL in a new window
        window.open(url, '_blank');
    }


</script>
</x-app-layout>