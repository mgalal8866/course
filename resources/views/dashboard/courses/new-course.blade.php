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
                                        for="modalEditUserFirstName">{{ __('tran.country') }}</label>
                                    <select class="form-select" wire:model='country_id' required>
                                        <option value=""> اختيار الدولة</option>
                                        @foreach ($country as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.price') }}</label>
                                    <div class="input-group input-group-merge">
                                        <select class=" form-select"  wire:model='pricewith' >
                                            <option value="">اختار الملحقات</option>
                                            <option value="1">PDF شامل كتاب الدورة</option>
                                            <option value="2">بدون كتاب الدورة</option>
                                        </select>
                                        <input type="text" class="form-control" wire:model='price' />
                                    </div>

                                    @error('price')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.startdate') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <x-daterange wire:model='startdate' id="startdate" required />
                                    </div>
                                    @error('startdate')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.enddate') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        <x-daterange wire:model='enddate' id="enddate" required />
                                    </div>
                                    @error('enddate')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.time') }}</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                        <input type="text" class="form-control" wire:model='time' required />
                                    </div>
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
                                    <input type="text" class="form-control" wire:model='limit_stud' />
                                    @error('limit_stud')
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
                                                    value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}
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
                                    <textarea type="text" class="form-control" wire:model='features' required></textarea>
                                    @error('features')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="description">{{ __('tran.description') }}</label>
                                    <x-editorforcource wire:model='description' name="description"
                                        id="description" />
                                    @error('description')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="conditions">{{ __('tran.conditions') }}</label>
                                    <x-editorforcource wire:model='conditions' name="conditions" id="conditions" />
                                    @error('conditions')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="">{{ __('tran.target') }}</label>
                                    <x-editorforcource wire:model='target' name="target" id="target" />
                                    @error('target')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="">{{ __('tran.howtostart') }}</label>
                                    <x-editorforcource wire:model='howtostart' name="howtostart" id="howtostart" />
                                    @error('howtostart')
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
                                <div class="mb-2 col-md-12">
                                    <x-imageupload wire:model='image_course' :height='200' :width='200'
                                        :imagenew="$image_course" :tlabel="__('tran.imagecourse')" />
                                    @error('image')
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
                                    @error('image')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_aggregates' id='file_aggregates' :tlabel="__('tran.file_aggregates')"
                                        :namefile="$file_aggregates != null
                                            ? $file_aggregates->getClientOriginalName()
                                            : null" />
                                    @error('image')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_supplementary' id='file_supplementary'
                                        :tlabel="__('tran.file_supplementary')" :namefile="$file_supplementary != null
                                            ? $file_supplementary->getClientOriginalName()
                                            : null" />
                                    @error('image')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_free' id='file_free' :tlabel="__('tran.file_free')"
                                        :namefile="$file_free != null ? $file_free->getClientOriginalName() : null" />
                                    @error('image')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-2 col-md-3 border border-black pb-2">
                                    <x-fileupload wire:model='file_test' id='file_test' :tlabel="__('tran.file_test')"
                                        :namefile="$file_test != null ? $file_test->getClientOriginalName() : null" />
                                    @error('image')
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
                                    <div class="col">
                                        <select class="form-select" wire:model='lessons.{{ $key }}.stage_id' required>
                                            <option value=""> اختار المرحلة</option>
                                            @foreach ($stages as $c)
                                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('lessons.' . $key . '.stage_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col border border-black ">
                                        <x-fileupload class="mb-0" wire:model='lessons.{{ $key }}.img'
                                            id='lessons.{{ $key }}.img' :namefile="$lessons[$key]['img'] != null
                                                ? $lessons[$key]['img']->getClientOriginalName()
                                                : null" />
                                        @error('lessons.' . $key . '.img')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col">
                                        <input class="form-control" wire:model="lessons.{{ $key }}.name"
                                            placeholder="name" type="text" />
                                        @error('lessons.' . $key . '.name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <input class="form-control" wire:model="lessons.{{ $key }}.link"
                                            type="text" placeholder="{{ $key }}" />
                                        @error('lessons.' . $key . '.link')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-1">
                                        <div class="form-check form-switch form-check-success ">
                                            <input type="checkbox" class="form-check-input"
                                                wire:model="lessons.{{ $key }}.status"
                                                id="{{ $key }}s" />
                                            <label class="form-check-label" for='{{ $key }}s'>
                                                <span class="switch-icon-left">
                                                    <i class="fas fa-dollar-sign"></i>
                                                </span>
                                                <span class="switch-icon-right">
                                                    <i class="fas fa-times"></i>
                                                </span>

                                            </label>
                                        </div>

                                    </div>
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
                                        <input type="text" class="form-control" wire:model='telegram' required />
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
                                        <input type="text" class="form-control" wire:model='telegramgrup'
                                            required />
                                    </div>
                                    @error('telegramgrup')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="nextcourse">{{ __('tran.nextcourse') }}</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" wire:model='nextcourse'
                                            required />
                                    </div>
                                    @error('nextcourse')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between">
                        <button class="btn {{ $currentPage > 1 ? 'btn-primary' : 'btn-outline-secondary' }} btn-prev"
                            {{ $currentPage == 1 ? 'disabled' : '' }} wire:click.prevent="goToPerviousPage">
                            <i
                                class="fas fa-arrow-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right' : 'left' }}  align-middle ms-sm-25 ms-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">{{ __('tran.previous') }}</span>
                        </button>
                        @if ($currentPage === $pages)
                            <button type="submit" class="btn btn-success btn-submit">
                                {{ __('tran.submit') }}</button>
                        @else
                            <button class="btn btn-primary btn-next" wire:click.prevent="goToNextPage">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('jslive')
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
        (function(window, document, $) {
            'use strict';

            var timePickr = $('.flatpickr-time');
            if (timePickr.length) {
                timePickr.flatpickr({
                    enableTime: true,
                    noCalendar: true
                });
            }
        });
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
            // console.log('www');
            $('#editUser').modal("show");

        });
        window.addEventListener('closemodel', event => {
            // console.log('www');
            $('#editUser').modal("hide");

        });
    </script>
@endpush
