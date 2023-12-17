<div>
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
                            <span class="bs-stepper-subtitle">{{ $pages[1]['subheading'] }}</span>
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
                            <span class="bs-stepper-subtitle">{{ $pages[2]['subheading'] }}</span>
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
                            <span class="bs-stepper-subtitle">{{ $pages[3]['subheading'] }}</span>
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
                            <span class="bs-stepper-subtitle">{{ $pages[4]['subheading'] }}</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form wire:submit.prevent='save'>
                    @if ($currentPage == 1)
                        <div id="account-details" class="content {{ $currentPage == 1 ? 'active' : '' }}  ">
                            <div class="content-header">
                                <h5 class="mb-0">{{ __('tran.datacourse') }}</h5>
                                <small class="text-muted">{{ $pages[1]['subheading'] }}</small>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="username">{{ __('tran.title') }}</label>
                                    <input type="text" class="form-control" wire:model='name' />
                                    @error('name')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-1 col-md-12">
                                    <label class="form-label" for="description">{{ __('tran.description') }}</label>
                                    <textarea type="description" class="form-control" wire:model='description'></textarea>
                                    @error('description')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label"
                                        for="modalEditUserFirstName">{{ __('tran.category') }}</label>
                                    <select class="form-select" wire:model='category_id'>
                                        <option value=""> اختيارالقسم</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="username">{{ __('tran.price') }}</label>
                                    <input type="text" class="form-control" wire:model='price' />
                                    @error('price')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.startdate') }}</label>
                                    <input type="text" class="form-control" wire:model='startdate' />
                                    @error('startdate')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.enddate') }}</label>
                                    <input type="text" class="form-control" wire:model='enddate' />
                                    @error('enddate')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.time') }}</label>
                                    <input type="text" class="form-control" wire:model='time' />
                                    @error('time')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="username">{{ __('tran.features') }}</label>
                                    <textarea type="text" class="form-control" wire:model='features'></textarea>
                                    @error('features')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="username">{{ __('tran.trainers') }}</label>
                                    {{-- <x-selectc :items='$triners' :display=''= /> --}}
                                    <select class="select2 form-select" id="select2-multiple"
                                        wire:model='triners' multiple>
                                        @foreach ($triners as $item)
                                            <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <input type="text" class="form-control" wire:model='trainer' /> --}}
                                    @error('triners')
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
                                <div class="mb-1 col-md-4">
                                    <label class="form-label" for="username">{{ __('tran.duration_course') }}</label>
                                    <input type="text" class="form-control" wire:model='duration_course' />
                                    @error('duration_course')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    @elseif ($currentPage == 2)
                        <div id="personal-info" class="content {{ $currentPage == 2 ? 'active' : '' }}"
                            role="tabpanel" aria-labelledby="personal-info-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">{{ __('tran.attached') }}</h5>
                                <small class="text-muted">{{ $pages[2]['subheading'] }}</small>
                            </div>
                        </div>
                    @elseif ($currentPage == 3)
                        <div id="address-step" class="content {{ $currentPage == 3 ? 'active' : '' }} "
                            role="tabpanel" aria-labelledby="address-step-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">{{ __('tran.lessons') }}</h5>
                                <small class="text-muted">{{ $pages[3]['subheading'] }}</small>
                            </div>

                        </div>
                    @elseif ($currentPage == 4)
                        <div id="social-links" class="content {{ $currentPage == 4 ? 'active' : '' }} "
                            role="tabpanel" aria-labelledby="social-links-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">{{ __('tran.setcourse') }}</h5>
                                <small class="text-muted">{{ $pages[4]['subheading'] }}</small>
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
                        @if ($currentPage === count($pages))
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
        var select = $('.select2');
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div wire:ignore class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
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
            // console.log('www');
            $('#editUser').modal("show");

        });
        window.addEventListener('closemodel', event => {
            // console.log('www');
            $('#editUser').modal("hide");

        });
    </script>
@endpush
