 <div wire:ignore class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
     <div class="navbar-header" wire:ignore>
         <ul class="nav navbar-nav flex-row">
             <li class="nav-item me-auto"><a class="navbar-brand" href="/"><span class="brand-logo">
                         <img src="{{ asset('files/nartaqe.png') }}" width="30" />
                     </span>
                     <h2 class="brand-text">{{ env('APP_NAME') }}</h2>
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
                 <a class="d-flex align-items-center" href="/dashboard">
                     <i data-feather="home"></i>
                     <span class="menu-title text-truncate">{{ __('tran.dashboard') }}</span>
                 </a>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     {{-- <i data-feather="layout"></i> --}}
                     <i class="fas fa-book-open"></i>
                     <span class="menu-title text-truncate">{{ __('tran.freecourse') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('freecourse') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.freecourse') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('categoryfree') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.category_free') }}</span>
                         </a>
                     </li>
                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-school"></i>
                     <span class="menu-title text-truncate">{{ __('tran.courses') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('stage') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.viewstages') }}</span>
                         </a>
                     </li>

                     <li>
                         <a class="d-flex align-items-center" href="{{ route('category') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.categorys') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('newcourse') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.newcourse') }}</span>
                         </a>
                     </li>
                     <li>
                         {{-- <a class="d-flex align-items-center" href="{{route('newcourse2')}}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">DEMO - {{ __('tran.newcourse') }}</span>
                         </a>
                     </li> --}}
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('course') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.viewcourse') }}</span>
                         </a>
                     </li>
                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-book-open"></i>
                     <span class="menu-title text-truncate">{{ __('tran.books') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('categorybooks') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.categorybooks') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('viewbooks') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.viewbooks') }}</span>
                         </a>
                     </li>



                 </ul>
             </li>

             {{-- <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                    <i class="fas fa-layer-group"></i>
                     <span class="menu-title text-truncate">{{ __('tran.stages') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('stage') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.viewstages') }}</span>
                         </a>
                     </li>

                 </ul>
             </li> --}}
           <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-copy"></i>
                     <span class="menu-title text-truncate">{{ __('tran.exams') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('category-quiz') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.categorys') }}</span>
                         </a>
                     </li>

                     <li>
                         <a class="d-flex align-items-center" href="{{ route('newquiz') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.newquiz') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('viewquiz') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.viewquiz') }}</span>
                         </a>
                     </li> 
                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-copy"></i>
                     <span class="menu-title text-truncate">{{ __('tran.studentgrades') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('viewgrades') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.viewgrades') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('categorygrades') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.categorygrades') }}</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-calendar-alt"></i>
                     <span class="menu-title text-truncate">{{ __('tran.studyschedule') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('studyschedule') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.viewstudyschedule') }}</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-user-shield"></i>
                     <span class="menu-title text-truncate">{{ __('tran.trainers') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('trainers') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.trainers') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('specialist') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.specialist') }}</span>
                         </a>
                     </li>
                     {{-- <li>
                        <a class="d-flex align-items-center" href="{{route('categoryfree')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('tran.category') }}</span>
                        </a>
                    </li> --}}
                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-user-graduate"></i>
                     <span class="menu-title text-truncate">{{ __('tran.trainees') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('trainees') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.trainees') }}</span>
                         </a>
                     </li>
                     {{-- <li>
                        <a class="d-flex align-items-center" href="{{route('categoryfree')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('tran.category') }}</span>
                        </a>
                    </li> --}}
                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-shopping-cart"></i>
                     <span class="menu-title text-truncate">{{ __('tran.orders') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('order') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.orders') }}</span>
                         </a>
                     </li>
                     {{-- <li>
                        <a class="d-flex align-items-center" href="{{route('categoryfree')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">{{ __('tran.category') }}</span>
                        </a>
                    </li> --}}
                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fab fa-blogger"></i>
                     <span class="menu-title text-truncate">{{ __('tran.blog') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('blog') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.blog') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('category-blog') }}">
                             <i data-feather="circle"></i>
                             <span class="menu-item text-truncate">{{ __('tran.category-blog') }}</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fab fa-blogger"></i>
                     <span class="menu-title text-truncate">{{ __('tran.qr') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('qr_mangement') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{    __('tran.qr_mangement') }}</span>
                         </a>
                     </li>
                    

                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="far fa-credit-card"></i>
                     <span class="menu-title text-truncate">{{ __('tran.payment_method') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('payment-method') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.payment_method') }}</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-envelope-open-text"></i>
                     <span class="menu-title text-truncate">{{ __('tran.contactus') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('contactus') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.contactus') }}</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-bell"></i>
                     <span class="menu-title text-truncate">{{ __('tran.notifications') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('notification') }}">
                             <i data-feather="circle"></i>
                             <span
                                 class="menu-item text-truncate">{{ __('tran.view') . ' ' . __('tran.notifications') }}</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class=" nav-item">
                 <a class="d-flex align-items-center" href="#">
                     <i class="fas fa-cog"></i>
                     <span class="menu-title text-truncate">{{ __('tran.setting') }}</span>
                 </a>
                 <ul class="menu-content">
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('setting') }}">
                             {{-- <i data-feather="circle"></i> --}}
                             <i class="fas fa-tools"></i>
                             <span class="menu-item text-truncate">{{ __('tran.homesetting') }}</span>
                         </a>
                     </li>
                     <li>
                         <a class="d-flex align-items-center" href="{{ route('slider') }}">
                             <i class="fas fa-sliders-h"></i>
                             <span class="menu-item text-truncate">{{ __('tran.slider') }}</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class=" nav-item">
                 {{-- <a class="log-out-btn" href="{{ route('logout') }}">

                     <i class="fas fa-cog"></i>
                     <span class="menu-title text-truncate">{{ __('tran.signout') }}</span>
                 </a> --}}
                 <a class="log-out-btn" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                     <i class="me-50" data-feather="power"></i> {{ __('tran.logout') }}</a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>

             </li>
         </ul>
     </div>
 </div>
