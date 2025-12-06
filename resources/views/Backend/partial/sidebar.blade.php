<!-- ---------------------------------- -->
<!-- Start Vertical Layout Sidebar -->
<!-- ---------------------------------- -->
<div class="p-4">
  @include('Backend.Partial.logo_sidebar')
</div>
<div class="scroll-sidebar" data-simplebar="">
  <nav class=" w-full flex flex-col sidebar-nav px-4 mt-5">
    <ul id="sidebarnav" class="text-gray-600 text-sm">

      <li class="text-xs font-bold pb-[5px]">
        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
        <span class="text-xs text-gray-400 font-semibold">HOME</span>
      </li>

      <li class="sidebar-item">
        <a class="sidebar-link gap-3 py-2.5 my-1 text-base  flex items-center relative  rounded-md text-gray-500  w-full {{Request::is('dashboard*') ? 'active':''}}"
          href="">
          
          <i class="ti ti-layout-dashboard ps-2  text-2xl"></i> <span>Dashboard</span>
        </a>
      </li>
      
      <li class="text-xs font-bold mb-4 mt-6">
        <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
        <span class="text-xs text-gray-400 font-semibold">MENU</span>
      </li>

      <li class="sidebar-item ">
        <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full
        {{Request::is('exam*') ? 'active':''}}" 
        href="">
          <i class="ti ti-file-text ps-2 text-2xl"></i> <span>Artikel</span>
        </a>
      </li>
      

      

    </ul>
  </nav>
</div>
