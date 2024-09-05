<div wire:ignore.self>
    @push('csslive')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/plugins/forms/form-wizard.min.css') }}">
    @else
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.min.css') }}">
    @endif
    @endpush
    <div class="card">
        <form wire:submit.prevent='save' enctype="multipart/form-data">
            <div class="card-body">
                <h4 class="card-title"> {{ __('tran.add') }} > {{ __('tran.course') }}</h4>
                <h6 class="card-subtitle text-muted"> </h6>
                <div class="accordion accordion-margin" id="accordionMargin" data-toggle-hover="true">

                    <div class="accordion-item" wire:ignore.self>
                        <h2 class="accordion-header  d-flex align-items-center justify-content-between" id="headingMarginOne1">
                            <div class="d-flex align-items-center">
                                <button wire:ignore.self class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne1" aria-expanded="false" aria-controls="accordionMarginOne1">
                                    <span class="text-warning">{{ __('tran.datacourse') }}</span>
                                </button>
                            </div>
                        </h2>
                        <div id="accordionMarginOne1" class="accordion-collapse  collapse" aria-labelledby="headingMarginOne1" data-bs-parent="#accordionMargin" wire:ignore.self>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-1 col-md-12">
                                            <label class="form-label" for="username">{{ __('tran.title') . ' ' . __('tran.course') }}</label>
                                            <input type="text" class="form-control" wire:model='name' required />
                                            @error('name')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1 col-md-12">
                                            <label class="form-label" for="short_description">{{ __('tran.short_description') }}</label>
                                            <textarea type="short_description" class="form-control @error('short_description')  is-invalid @enderror " wire:model='short_description'></textarea>
                                            @error('short_description')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.category') }}</label>
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
                                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.course_gender') }}</label>
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
                                            <x-daterange wire:model='startdate' id="startdate" required />
                                            @error('startdate')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="form-label" for="username">{{ __('tran.enddate') }}</label>
                                            <x-daterange wire:model='enddate' id="enddate" required />
                                            @error('enddate')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1 col-md-4" wire:ignore>
                                            <label class="form-label" for="username">{{ __('tran.time') }}</label>
                                            <x-time class="form-control flatpickr-time text-start" wire:model='time' id="time" required />
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
                                            <input type="number" step="1" class="form-control" wire:model='limit_stud' />
                                            @error('limit_stud')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1 col-md-4">
                                            <label class="form-label" for="username">{{ __('tran.free_tatorul') }}
                                                :</label>
                                            <select class="form-select" wire:model.lazy='free_tatorul' required>
                                                <option value=""> اختار قسم الشرح المجانى</option>
                                                @foreach ($categoryfreecourse as $item)
                                                <option value="{{ $item->id }}"> {{ $item->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('free_tatorul')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-1 col-md-12">
                                            <label class="form-label" for="username">{{ __('tran.trainers') }}</label>
                                            <div wire:ignore>
                                                <select class="select2 form-select" id="select2-multiple" multiple="multiple" required>
                                                    @foreach ($triners as $item)
                                                    <option @if (in_array($item->id, $triner)) selected @endif
                                                        value="{{ $item->id ?? '' }}">
                                                        {{ ($item->first_name ?? '') . ' ' . ($item->middle_name ?? '') }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('triner')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="mb-1 col-md-12">
                                            <label class="form-label" for="username">{{ __('tran.features') . ' ' . __('tran.course') }}</label>
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
                                            <x-summernote wire:model='howtostart' name="howtostart" id="howtostart" value='{{ $howtostart }}' />
                                            @error('howtostart')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1 col-md-12">
                                            <label class="form-label" for="">{{ __('tran.answer_the_question') }}</label>
                                            <x-summernote wire:model='answer_the_question' name="answer_the_question" id="answer_the_question" value='{{ $answer_the_question }}' />
                                            @error('answer_the_question')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-1 col-md-12">
                                            <label class="form-label" for="">{{ __('tran.sections_guide') }}</label>
                                            <x-summernote wire:model='sections_guide' name="sections_guide" id="sections_guide" value='{{ $sections_guide }}' />
                                            @error('sections_guide')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider divider-danger">
                        <div class="divider-text">{{ __('tran.attached') }}</div>
                    </div>
                    <div class="accordion-item" wire:ignore.self>
                        <h2 class="accordion-header  d-flex align-items-center justify-content-between" id="headingMarginOne2">
                            <div class="d-flex align-items-center">
                                <button wire:ignore.self class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne2" aria-expanded="false" aria-controls="accordionMarginOne2">
                                    <span class="text-warning">
                                        {{ __('tran.attached') }}
                                    </span>

                                </button>
                            </div>
                        </h2>
                        <div id="accordionMarginOne2" class="accordion-collapse collapse" aria-labelledby="headingMarginOne2" data-bs-parent="#accordionMargin" wire:ignore.self>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-2 col-md-6">
                                            <x-imageupload wire:model='image_course' :height='200' :width='200' :imagenew="$image_course" :tlabel="__('tran.imagecourse')" />
                                            @error('image_course')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-6">
                                            <x-imageupload wire:model='calc_rate' :height='200' :width='200' :imagenew="$calc_rate" :tlabel="__('tran.calc_rate')" />
                                            @error('calc_rate')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-3  border border-black pb-2">
                                            <x-fileupload wire:model='schedule' id='schedule' :tlabel="__('tran.courseschedule')" :namefile="$schedule != null ? $schedule : null" />
                                            @error('schedule')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-3  border border-black pb-2">
                                            <x-fileupload wire:model='file_work' id='file_work' :tlabel="__('tran.file_work')" :namefile="$file_work != null ? $file_work : null" />
                                            @error('file_work')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-3 border border-black pb-2">
                                            <x-fileupload wire:model='file_explanatory' id='file_explanatory' :tlabel="__('tran.file_explanatory')" :namefile="$file_explanatory != null ? $file_explanatory : null" />
                                            @error('file_explanatory')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-3 border border-black pb-2">
                                            <x-fileupload wire:model='file_aggregates' id='file_aggregates' :tlabel="__('tran.file_aggregates')" :namefile="$file_aggregates != null ? $file_aggregates : null" />
                                            @error('file_aggregates')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-3 border border-black pb-2">
                                            <x-fileupload wire:model='file_supplementary' id='file_supplementary' :tlabel="__('tran.file_supplementary')" :namefile="$file_supplementary != null ? $file_supplementary : null" />
                                            @error('file_supplementary')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-3 border border-black pb-2">
                                            <x-fileupload wire:model='file_free' id='file_free' :tlabel="__('tran.file_free')" :namefile="$file_free != null ? $file_free : null" />
                                            @error('file_free')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-2 col-md-3 border border-black pb-2">
                                            <x-fileupload wire:model='file_test' id='file_test' :tlabel="__('tran.file_test')" :namefile="$file_test != null ? $file_test : null" />
                                            @error('file_test')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider divider-danger">
                        <div class="divider-text">{{ __('tran.setcourse') }}</div>
                    </div>
                    <div class="accordion-item" wire:ignore.self>
                        <h2 class="accordion-header  d-flex align-items-center justify-content-between" id="headingMarginOne3">
                            <div class="d-flex align-items-center">
                                <button wire:ignore.self class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne3" aria-expanded="false" aria-controls="accordionMarginOne3">
                                    <span class="text-warning">{{ __('tran.setcourse') }}</span>
                                </button>
                            </div>
                        </h2>
                        <div id="accordionMarginOne3" class="accordion-collapse collapse" aria-labelledby="headingMarginOne3" data-bs-parent="#accordionMargin" wire:ignore.self>
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="mb-1 col-md-3">
                                            <x-check wire:model='langcourse' id="langcourse" left="En" right="Ar" :tlabel="__('tran.langcourse')" />
                                        </div>
                                        <div class="mb-1 col-md-3">
                                            <x-check wire:model='inputnum' id="inputnum" left="En" right="Ar" :tlabel="__('tran.inputnum')" />
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
                                            <label class="form-label" for="telegramgrup">{{ __('tran.telegramgrup') }}</label>
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
                                            <select class="form-select" wire:model='nextcourse'>
                                                <option value="">اختار الدورة التالية</option>
                                                @if(!empty($nextcoursesbycat ))
                                                @foreach ($nextcoursesbycat as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name }}
                                                </option>
                                                @endforeach
                                                @endif

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
                            </div>
                        </div>

                    </div>

                    {{-- <div class="divider divider-danger">
                        <div class="divider-text">{{ __('tran.lessons') }}</div>
                    </div> --}}
                    {{-- <div class="accordion-item" wire:ignore.self>
                        <h2 class="accordion-header  d-flex align-items-center justify-content-between" id="headingMarginOne4">
                            <div class="d-flex align-items-center">
                                <button wire:ignore.self class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne4" aria-expanded="false" aria-controls="accordionMarginOne4">
                                    <span class="text-warning">{{ __('tran.lessons') }}</span>
                                </button>
                            </div>
                            <div wire:click="addlesson()" class="button-group p-1">
                                <button onclick="event.preventDefault();" class="btn btn-success btn-sm">اضافة دروس</button>
                            </div>
                        </h2>
                        <div id="accordionMarginOne4" class="accordion-collapse collapse" aria-labelledby="headingMarginOne4" data-bs-parent="#accordionMargin" wire:ignore.self>
                            <div class="card">

                                <div class="card-body"  >
                                    @if(!empty($lessons))
                                    @if (count($lessons) > 0)
                                    <ul wire:sortable="updateTaskOrder">

                                        @foreach ($lessons as $key => $value)
                                        <li wire:sortable.item="{{ $lessons[$key]['per']}}" wire:key="task-{{ $lessons[$key]['per']}}">


                                            <div class="mb-1 row" >
                                                <div wire:sortable.handle style="cursor: move;">*</div>

                                                <div class="col-md-2 form-check form-check-inline ">
                                                    <select class="form-select" id="lessons.{{ $key }}.is_lesson" wire:model.lazy='lessons.{{ $key }}.is_lesson'>

                                                        @foreach (\App\Enum\LessonStatu::cases() as $q)
                                                        <option value="{{ $q->value }}">
                                                            {{ __('tran.typelesson-' . $q->name) }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    @error('lessons.' . $key . '.is_lesson')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-3">
                                                    <select class="form-select" wire:model='lessons.{{ $key }}.stage_id' required>
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
                                                    <x-daterange wire:model='lessons.{{ $key }}.publish_at' id="lessons.{{ $key }}.publish_at" />
                                                    @error('lessons.' . $key . '.publish_at')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @if ($lessons[$key]['is_lesson'] != false)
                                                <div class="col">
                                                    <input class="form-control" wire:model="lessons.{{ $key }}.name" placeholder="{{ $lessons[$key]['is_lesson'] == 1 ? 'اسم الشرح' : ($lessons[$key]['is_lesson'] == 0 ? 'اسم تدريب' : 'اسم بث مباشر') }}" type="text" />
                                                    @error('lessons.' . $key . '.name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col">

                                                    <input class="form-control" wire:model="lessons.{{ $key }}.link" type="text" placeholder="{{ $lessons[$key]['is_lesson'] == 1 ? 'رابط الشرح' : ($lessons[$key]['is_lesson'] == 0 ? 'رابط تدريب' : 'رابط بث مباشر') }}" />

                                                    @error('lessons.' . $key . '.link')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @else
                                                <div class="col">
                                                    <input class="form-control" wire:model="lessons.{{ $key }}.name" placeholder="{{ $lessons[$key]['is_lesson'] != false ? 'اسم شرح' : ' اسم تدريب' }}" type="text" />
                                                    @error('lessons.' . $key . '.name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    @if ($lessons[$key]['link'] != null)
                                                    <a target="_blank" class="btn btn-warning btn-sm" href="{{ route('viewquestion') . '/' . $lessons[$key]['link'] }}">تعديل
                                                        التدريب</a>
                                                    @else
                                                    <x-model wire:model='questions' :questions='$questions' :keys='$key' />
                                                    <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#fullscreenModal-{{ $key }}">
                                                        اضافه تدريب
                                                    </button>
                                                    @endif
                                                </div>
                                                @endif

                                                <div class="col-1">
                                                    <button wire:click='removelesson({{ $key }})' onclick="event.preventDefault();" type="button" class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center rounded-circle
                                            bg-red-600 hover:bg-red-800 text-white shadow-lg hover-shadow-xl
                                            transition duration-150 ease-in-out focus:bg-red-700 outline-none focus-outline-none" style="height: 2rem; width: 2rem; ">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div> --}}
                </div>
                <div class="card-footer">
                    <button wire:loading.attr="disabled" type="submit" class="btn btn-success btn-submit">حفظ</button>
                </div>

        </form>
    </div>
</div>
@push('csslive')

<link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('jslive')

<script src="{{ asset('asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
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
            title: event.detail.message
            , icon: 'info'
            , customClass: {
                confirmButton: 'btn btn-danger'
            }
            , buttonsStyling: false
        });
    })
    window.addEventListener('openmodel', event => {
        // console.log('www');
        $('#editUser').modal("show");

    });
    window.addEventListener('closemodel', event => {
        // console.log('www');
        $('#editUser').modal("hide");

    });

</script>
@endpush
