<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Center</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs justify-content-center" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" id="section1-tab-center" data-bs-toggle="tab" href="#section1-center"
                        aria-controls="section1-center" role="tab"
                        aria-selected="false">{{ __('tran.section1') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="section2-tab-center" data-bs-toggle="tab" href="#section2-center"
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
                    <a class="nav-link" id="section5-center" data-bs-toggle="tab" href="#section5-center"
                        aria-controls="ection5-center" role="tab"
                        aria-selected="false">{{ __('tran.section5') }}</a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="section1-center" aria-labelledby="section1-tab-center" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Setting Home</h4>
                        </div>
                        <div class="card-body">
                            <form  class="row" wire:submit.prevent="save('footer_setting')" >
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
                                    <input type="text" class="form-control" wire:model="data.footer_setting.address"
                                       required />
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
                                    <input type="text" class="form-control" wire:model="data.footer_setting.facebook"
                                       required />
                                    @error('facebook')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="instegram">{{ __('tran.instegram') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.instegram"
                                       required />
                                    @error('instegram')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="telegram">{{ __('tran.telegram') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.telegram"
                                       required />
                                    @error('telegram')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="linkedin">{{ __('tran.linkedin') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.linkedin"
                                       required />
                                    @error('linkedin')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="youtube">{{ __('tran.youtube') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.youtube"
                                       required />
                                    @error('youtube')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="description">{{ __('tran.description') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.description"
                                       required />
                                    @error('description')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 col-md-6">
                                    <label class="form-label" for="copyright">{{ __('tran.copyright') }}</label>
                                    <input type="text" class="form-control" wire:model="data.footer_setting.copyright"
                                       required />
                                    @error('copyright')
                                        <span class="error" style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 text-center mt-2 pt-50">
                                    <button type="submit" class="btn btn-primary me-1">{{ __('tran.save') }}</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="section2-center" aria-labelledby="section2-tab-center" role="tabpanel">

                    Pie fruitcake lollipop. Chupa chups apple pie marzipanddddddddddddd danish soufflé soufflé oat cake
                    gingerbread.
                    Bonbon jujubes donut gummies sesame snaps cookie gingerbread cotton candy pastry. Biscuit sugar
                    plum

                </div>
                <div class="tab-pane" id="section3-center" aria-labelledby="section3-tab-center" role="tabpanel">

                    Pie fruitcake lollipop. Chupa chups apple pie marzipan danish soufflé soufflé oat cake
                    gingerbread.
                    Bonbon jujubes donut gummies sesame snaps cookie gingerbread cotton candy pastry. Biscuit sugar
                    plum

                </div>
                <div class="tab-pane" id="section4-center" aria-labelledby="section4-tab-center" role="tabpanel">

                    Pie fruitcake lollipop. Chupa chups apple pie marzipan danish soufflé soufflé oat cake
                    gingerbread.
                    Bonbon jujubes donut gummies sesame snaps cookie gingerbread cotton candy pastry. Biscuit sugar
                    plum

                </div>
                <div class="tab-pane" id="section5-center" aria-labelledby="section5-tab-center" role="tabpanel">

                    Pie fruitcake lollipop. Chupa chups apple pie marzipan danish soufflé soufflé oat cake
                    gingerbread.
                    Bonbon jujubes donut gummies sesame snaps cookie gingerbread cotton candy pastry. Biscuit sugar
                    plum
                </div>

            </div>
        </div>
    </div>
</div>
