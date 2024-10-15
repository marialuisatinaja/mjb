
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
                                                                            <a href="{{ route('service.edit', ['id' => $service->id]) }}" class="action-btn">
                                                                                <iconify-icon icon="heroicons:command-line"></iconify-icon>
                                                                            </a>
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
                                    <a href="{{ route('package.edit', ['id' => $package->id]) }}" class="action-btn">
                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                    </a>

                                        <button class="action-btn" type="button" onclick="delete_service({{ $package->id }})">
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
                    </div>
                </div>
              </div>
          </div>
      </div>
</div>



</x-app-layout>