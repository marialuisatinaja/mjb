<!DOCTYPE html>
<html lang="zxx" dir="ltr" class="light">
    @include('layouts.head')
    <body class=" font-inter dashcode-app" id="body_class">
    
    <main class="app-wrapper">
        @include('layouts.sidebar')
        <div class="flex flex-col justify-between min-h-screen">
      <div>
      @include('layouts.header')

        <div class="content-wrapper transition-all duration-150 ltr:ml-[248px] rtl:mr-[248px]" id="content_wrapper">
          <div class="page-content">
            <div class="transition-all duration-150 container-fluid" id="page_layout">
              <div id="content_layout">

                     <main>
                        {{ $slot }}
                    </main>

              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    </main>
        @include('layouts.scripts')
</body>
</html>
