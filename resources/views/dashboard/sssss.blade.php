 @extends('layouts.dashboard.app')
 @section('content')


     <div wire:ignore.self>
         @push('csslive')
             <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/wizard/bs-stepper.min.css') }}">
             @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
                 <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/plugins/forms/form-wizard.min.css') }}">
             @else
                 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.min.css') }}">
             @endif
         @endpush

         <section class="horizontal-wizard">
             <div class="bs-stepper horizontal-wizard-example">
                 <div class="bs-stepper-header" role="tablist">
                     <div class="step {{ $currentPage == 1 ? 'active' : 'crossed' }}" wire:click.prevent="goToPage('1')">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">1</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.datacourse') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[1]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                     <div class="line">
                         <i
                             class="fas fa-chevron-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} font-medium-2"></i>
                     </div>
                     <div class="step {{ $currentPage == 2 ? 'active' : 'crossed' }}">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">2</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.attached') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[2]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                     <div class="line">
                         <i
                             class="fas fa-chevron-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} font-medium-2"></i>
                     </div>
                     <div class="step {{ $currentPage == 3 ? 'active' : 'crossed' }}">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">3</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.lessons') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[3]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                     <div class="line">
                         <i
                             class="fas fa-chevron-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} font-medium-2"></i>
                     </div>
                     <div class="step  {{ $currentPage == 4 ? 'active' : 'crossed' }}">
                         <button type="button" class="step-trigger">
                             <span class="bs-stepper-box">4</span>
                             <span class="bs-stepper-label">
                                 <span class="bs-stepper-title">{{ __('tran.setcourse') }}</span>
                                 {{-- <span class="bs-stepper-subtitle">{{ $pages[4]['subheading'] }}</span> --}}
                             </span>
                         </button>
                     </div>
                 </div>
                 <div class="bs-stepper-content">
                     <form enctype="multipart/form-data">

                             <div id="account-details" class="content {{ $currentPage == 1 ? 'active' : '' }}  ">
                                 <div class="content-header">
                                     <h5 class="mb-0">{{ __('tran.datacourse') }}</h5>
                                     {{-- <small class="text-muted">{{ $pages[1]['subheading'] }}</small> --}}
                                 </div>
                                 <div class="row">
                                     <div class="mb-1 col-md-12">
                                         <label class="form-label"
                                             for="username">{{ __('tran.title') . ' ' . __('tran.course') }}</label>
                                         <input type="text" class="form-control" wire:model='name' required />
                                         @error('name')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-12">
                                         <label class="form-label"
                                             for="short_description">{{ __('tran.short_description') }}</label>
                                         <textarea type="short_description" class="form-control @error('short_description')  is-invalid @enderror "
                                             wire:model='short_description'></textarea>
                                         {{-- <textarea wire:model='short_description' class="form-control"  id="short_description">{!! $short_description !!}</textarea> --}}

                                         @error('short_description')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4">
                                         <label class="form-label"
                                             for="modalEditUserFirstName">{{ __('tran.category') }}</label>
                                         <select class="form-select" wire:model='category_id' required>
                                             <option value=""> اختيارالقسم</option>
                                             @foreach ($category as $c)
                                                 <option value="{{ $c->id }}">{{ $c->name }}</option>
                                             @endforeach
                                         </select>
                                         @error('category_id')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>

                                     <div class="mb-1 col-md-4">
                                         <label class="form-label"
                                             for="modalEditUserFirstName">{{ __('tran.course_gender') }}</label>
                                         <select class="form-select" wire:model='course_gender' required>
                                             <option value=""> نوع الدورة</option>
                                             <option value="0">الكل</option>
                                             <option value="1">طلاب</option>
                                             <option value="2">طالبات</option>
                                         </select>
                                         @error('course_gender')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>

                                     <div class="mb-1 col-md-4">
                                         <label class="form-label" for="username">{{ __('tran.price') }}</label>
                                         <div class="input-group input-group-merge">
                                             <select class=" form-select" wire:model='pricewith'>
                                                 <option value="1" selected>PDF شامل كتاب الدورة</option>
                                                 <option value="2">بدون كتاب الدورة</option>
                                             </select>
                                             <input type="number" step="0.01" class="form-control" wire:model='price' />
                                         </div>

                                         @error('pricewith')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                         @error('price')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4">
                                         <label class="form-label" for="username">{{ __('tran.startdate') }}</label>
                                         {{-- <x-daterange wire:model='startdate' id="startdate" required /> --}}

                                         @error('startdate')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4">
                                         <label class="form-label" for="username">{{ __('tran.enddate') }}</label>
                                         {{-- <x-daterange wire:model='enddate' id="enddate" required /> --}}

                                         @error('enddate')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4" wire:ignore>
                                         <label class="form-label" for="username">{{ __('tran.time') }}</label>
                                         {{-- <x-time class="form-control flatpickr-time text-start" wire:model='time' id="time" required /> --}}
                                         {{-- <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                         <input type="text" class="form-control" wire:model='time' required />
                                     </div> --}}
                                         @error('time')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4">
                                         <label class="form-label" for="validity">{{ __('tran.validity') }}</label>
                                         <input type="text" class="form-control" wire:model='validity' />
                                         @error('validity')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4">
                                         <label class="form-label"
                                             for="username">{{ __('tran.duration_course') }}</label>
                                         <input type="text" class="form-control" wire:model='duration_course' />
                                         @error('duration_course')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4">
                                         <label class="form-label" for="username">{{ __('tran.limit_stud') }}</label>
                                         <input type="number" step="1" class="form-control"
                                             wire:model='limit_stud' />
                                         @error('limit_stud')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>
                                     <div class="mb-1 col-md-4">
                                         <label class="form-label" for="username">{{ __('tran.free_tatorul') }} :</label>
                                         <select class="form-select" wire:model.lazy='free_tatorul'required>
                                             <option value=""> اختار قسم الشرح المجانى</option>
                                             @foreach ($categoryfreecourse as $item)
                                                 <option value="{{ $item->id }}"> {{ $item->name }} </option>
                                             @endforeach
                                         </select>
                                         @error('free_tatorul')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>

                                     <div class="mb-1 col-md-12">
                                         <label class="form-label" for="username">{{ __('tran.trainers') }}</label>
                                         {{-- <div wire:ignore>
                                        <select class="select2 form-select" id="select2-multiple" multiple="multiple"
                                            required>
                                            @foreach ($triners as $item)
                                                <option @if (in_array($item->id, $triner)) selected @endif
                                                    value="{{ $item->id ?? '' }}">
                                                    {{ ($item->first_name ?? '') . ' ' . ($item->middle_name ?? '') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                         @error('triner')
                                             <span class="error" style="color: red">{{ $message }}</span>
                                         @enderror
                                     </div>

                                     {{-- <div class="mb-1 col-md-12">
                                    <label class="form-label"
                                        for="username">{{ __('tran.features') . ' ' . __('tran.course') }}</label>
                                    <x-summernote wire:model='features' name="features" id="features" />
                                    @error('features')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="description">{{ __('tran.description') }}</label>
                                    <x-summernote wire:model='description' name="description" id="description" />
                                    @error('description')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="conditions">{{ __('tran.conditions') }}</label>
                                    <x-summernote wire:model='conditions' name="conditions" id="conditions" />
                                    @error('conditions')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="">{{ __('tran.target') }}</label>
                                    <x-summernote wire:model='target' name="target" id="target" />
                                    @error('target')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="">{{ __('tran.howtostart') }}</label>
                                    <x-summernote wire:model='howtostart' name="howtostart" id="howtostart"
                                        value='{{ $howtostart }}' />
                                    @error('howtostart')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label"
                                        for="">{{ __('tran.answer_the_question') }}</label>
                                    <x-summernote wire:model='answer_the_question' name="answer_the_question"
                                        id="answer_the_question" value='{{ $answer_the_question }}' />
                                    @error('answer_the_question')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="">{{ __('tran.sections_guide') }}</label>
                                    <x-summernote wire:model='sections_guide' name="sections_guide"
                                        id="sections_guide" value='{{ $sections_guide }}' />
                                    @error('sections_guide')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                 </div>
                             </div>

                             <div id="personal-info" class="content {{ $currentPage == 2 ? 'active' : '' }}">
                                 <div class="content-header">
                                     <h5 class="mb-0">{{ __('tran.attached') }}</h5>
                                     {{-- <small class="text-muted">{{ $pages[2]['subheading'] }}</small> --}}
                                 </div>

                             </div>

                             <div id="address-step" class="content {{ $currentPage == 3 ? 'active' : '' }} ">
                                 <div class="content-header">
                                     <button wire:click='addlesson()' type="button"
                                         class="btn btn-primary d-inline-flex align-items-center justify-content-center rounded-circle
                                bg-red-600 hover:bg-red-800 text-white shadow-lg hover-shadow-xl
                                transition duration-150 ease-in-out focus:bg-red-700 outline-none focus-outline-none"
                                         style="height: 3rem; width: 2rem; ">
                                         <i class="fas fa-plus-circle fa-lg"></i>
                                     </button>
                                     <h5 class="mb-0">{{ __('tran.lessons') }}</h5>
                                     {{-- <small class="text-muted">{{ $pages[3]['subheading'] }}</small> --}}
                                 </div>


                             </div>
                       
                             <div id="social-links" class="content {{ $currentPage == 4 ? 'active' : '' }} "
                                 role="tabpanel" aria-labelledby="social-links-trigger">
                                 <div class="content-header">
                                     <h5 class="mb-0">{{ __('tran.setcourse') }}</h5>
                                     {{-- <small class="text-muted">{{ $pages[4]['subheading'] }}</small> --}}
                                 </div>

                             </div>

                         <div class="d-flex justify-content-between">
                             <button wire:loading.attr="disabled"
                                 class="btn {{ $currentPage > 1 ? 'btn-primary' : 'btn-outline-secondary' }} btn-prev"
                                 {{ $currentPage == 1 ? 'disabled' : '' }} wire:click.prevent="goToPerviousPage">
                                 <i
                                     class="fas fa-arrow-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right' : 'left' }}  align-middle ms-sm-25 ms-0"></i>
                                 <span class="align-middle d-sm-inline-block d-none">{{ __('tran.previous') }}</span>
                             </button>
                             {{ $currentPage }}
                             @if ($currentPage === 4)
                                 <button type="submit" class="btn btn-success btn-submit">
                                     {{ __('tran.submit') }}</button>
                             @else
                                 <button class="goToNextPage btn btn-primary btn-next">
                                     <span class="align-middle d-sm-inline-block d-none">{{ __('tran.next') }}</span>
                                     <i
                                         class="fas fa-arrow-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'left' : 'right' }} align-middle me-sm-25 me-0"></i>
                                 </button>
                             @endif
                         </div>
                     </form>
                 </div>
             </div>
         </section>
     </div>
 @endsection
 @push('csslive')
     {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" /> --}}

     <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/select/select2.min.css') }}">
 @endpush
 @push('jslive')
     <script>
         //  $(document).on('click', '.goToNextPage', function() {
         //      console.log('sss');
         //      $.ajaxSetup({
         //          headers: {
         //              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         //          }
         //      });

         //      $.ajax({
         //          method: 'get',
         //          url: "{{ route('page') }}",
         //          //  data: {
         //          //      'id': matchid,
         //          //  },
         //          success: function(data) {
         //              console.log(data);

         //          },
         //          error: function(data) {

         //              console.log(data);
         //          }
         //      });
         //  });
     </script>
 @endpush
