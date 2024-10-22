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
    @endif
</x-app-layout>
