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

                <form wire:submit.prevent='save' enctype="multipart/form-data">
                    @if ($currentPage == 1)
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
                                        <input  type="number" step="0.01" class="form-control" wire:model='price' />
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
                                    <x-daterange wire:model='startdate' id="startdate" required />
                                    {{-- <div class="input-group input-group-merge  col-md-4">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div> --}}
                                    @error('startdate')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.enddate') }}</label>
                                    <x-daterange wire:model='enddate' id="enddate" required />
                                    {{-- <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div> --}}
                                    @error('enddate')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4" wire:ignore>
                                    <label class="form-label" for="username">{{ __('tran.time') }}</label>
                                    <x-time class="form-control flatpickr-time text-start" wire:model='time'
                                        id="time" required />
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
                                    <label class="form-label" for="username">{{ __('tran.duration_course') }}</label>
                                    <input type="text" class="form-control" wire:model='duration_course' />
                                    @error('duration_course')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.limit_stud') }}</label>
                                    <input  type="number" step="1" class="form-control" wire:model='limit_stud' />
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
                                    <div wire:ignore>
                                        <select class="select2 form-select" id="select2-multiple" multiple="multiple"
                                            required>
                                            @foreach ($triners as $item)
                                                <option @if (in_array($item->id, $triner)) selected @endif
                                                    value="{{ $item->id ?? '' }}">{{( $item->first_name ?? '') . ' ' . ( $item->middle_name ?? '')}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('triner')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-1 col-md-12">
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
                                    <label class="form-label" for="">{{ __('tran.answer_the_question') }}</label>
                                    <x-summernote wire:model='answer_the_question' name="answer_the_question" id="answer_the_question"
                                        value='{{ $answer_the_question }}' />
                                    @error('answer_the_question')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="">{{ __('tran.sections_guide') }}</label>
                                    <x-summernote wire:model='sections_guide' name="sections_guide" id="sections_guide"
                                        value='{{ $sections_guide }}' />
                                    @error('sections_guide')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    @elseif ($currentPage == 2)
                        <div id="personal-info" class="content {{ $currentPage == 2 ? 'active' : '' }}">
                            <div class="content-header">
                                <h5 class="mb-0">{{ __('tran.attached') }}</h5>
                                {{-- <small class="text-muted">{{ $pages[2]['subheading'] }}</small> --}}
                            </div>
                            <div class="row">
                                <div class="mb-2 col-md-6">
                                    <x-imageupload wire:model='image_course' :height='200' :width='200'
                                        :imagenew="$image_course" :tlabel="__('tran.imagecourse')" />
                                    @error('image_course')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-6">
                                    <x-imageupload wire:model='calc_rate' :height='200' :width='200'
                                        :imagenew="$calc_rate" :tlabel="__('tran.calc_rate')" />
                                    @error('calc_rate')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3  border border-black pb-2">
                                    <x-fileupload wire:model='schedule' id='schedule' :tlabel="__('tran.courseschedule')"
                                        :namefile="$schedule != null ? $schedule->getClientOriginalName() : null" />
                                    @error('schedule')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3  border border-black pb-2">
                                    <x-fileupload wire:model='file_work' id='file_work' :tlabel="__('tran.file_work')"
                                        :namefile="$file_work != null ? $file_work->getClientOriginalName() : null" />
                                    @error('file_work')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_explanatory' id='file_explanatory'
                                        :tlabel="__('tran.file_explanatory')" :namefile="$file_explanatory != null
                                            ? $file_explanatory->getClientOriginalName()
                                            : null" />
                                    @error('file_explanatory')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_aggregates' id='file_aggregates' :tlabel="__('tran.file_aggregates')"
                                        :namefile="$file_aggregates != null
                                            ? $file_aggregates->getClientOriginalName()
                                            : null" />
                                    @error('file_aggregates')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_supplementary' id='file_supplementary'
                                        :tlabel="__('tran.file_supplementary')" :namefile="$file_supplementary != null
                                            ? $file_supplementary->getClientOriginalName()
                                            : null" />
                                    @error('file_supplementary')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_free' id='file_free' :tlabel="__('tran.file_free')"
                                        :namefile="$file_free != null ? $file_free->getClientOriginalName() : null" />
                                    @error('file_free')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_test' id='file_test' :tlabel="__('tran.file_test')"
                                        :namefile="$file_test != null ? $file_test->getClientOriginalName() : null" />
                                    @error('file_test')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    @elseif ($currentPage == 3)
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

                            @foreach ($lessons as $key => $value)
                                <div class="mb-1 row">
                                    <div class="col-md-2 form-check form-check-inline ">
                                        <select class="form-select" id="lessons.{{ $key }}.is_lesson" wire:model.lazy='lessons.{{ $key }}.is_lesson'>

                                            @foreach ( \App\Enum\LessonStatu::cases() as $q)

                                            <option value="{{$q->value}}">{{ __('tran.typelesson-'.$q->name)}} </option>
                                            @endforeach
                                        </select>
                                        {{-- <input class="form-check-input"
                                            wire:model.lazy='lessons.{{ $key }}.is_lesson'type="checkbox"
                                            id="inlineCheckbox1" /> --}}
                                        {{-- <label class="form-check-label"
                                            for="inlineCheckbox1">{{ $lessons[$key]['is_lesson'] ==1 ? 'شرح' :($lessons[$key]['is_lesson'] ==0 ? 'تدريب': 'بث مباشر') }}</label> --}}
                                        @error('lessons.' . $key . '.is_lesson')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-3">
                                        <select class="form-select" wire:model='lessons.{{ $key }}.stage_id'
                                            required>
                                            <option value=""> اختار المرحلة</option>
                                            @foreach ($stages as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name . ($item->parent_id == null ? ' مرحلة رئيسية' : ' مرحلة فرعية من  ( ' . $item->_parent->name . ' )') }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('lessons.' . $key . '.stage_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-2">
                                        <x-daterange wire:model='lessons.{{ $key }}.publish_at' id="lessons.{{ $key }}.publish_at"  />
                                        @error('lessons.' . $key . '.publish_at')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    @if ($lessons[$key]['is_lesson'] != false)
                                        <div class="col">
                                            <input class="form-control" wire:model="lessons.{{ $key }}.name"
                                                placeholder="{{ $lessons[$key]['is_lesson'] ==1 ? 'اسم الشرح' :($lessons[$key]['is_lesson'] ==0 ? 'اسم تدريب': 'اسم بث مباشر') }}"
                                                type="text" />
                                            @error('lessons.' . $key . '.name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col">

                                            <input class="form-control" wire:model="lessons.{{ $key }}.link"
                                                type="text"
                                                placeholder="{{  $lessons[$key]['is_lesson'] ==1 ? 'رابط الشرح' :($lessons[$key]['is_lesson'] ==0 ? 'رابط تدريب': 'رابط بث مباشر') }}" />

                                            @error('lessons.' . $key . '.link')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="col">
                                            <input class="form-control" wire:model="lessons.{{ $key }}.name"
                                                placeholder="{{ $lessons[$key]['is_lesson'] != false ? 'اسم شرح' : ' اسم تدريب' }}"
                                                type="text" />
                                            @error('lessons.' . $key . '.name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            @if ($lessons[$key]['link'] != null)
                                                <p>تم اختيار التدريب </p>
                                            @else
                                                <x-model wire:model='questions' :questions='$questions'
                                                    :keys='$key' />
                                                <button type="button" class="btn btn-outline-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#fullscreenModal-{{ $key }}">
                                                    اضافه تدريب
                                                </button>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="col-1">
                                        @if ($key != 0)
                                            <button wire:click='removelesson({{ $key }})' type="button"
                                                class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center rounded-circle
                                        bg-red-600 hover:bg-red-800 text-white shadow-lg hover-shadow-xl
                                        transition duration-150 ease-in-out focus:bg-red-700 outline-none focus-outline-none"
                                                style="height: 2rem; width: 2rem; ">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif ($currentPage == 4)
                        <div id="social-links" class="content {{ $currentPage == 4 ? 'active' : '' }} "
                            role="tabpanel" aria-labelledby="social-links-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">{{ __('tran.setcourse') }}</h5>
                                {{-- <small class="text-muted">{{ $pages[4]['subheading'] }}</small> --}}
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-3">
                                    <x-check wire:model='langcourse' id="langcourse" left="En" right="Ar"
                                        :tlabel="__('tran.langcourse')" />
                                </div>
                                <div class="mb-1 col-md-3">
                                    <x-check wire:model='inputnum' id="inputnum" left="En" right="Ar"
                                        :tlabel="__('tran.inputnum')" />
                                </div>
                                <div class="mb-1 col-md-3">
                                    <x-check wire:model='status' id="status" :tlabel="__('tran.statu')" />
                                </div>

                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="telegram">{{ __('tran.telegram') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fab fa-telegram-plane"></i></span>
                                        <input type="text" class="form-control" wire:model='telegram' />
                                    </div>
                                    @error('telegram')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label"
                                        for="telegramgrup">{{ __('tran.telegramgrup') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fab fa-telegram-plane"></i></span>
                                        <input type="text" class="form-control" wire:model='telegramgrup' />
                                    </div>
                                    @error('telegramgrup')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="nextcourse">{{ __('tran.nextcourse') }}</label>
                                    <select class="form-select" wire:model='nextcourse' >
                                        <option value="">اختار الدورة التالية</option>
                                        @foreach ($nextcoursesbycat as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('nextcourse')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @error('nextcourse')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <div   class="d-flex justify-content-between">
                        <button  wire:loading.attr="disabled" class="btn {{ $currentPage > 1 ? 'btn-primary' : 'btn-outline-secondary' }} btn-prev"
                            {{ $currentPage == 1 ? 'disabled' : '' }} wire:click.prevent="goToPerviousPage">
                            <i
                                class="fas fa-arrow-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right' : 'left' }}  align-middle ms-sm-25 ms-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">{{ __('tran.previous') }}</span>
                        </button>
                        {{ $currentPage }}
                        @if ($currentPage === 4)
                            <button wire:loading.attr="disabled" type="submit" class="btn btn-success btn-submit">
                                {{ __('tran.submit') }}</button>
                        @else
                            <button   wire:loading.attr="disabled" class="btn btn-primary btn-next" wire:click.prevent="goToNextPage">

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
@push('csslive')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" /> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('jslive')
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script> --}}

    <script src="{{ asset('asset/vendors/js/forms/select/select2.full.min.js') }}"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            // console.log();
            var select = $('.select2');
            select.each(function() {
                var $this = $(this);
                $this.wrap('<div wire:ignore class="position-relative"></div>');
                $this.select2().on('change', function(e) {
                    @this.set('triner', $(this).val())
                    // console.log($(this).val());
                });
            });
            Livewire.hook('morph.added', (element) => {
                var select = $('.select2');
                select.each(function() {
                    var $this = $(this);
                    $this.wrap('<div wire:ignore class="position-relative"></div>');
                    $this.select2().on('change', function(e) {
                        @this.set('triner', $(this).val())
                        // console.log($(this).val());
                    });
                });
            });
        });
    </script>
    <script>
        window.addEventListener('swal', event => {
            Swal.fire({
                title: event.detail.message,
                icon: 'info',
                customClass: {
                    confirmButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
        })
        window.addEventListener('openmodel', event => {

            $('#fullscreenModal-' + event.detail.key).modal("show");

        });
        window.addEventListener('closemodel', event => {

            $('#fullscreenModal-' + event.detail.key).modal("hide");

        });
    </script>
@endpush
