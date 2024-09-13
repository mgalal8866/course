<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Center</h4>
            <a class="btn-success btn" wire:click='reloadesetting'><i class="fas fa-sync"></i></a>
        </div>
        <div class="card-body" >
            <ul class="nav nav-tabs justify-content-center" wire:ignore.self role="tablist">

                <li class="nav-item">
                    <a class="nav-link " id="section1-tab-center" data-bs-toggle="tab" href="#section1-center"
                        aria-controls="section1-center" role="tab"
                        aria-selected="false">{{ __('tran.section1') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="section2-tab-center" data-bs-toggle="tab" href="#section2-center"
                        aria-controls="section2-center" role="tab"
                        aria-selected="false">{{ __('tran.section2') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="section3-tab-center" data-bs-toggle="tab" href="#section3-center"
                        aria-controls="section3-center" role="tab"
                        aria-selected="false">{{ __('tran.section3') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="section4-tab-center" data-bs-toggle="tab" href="#section4-center"
                        aria-controls="section4-center" role="tab"
                        aria-selected="false">{{ __('tran.section4') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="section5-tab-center" data-bs-toggle="tab" href="#section5-center"
                        aria-controls="section5-center" role="tab"
                        aria-selected="false">{{ __('tran.section5') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " id="footer_setting-tab-center" data-bs-toggle="tab"
                        href="#footer_setting-center" aria-controls="footer_setting-center" role="tab"
                        aria-selected="false">{{ __('tran.footer_setting') }}</a>
                </li>

            </ul>
            <div class="tab-content"  wire:ignore.self >
                <div class="tab-pane "  wire:ignore.self id="section1-center" aria-labelledby="section1-tab-center" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('tran.section1')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="row" wire:submit.prevent="save('section1_setting')">
                                <div class=" col-md-6">
                                    <div class="form-check form-check-success">
                                        <label class="form-label" for="section1_title">{{ __('tran.status') }}</label>
                                        <input type="checkbox" class="form-check-input" id="section1_status"
                                            wire:model='data.section1_setting.section1_status'
                                            {{ $data['section1_setting']['section1_status'] == 1 ? 'checked' : '' }} />
                                    </div>
                                    {{-- <x-swich wire:model='data.section1_setting.section1_status'/> --}}
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="section1_title">{{ __('tran.title') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section1_setting.section1_title" required />
                                    @error('section1_title')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label"
                                        for="section1_sub_title">{{ __('tran.sub_title') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section1_setting.section1_sub_title" required />
                                    @error('section1_sub_title')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="section1_body">{{ __('tran.body') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section1_setting.section1_body" required />
                                    @error('section1_body')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit"
                                        class="btn btn-primary me-1">{{ __('tran.save') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane active"   wire:ignore.self id="section2-center" aria-labelledby="section2-tab-center" role="tabpanel">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('tran.section2')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="row" wire:submit.prevent="save('section2_setting')">
                                <div class="form-check form-check-success">
                                    <label class="form-label" for="section2_title">{{ __('tran.status') }}</label>
                                    <input type="checkbox" class="form-check-input" id="section2_status"
                                        wire:model='data.section2_setting.section2_status'
                                        {{ $data['section2_setting']['section2_status'] == 1 ? 'checked' : '' }} />
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="section2_title">{{ __('tran.title') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section2_setting.section2_title" required />
                                    @error('section2_title')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-md-6" >
                                    {{-- <div class="mb-2 col-md-6"> --}}

                                         <x-imageupload wire:model='data.section2_setting.section2_image'  id='dataimage2'  :imageold="$data['section2_setting']['section2_image']" :height='200' :width='200' :imagenew="$image1" :tlabel="__('tran.imagecourse')" />
                                        {{-- @error('image_course')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div> --}}
                                        {{-- <img src="{{ path('','home') .  $data['section2_setting']['section2_image'] }}" id="account-upload-img"
                                        class="uploadedAvatar rounded me-50" alt="image" height="150" width="150"
                                        style="display: block;border: 1px solid ;" />--}}
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="section2_body">{{ __('tran.body') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section2_setting.section2_body" required />
                                    @error('section2_body')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit"
                                        class="btn btn-primary me-1">{{ __('tran.save') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane"  wire:ignore.self id="section3-center" aria-labelledby="section3-tab-center" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('tran.section3')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="row" wire:submit.prevent="save('section3_setting')">
                                <div class="form-check form-check-success">
                                    <label class="form-label" for="section3_title">{{ __('tran.status') }}</label>
                                    <input type="checkbox" class="form-check-input" id="section3_status"
                                        wire:model='data.section3_setting.section3_status'
                                        {{ $data['section3_setting']['section3_status'] == 1 ? 'checked' : '' }} />
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="section3_title">{{ __('tran.title') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section3_setting.section3_title" required />
                                    @error('section3_title')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit"
                                        class="btn btn-primary me-1">{{ __('tran.save') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane"  wire:ignore.self id="section4-center" aria-labelledby="section4-tab-center" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('tran.section4')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="row" wire:submit.prevent="save('section4_setting')">
                                <div class="form-check form-check-success">
                                    <label class="form-label" for="section4_title">{{ __('tran.status') }}</label>
                                    <input type="checkbox" class="form-check-input" id="section4_status"
                                        wire:model='data.section4_setting.section4_status'
                                        {{ $data['section4_setting']['section4_status'] == 1 ? 'checked' : '' }} />
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="section4_title">{{ __('tran.title') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section4_setting.section4_title" required />
                                    @error('section4_title')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="section4_body">{{ __('tran.body') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section4_setting.section4_body" required />
                                    @error('section4_body')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <x-imageupload wire:model="data.section4_setting.section4_image"   id='dataimage4'  :imageold="$data['section4_setting']['section4_image']" :height='200' :width='200' :imagenew="$image2" :tlabel="__('tran.imagecourse')" />

                                    {{-- <img src="{{ path('','home') .  $data['section4_setting']['section4_image'] }}" id="account-upload-img"
                                    class="uploadedAvatar rounded me-50" alt="image" height="150" width="150"
                                    style="display: block;border: 1px solid ;" /> --}}
                            </div>

                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit"
                                        class="btn btn-primary me-1">{{ __('tran.save') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="tab-pane"  wire:ignore.self id="section5-center" aria-labelledby="section5-tab-center" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('tran.section5')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="row" wire:submit.prevent="save('section5_setting')">
                                <div class="form-check form-check-success">
                                    <label class="form-label" for="section5_title">{{ __('tran.status') }}</label>
                                    <input type="checkbox" class="form-check-input" id="section5_status"
                                        wire:model='data.section5_setting.section5_status'
                                        {{ $data['section5_setting']['section5_status'] == 1 ? 'checked' : '' }} />
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="section5_title">{{ __('tran.title') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section5_setting.section5_title" required />
                                    @error('section5_title')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label"
                                        for="section5_sub_title">{{ __('tran.sub_title') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.section5_setting.section5_sub_title" required />
                                    @error('section5_sub_title')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit"
                                        class="btn btn-primary me-1">{{ __('tran.save') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane "  wire:ignore.self  id="footer_setting-center" aria-labelledby="footer_setting-tab-center"
                    role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{__('tran.footer_setting')}}</h4>
                        </div>
                        <div class="card-body">
                            <form class="row" wire:submit.prevent="save('footer_setting')">

                                <div class=" col-md-6">
                                    <label class="form-label" for="phone">{{ __('tran.phone') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.phone"
                                        required />
                                    @error('phone')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class=" col-md-6">
                                    <label class="form-label" for="address">{{ __('tran.address') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.address" required />
                                    @error('address')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="mail">{{ __('tran.mail') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.mail"
                                        required />
                                    @error('mail')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="facebook">{{ __('tran.facebook') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.facebook" required />
                                    @error('facebook')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="instegram">{{ __('tran.instegram') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.instegram" required />
                                    @error('instegram')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="telegram">{{ __('tran.telegram') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.telegram" required />
                                    @error('telegram')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="linkedin">{{ __('tran.linkedin') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.linkedin" required />
                                    @error('linkedin')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="youtube">{{ __('tran.youtube') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.youtube" required />
                                    @error('youtube')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="description">{{ __('tran.description') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.description" required />
                                    @error('description')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="copyright">{{ __('tran.copyright') }}</label>
                                    <input type="text" class="form-control"
                                        wire:model="data.footer_setting.copyright" required />
                                    @error('copyright')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit"
                                        class="btn btn-primary me-1">{{ __('tran.save') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
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
