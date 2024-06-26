<div>
    <div wire:ignore.self class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{ $header }}</h1>
                    </div>
                    <form id="editUserForm" class="row gy-1 pt-75" wire:submit.prevent="save">

                        <div class=" col-md-4">
                            <label class="form-label"
                                for="modalEditUserFirstfirst_name">{{ __('tran.first_name') }}</label>
                            <input type="text" class="form-control" wire:model="first_name"
                                data-msg="Please enter your fisssssssrst first_name" required />
                            @error('first_name')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label class="form-label"
                                for="modalEditUserFirstmiddle_name">{{ __('tran.middle_name') }}</label>
                            <input type="text" class="form-control" wire:model="middle_name"
                                data-msg="Please enter your fisssssssrst middle_name" required />
                            @error('middle_name')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" col-md-4">
                            <label class="form-label"
                                for="modalEditUserFirstlast_name">{{ __('tran.last_name') }}</label>
                            <input type="text" class="form-control" wire:model="last_name"
                                data-msg="Please enter your fisssssssrst last_name" required />
                            @error('last_name')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.mail') }}</label>
                            <input type="text" class="form-control" wire:model="mail" required />
                            @error('mail')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.phone') }}</label>
                            <input type="text" class="form-control" wire:model="phone" readonly />
                            @error('phone')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstpoint">{{ __('tran.point') }}</label>
                            <input type="text" class="form-control" wire:model="point" readonly />
                            @error('point')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.wallet') }}</label>
                            <input type="text" class="form-control" wire:model="wallet" readonly />
                            @error('wallet')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.specialist') }}</label>
                            <select class="form-select" wire:model='specialist' required>
                                <option value="">{{ __('tran.select') . ' ' . __('tran.specialist') }}</option>
                                @foreach ($spec as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('specialist')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div> --}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.gender') }}</label>
                            <select class="form-select" wire:model='gender' required>
                                <option value=""> {{ __('tran.select') . ' ' . __('tran.gender') }}</option>
                                <option value="1">{{ __('tran.male') }}</option>
                                <option value="2">{{ __('tran.female') }}</option>
                            </select>
                            @error('gender')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.country') }}</label>
                            <select class="form-select" wire:model='country' required>
                                <option value=""> {{ __('tran.select') . ' ' . __('tran.country') }}</option>
                                @foreach ($countrylist as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('country')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        @if ($edit)
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50" for="active">
                                        {{ __('tran.statu') }}</label>
                                    <div class="form-check form-switch form-check-success">
                                        <input type="checkbox" class="form-check-input" wire:model='active'
                                            id="active" />
                                        <label class="form-check-label" for="active">
                                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="divider divider-info">
                            <div class="divider-text">{{ __('tran.coupon') }}</div>
                        </div>
                        <div class="card shadow-none bg-transparent border-info">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label class="form-label"
                                            for="modalEditUserFirstName">{{ __('tran.entercoupon') }}</label>
                                        <input type="text" class="form-control" wire:model="coupon" required />
                                        @error('coupon')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label"
                                            for="modalEditUserFirstName">{{ __('tran.discoupon') }}</label>
                                        <input type="text" class="form-control" wire:model="discount" required />
                                        @error('discount')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label"
                                            for="modalEditUserFirstName">{{ __('tran.collect_point_user') }}</label>
                                        <input type="text" class="form-control" wire:model="collect_point_user"
                                            required />
                                        @error('collect_point_user')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label class="form-label"
                                            for="modalEditUserFirstName">{{ __('tran.exchange_price') }}</label>
                                        <input type="text" class="form-control" wire:model="exchange_price"
                                            required />
                                        @error('exchange_price')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="d-flex flex-column">
                                            <label class="form-check-label mb-50" for="coupon_active">
                                                {{ __('tran.active') }}</label>
                                            <div class="form-check form-switch form-check-success">
                                                <input type="checkbox" class="form-check-input" wire:model='coupon_active'
                                                    id="coupon_active" />
                                                <label class="form-check-label" for="coupon_active">
                                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{ __('tran.save') }}</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                {{ __('tran.cancel') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('jslive')
    <script>
        window.addEventListener('swal', event => {
            Swal.fire({
                title: event.message,
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
