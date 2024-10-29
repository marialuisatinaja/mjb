<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if(Auth::user()->user_type == 'Admin')
        <div>
          <div class="grid grid-cols-12 gap-5 mb-5">
            <div class="2xl:col-span-3 lg:col-span-4 col-span-12">
              <div class="bg-no-repeat bg-cover bg-center p-4 rounded-[6px] relative" style="background-image: url(assets/images/all-img/widget-bg-1.png)">
                <div class="max-w-[180px]">
                  <div class="text-xl font-medium text-slate-900 mb-2">
                  Hi, {{ Auth::user()->first_name }}
                  </div>
                </div>
              </div>
            </div>
            <div class="2xl:col-span-9 lg:col-span-8 col-span-12">
              <div class="p-4 card">
                <div class="grid md:grid-cols-3 col-span-1 gap-4">

                  <!-- BEGIN: Group Chart2 -->


                  <div class="py-[18px] px-4 rounded-[6px] bg-[#E5F9FF] dark:bg-slate-900	 ">
                    <div class="flex items-center space-x-6 rtl:space-x-reverse">
                      <div class="flex-none">
                        <div id="wline1"></div>
                      </div>
                      <div class="flex-1">
                        <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                          Walk Ins
                        </div>
                        
                        <div class="text-slate-900 dark:text-white text-lg font-medium">
                          {{ @$walkinsCount }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="py-[18px] px-4 rounded-[6px] bg-[#FFEDE5] dark:bg-slate-900	 ">
                    <div class="flex items-center space-x-6 rtl:space-x-reverse">
                      <div class="flex-none">
                        <div id="wline2"></div>
                      </div>
                      <div class="flex-1">
                        <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                          Reservation
                        </div>
                        <div class="text-slate-900 dark:text-white text-lg font-medium">
                        {{ @$reservationsCount }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900	 ">
                    <div class="flex items-center space-x-6 rtl:space-x-reverse">
                      <div class="flex-none">
                        <div id="wline3"></div>
                      </div>
                      <div class="flex-1">
                        <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                          Customers
                        </div>
                        <div class="text-slate-900 dark:text-white text-lg font-medium">
                          {{ @$userCount }}
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- END: Group Chart2 -->
                </div>
              </div>
            </div>
          </div>
          <div class="grid grid-cols-12 gap-5">
    
            <div class="lg:col-span-8 col-span-12">
              <div class="card">
                <header class="card-header noborder">
                  <h4 class="card-title">Reservation</h4>
                  <div>
              
                  </div>
                </header>
                <div class="card-body p-6">

                  <!-- BEGIN: Company Table -->


                  <div class="overflow-x-auto -mx-6">
                    <div class="inline-block min-w-full align-middle">
                      <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                          <thead class="  bg-slate-200 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class=" table-th ">
                                Date
                              </th>
                              <th scope="col" class=" table-th ">
                                Customer Name
                              </th>
                              <th scope="col" class=" table-th ">
                                Phone
                              </th>
                              <th scope="col" class=" table-th ">
                                Service Name
                              </th>
                              <th scope="col" class=" table-th ">
                                Payment
                              </th>
                              <th scope="col" class=" table-th ">
                                Status
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                          @foreach($reservations as $row)
                            <tr>
                                <td class="table-td">{{ date('F j, Y', strtotime($row->date)) }}</td>
                                <td class="table-td">
                                    <div class="flex items-center">
                                    <div class="flex-none">
                                        <div class="w-8 h-8 rounded-[100%] ltr:mr-3 rtl:ml-3">
                                        <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="" class="w-full h-full rounded-[100%] object-cover">
                                        </div>
                                    </div>
                                    <div class="flex-1 text-start">
                                        <h4 class="text-sm font-medium text-slate-600 whitespace-nowrap">
                                        {{ ucwords($row->first_name.' '.$row->middle_name.' '.$row->last_name) }} <br> 
                                        </h4>
                                        <div class="text-xs font-normal text-slate-600 dark:text-slate-400">
                                        {{ $row->email}}
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                <td class="table-td">{{ $row->phone }}</td>
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
                            <td class="table-td">
                                <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500 bg-warning-500">
                                    Pending
                                </div>
                            </td>
                            </tr>
                          @endforeach
                            <!-- <tr>
                            <td class="table-td">Technology</td>
                              <td class="table-td">
                                <div class="flex items-center">
                                  <div class="flex-none">
                                    <div class="w-8 h-8 rounded-[100%] ltr:mr-3 rtl:ml-3">
                                      <img src=assets/images/users/user-1.jpg alt="" class="w-full h-full rounded-[100%] object-cover">
                                    </div>
                                  </div>
                                  <div class="flex-1 text-start">
                                    <h4 class="text-sm font-medium text-slate-600 whitespace-nowrap">
                                      Biffco Enterprises Ltd.
                                    </h4>
                                    <div class="text-xs font-normal text-slate-600 dark:text-slate-400">
                                      Biffco@example.com
                                    </div>
                                  </div>
                                </div>
                              </td>
                      
                              <td class="table-td ">
                                <div class="flex space-x-6 items-center rtl:space-x-reverse">
                                  <span>
                                95%</span>
                                  <span class=" text-xl  text-danger-500 ">

                                    <iconify-icon icon="heroicons-outline:trending-down"></iconify-icon>
                                
                            </span>
                                </div>
                              </td>
                              <td class="table-td ">343</td>
                              <td class="table-td ">$231.26</td>
                            </tr> -->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- END: Company Table -->
                </div>
              </div>
            </div>
            <div class="lg:col-span-4 col-span-12">
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title">Walk-ins</h4>
                
                </div>
                <div class="card-body p-6">

                  <!-- BEGIN: Activity Card -->

                  <div>
                    <ul class="list-item space-y-3 h-full overflow-x-auto">

                    @foreach($walkinsData as $row)
                          <!-- <li class="flex items-center space-x-3 rtl:space-x-reverse border-b border-slate-100 dark:border-slate-700 last:border-b-0 pb-3 last:pb-0">
                        <div>
                          <div class="w-8 h-8 rounded-[100%]">
                            <img src=assets/images/users/user-1.jpg alt="" class="w-full h-full rounded-[100%] object-cover">
                          </div>
                        </div>
                        <div class="text-start overflow-hidden text-ellipsis whitespace-nowrap max-w-[63%]">
                          <div class="text-sm text-slate-600 dark:text-slate-300 overflow-hidden text-ellipsis whitespace-nowrap">
                            Finance KPI Mobile app launch preparion meeting.
                          </div>
                        </div>
                        <div class="flex-1 ltr:text-right rtl:text-left">
                          <div class="text-sm font-light text-slate-400 dark:text-slate-400">
                            1 hours
                          </div>
                        </div>
                      </li> -->

                      @if(@$row->service_type == 'services')
                      
                      <li class="flex items-center space-x-3 rtl:space-x-reverse border-b border-slate-100 dark:border-slate-700 last:border-b-0 pb-3 last:pb-0">
                            <div>
                            <div class="w-8 h-8 rounded-[100%]">
                                @if(@$row->services->upload)
                                <img src="{{ asset($row->services->upload) }}" alt="{{ $row->services->title }}" class="w-full h-full rounded-[100%] object-cover">
                                @else
                                <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                @endif
                                <!-- <img src=assets/images/users/user-1.jpg alt="" class="w-full h-full rounded-[100%] object-cover"> -->
                            </div>
                            </div>
                            <div class="text-start overflow-hidden text-ellipsis whitespace-nowrap max-w-[63%]">
                                <div class="text-sm text-slate-600 dark:text-slate-300 overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ @$row->services->title }}
                                    @if(@$row->service_type == 'services')
                                        <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->services->amount * $row->total_person), 2, '.', ',') }}
                                        </div>
                                    @else
                                    <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->package->amount ), 2, '.', ',') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 ltr:text-right rtl:text-left">
                            <div class="text-sm font-light text-slate-400 dark:text-slate-400">
                                <div class="text-sm font-light text-slate-400 dark:green-slate-400" >
                                    Pending
                                </div>
                            </div>
                            </div>
                        </li>

              
                        @else
                        <li class="flex items-center space-x-3 rtl:space-x-reverse border-b border-slate-100 dark:border-slate-700 last:border-b-0 pb-3 last:pb-0">
                            <div>
                            <div class="w-8 h-8 rounded-[100%]">
                                @if(@$row->package->upload)
                                <img src="{{ asset($row->package->upload) }}" alt="{{ $row->package->title }}" class="w-full h-full rounded-[100%] object-cover">
                                @else
                                <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                @endif
                                <!-- <img src=assets/images/users/user-1.jpg alt="" class="w-full h-full rounded-[100%] object-cover"> -->
                            </div>
                            </div>
                            <div class="text-start overflow-hidden text-ellipsis whitespace-nowrap max-w-[63%]">
                                <div class="text-sm text-slate-600 dark:text-slate-300 overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ @$row->package->name }}  
                                    @if(@$row->service_type == 'services')
                                        <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->services->amount * $row->total_person), 2, '.', ',') }}
                                        </div>
                                    @else
                                    <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->package->amount ), 2, '.', ',') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 ltr:text-right rtl:text-left">
                            <div class="text-sm font-light text-slate-400 dark:text-slate-400">
                                <div class="text-sm font-light text-slate-400 dark:green-slate-400" >
                                    Pending
                                </div>
                            </div>
                            </div>
                        </li>
        
                        @endif

                    @endforeach

                



                    </ul>
                  </div>
                  <!-- END: Activity Card -->



                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
    @elseif(Auth::user()->user_type == 'Customer')
    <div class="grid grid-cols-12 gap-5">
      <div class="lg:col-span-7 col-span-12">
        <div class="card">
          <header class="card-header noborder">
            <h4 class="card-title">Reservation</h4>
            <div>
        
            </div>
          </header>
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
          <div class="card ">
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
        <form action="{{ route('service.userReseravtion') }}" method="post"  id="user">
          <input type="hidden" name="service_ids[]" id="serviceIdsInput" value="">
          <input type="hidden" name="service_type[]" id="ReservationType" value="">
          <input type="hidden" name="payment_total" id="payment_total" value="">
       <!-- here -->
            <div class="grid grid-cols-12 gap-5 pl-2">
                <div class="lg:col-span-4 col-span-12">
                    <div id="self" class="container pb-3">
                        <div class="row">
                            <div class="col-md-4">
                              <small>Select service type</small>
                                <select name="type" class="form-control" required onchange="toggleGroupFields()">
                                    <option value="" disabled selected>Select Type</option>
                                    <option value="self">Self</option>
                                    <option value="group">Group</option>
                                </select>
                            </div>
                          </div>
                      </div>
                  </div>
      
                <div class="lg:col-span-4 col-span-12">
                  <div id="therapist-select" class="col-md-4">
                  <small>Select preffered therapist</small>
                      <select name="therapist_gender" class="form-control">
                          <option value="" disabled selected>Preffered Therapist</option>
                          <option value="girl">Girl</option>
                          <option value="boy">Boy</option>
                      </select>
                  </div>
                </div>
                <div class="lg:col-span-4 col-span-12">
                  
                </div>
            </div>

            <div id="group" style="display: none;" class="grid grid-cols-12 gap-5 p-5">
                <div class="lg:col-span-4 col-span-12">
                  <small>Total Person</small>
                  <input type="number" class="form-control" name="total_person" placeholder="Total Person">
                </div>

                <div class="lg:col-span-4 col-span-12">
                  <small>Total Person</small>
                  <input type="number" class="form-control" name="boy_therapist" placeholder="Boy Therapist">
                </div>

                <div class="lg:col-span-4 col-span-12">
                  <small>Total Person</small>
                  <input type="number" class="form-control" name="girl_therapist" placeholder="Girl Therapist">
                </div>
            </div>
            <div class="grid grid-cols-12 gap-5 p-5">
                <div class="lg:col-span-4 col-span-12">
                  <small for="humanFriendly_picker" class="form-label">Date</small>
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

    @else
    <div>
    <div class="grid grid-cols-12 gap-5 mb-5">
        <div class="col-span-12">
            <div class="p-4 card">
                <div class="grid md:grid-cols-3 gap-4">

                    <!-- BEGIN: Group Chart2 -->
                    <div class="py-[18px] px-4 rounded-[6px] bg-[#E5F9FF] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                       
                        <div class="text-xl font-medium text-slate-900 mb-2">
                          Hi, {{ Auth::user()->first_name }}
                          </div>
                        </div>
                    </div>

                    <div class="py-[18px] px-4 rounded-[6px] bg-[#FFEDE5] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline2"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                Walk Ins
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{ @$walkinsCount }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-[18px] px-4 rounded-[6px] bg-[#EAE5FF] dark:bg-slate-900">
                        <div class="flex items-center space-x-6 rtl:space-x-reverse">
                            <div class="flex-none">
                                <div id="wline3"></div>
                            </div>
                            <div class="flex-1">
                                <div class="text-slate-800 dark:text-slate-300 text-sm mb-1 font-medium">
                                Reservation
                                </div>
                                <div class="text-slate-900 dark:text-white text-lg font-medium">
                                {{ @$reservationsCount }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Group Chart2 -->

                </div>
            </div>
        </div>
    </div>


          <div class="grid grid-cols-12 gap-5">
    
            <div class="lg:col-span-8 col-span-12">
              <div class="card">
                <header class="card-header noborder">
                  <h4 class="card-title">Reservation</h4>
                  <div>
              
                  </div>
                </header>
                <div class="card-body p-6">

                  <!-- BEGIN: Company Table -->


                  <div class="overflow-x-auto -mx-6">
                    <div class="inline-block min-w-full align-middle">
                      <div class="overflow-hidden ">
                        <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                          <thead class="  bg-slate-200 dark:bg-slate-700">
                            <tr>
                                <th scope="col" class=" table-th ">
                                Date
                              </th>
                              <th scope="col" class=" table-th ">
                                Customer Name
                              </th>
                              <th scope="col" class=" table-th ">
                                Phone
                              </th>
                              <th scope="col" class=" table-th ">
                                Service Name
                              </th>
                              <th scope="col" class=" table-th ">
                                Payment
                              </th>
                              <th scope="col" class=" table-th ">
                                Status
                              </th>
                            </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                          @foreach($reservations as $row)
                            <tr>
                                <td class="table-td">{{ date('F j, Y', strtotime($row->date)) }}</td>
                                <td class="table-td">
                                    <div class="flex items-center">
                                    <div class="flex-none">
                                        <div class="w-8 h-8 rounded-[100%] ltr:mr-3 rtl:ml-3">
                                        <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="" class="w-full h-full rounded-[100%] object-cover">
                                        </div>
                                    </div>
                                    <div class="flex-1 text-start">
                                        <h4 class="text-sm font-medium text-slate-600 whitespace-nowrap">
                                        {{ ucwords($row->first_name.' '.$row->middle_name.' '.$row->last_name) }} <br> 
                                        </h4>
                                        <div class="text-xs font-normal text-slate-600 dark:text-slate-400">
                                        {{ $row->email}}
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                <td class="table-td">{{ $row->phone }}</td>
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
                            <td class="table-td">
                                <div class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px] bg-opacity-25 text-warning-500 bg-warning-500">
                                    Pending
                                </div>
                            </td>
                            </tr>
                          @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- END: Company Table -->
                </div>
              </div>
            </div>
            <div class="lg:col-span-4 col-span-12">
              <div class="card ">
                <div class="card-header ">
                  <h4 class="card-title">Walk-ins</h4>
                
                </div>
                <div class="card-body p-6">

                  <!-- BEGIN: Activity Card -->

                  <div>
                    <ul class="list-item space-y-3 h-full overflow-x-auto">

                    @foreach($walkinsData as $row)

                      @if(@$row->service_type == 'services')
                      
                      <li class="flex items-center space-x-3 rtl:space-x-reverse border-b border-slate-100 dark:border-slate-700 last:border-b-0 pb-3 last:pb-0">
                            <div>
                            <div class="w-8 h-8 rounded-[100%]">
                                @if(@$row->services->upload)
                                <img src="{{ asset($row->services->upload) }}" alt="{{ $row->services->title }}" class="w-full h-full rounded-[100%] object-cover">
                                @else
                                <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                @endif
                                <!-- <img src=assets/images/users/user-1.jpg alt="" class="w-full h-full rounded-[100%] object-cover"> -->
                            </div>
                            </div>
                            <div class="text-start overflow-hidden text-ellipsis whitespace-nowrap max-w-[63%]">
                                <div class="text-sm text-slate-600 dark:text-slate-300 overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ @$row->services->title }}
                                    @if(@$row->service_type == 'services')
                                        <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->services->amount * $row->total_person), 2, '.', ',') }}
                                        </div>
                                    @else
                                    <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->package->amount ), 2, '.', ',') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 ltr:text-right rtl:text-left">
                            <div class="text-sm font-light text-slate-400 dark:text-slate-400">
                                <div class="text-sm font-light text-slate-400 dark:green-slate-400" >
                                    Pending
                                </div>
                            </div>
                            </div>
                        </li>

              
                        @else
                        <li class="flex items-center space-x-3 rtl:space-x-reverse border-b border-slate-100 dark:border-slate-700 last:border-b-0 pb-3 last:pb-0">
                            <div>
                            <div class="w-8 h-8 rounded-[100%]">
                                @if(@$row->package->upload)
                                <img src="{{ asset($row->package->upload) }}" alt="{{ $row->package->title }}" class="w-full h-full rounded-[100%] object-cover">
                                @else
                                <img src="{{ asset('admin/assets/images/all-img/customer_1.png') }}" alt="50" class="object-cover w-full h-full rounded-full">
                                @endif
                                <!-- <img src=assets/images/users/user-1.jpg alt="" class="w-full h-full rounded-[100%] object-cover"> -->
                            </div>
                            </div>
                            <div class="text-start overflow-hidden text-ellipsis whitespace-nowrap max-w-[63%]">
                                <div class="text-sm text-slate-600 dark:text-slate-300 overflow-hidden text-ellipsis whitespace-nowrap">
                                    {{ @$row->package->name }}  
                                    @if(@$row->service_type == 'services')
                                        <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->services->amount * $row->total_person), 2, '.', ',') }}
                                        </div>
                                    @else
                                    <div class=" text-danger-500">
                                        ₱ {{ number_format((@$row->package->amount ), 2, '.', ',') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1 ltr:text-right rtl:text-left">
                            <div class="text-sm font-light text-slate-400 dark:text-slate-400">
                                <div class="text-sm font-light text-slate-400 dark:green-slate-400" >
                                    Pending
                                </div>
                            </div>
                            </div>
                        </li>
        
                        @endif

                    @endforeach

                



                    </ul>
                  </div>
                  <!-- END: Activity Card -->



                </div>
              </div>
            </div>
              </div>
            </div>
          </div>
        </div>
    @endif
</x-app-layout>

<script>

document.addEventListener('DOMContentLoaded', function() {
          const userForm = document.getElementById('user'); // Replace with your actual form ID
      userForm.addEventListener('submit', function(event) {
          event.preventDefault(); // Prevent the default form submission

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
                      url: '{{ route("service.userReseravtion") }}', // Adjust the route
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