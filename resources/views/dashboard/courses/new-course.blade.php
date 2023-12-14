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
                            <span class="bs-stepper-title">{{ $pages[1]['heading'] }}</span>
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
                            <span class="bs-stepper-title">{{ $pages[2]['heading'] }}</span>
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
                            <span class="bs-stepper-title">{{ $pages[3]['heading'] }}</span>
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
                            <span class="bs-stepper-title">{{ $pages[4]['heading'] }}</span>
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
                                <h5 class="mb-0">{{ $pages[1]['heading'] }}</h5>
                                <small class="text-muted">{{ $pages[1]['subheading'] }}</small>
                            </div>
                            <div class="row">
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="username">name</label>
                                    <input type="text" class="form-control" wire:model='name' />
                                    @error('name')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-1 col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" aria-label="john.doe"
                                        wire:model='email' />
                                    @error('email')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>

                        </div>
                    @elseif ($currentPage == 2)
                        <div id="personal-info" class="content {{ $currentPage == 2 ? 'active' : '' }}" role="tabpanel"
                            aria-labelledby="personal-info-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">{{ $pages[2]['heading'] }}</h5>
                                <small class="text-muted">{{ $pages[2]['subheading'] }}</small>
                            </div>


                        </div>
                    @elseif ($currentPage == 3)
                        <div id="address-step" class="content {{ $currentPage == 3 ? 'active' : '' }} " role="tabpanel"
                            aria-labelledby="address-step-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">{{ $pages[3]['heading'] }}</h5>
                                <small class="text-muted">{{ $pages[3]['subheading'] }}</small>
                            </div>

                        </div>
                    @elseif ($currentPage == 4)
                        <div id="social-links" class="content {{ $currentPage == 4 ? 'active' : '' }} " role="tabpanel"
                            aria-labelledby="social-links-trigger">
                            <div class="content-header">
                                <h5 class="mb-0">{{ $pages[4]['heading'] }}</h5>
                                <small class="text-muted">{{ $pages[4]['subheading'] }}</small>
                            </div>

                        </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <button class="btn {{ $currentPage > 1 ? 'btn-primary' : 'btn-outline-secondary' }} btn-prev"
                            {{ $currentPage == 1 ? 'disabled' : '' }} wire:click.prevent="goToPerviousPage">
                            <i
                                class="fas fa-arrow-{{ LaravelLocalization::getCurrentLocaleDirection() == 'rtl' ? 'right' : 'left' }}  align-middle ms-sm-25 ms-0"></i>
                            <span class="align-middle d-sm-inline-block d-none">Previous</span>
                        </button>
                        @if ($currentPage === count($pages))
                            <button type="submit" class="btn btn-success btn-submit">Submit</button>
                        @else
                            <button class="btn btn-primary btn-next" wire:click.prevent="goToNextPage">
                                <span class="align-middle d-sm-inline-block d-none">Next</span>
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

@push('jslive')
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
