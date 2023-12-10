 <div wire:ignore class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
     <div class="navbar-header" wire:ignore>
         <ul class="nav navbar-nav flex-row">
             <li class="nav-item me-auto"><a class="navbar-brand" href="/"><span class="brand-logo">
                         <img src="{{ asset('asset/images/logo.jpg') }}" width="30" />
                     </span>
                     <h2 class="brand-text">{{env('APP_NAME')}}</h2>
                 </a></li>
             <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                         class="d-block d-xl-none text-primary toggle-icon font-medium-4"> <svg
                             xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round"
                             class="feather feather-x d-block d-xl-none text-primary toggle-icon font-medium-4">
                             <line x1="18" y1="6" x2="6" y2="18"></line>
                             <line x1="6" y1="6" x2="18" y2="18"></line>
                         </svg></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                         data-ticon="disc">
                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                             stroke-linejoin="round"
                             class="feather feather-disc d-none d-xl-block collapse-toggle-icon primary font-medium-4">
                             <circle cx="12" cy="12" r="10"></circle>
                             <circle cx="12" cy="12" r="3"></circle>
                         </svg></i></a></li>
         </ul>
     </div>
     <div class="shadow-bottom"></div>
     <div class="main-menu-content" wire:ignore>
         <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
             <li class=" nav-item ">
                 <a class="d-flex align-items-center" href="">
                     <i data-feather="home"></i>
                     <span class="menu-title text-truncate">{{ __('tran.dashboard') }}</span>
                 </a>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i data-feather="layout"></i>
                     <span class="menu-title text-truncate">{{ __('tran.freecourse') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{route('freecourse')}}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.freecourse') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{route('categoryfree')}}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.category_free') }}</span>
                         </a>
                     </li>
                 </ul>
             </li>
         </ul>
     </div>
 </div>
