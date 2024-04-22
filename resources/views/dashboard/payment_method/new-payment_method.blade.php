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
                        <div class="col-12 col-md-12">
                            <x-imageupload wire:model='image' :imagenew="$image" :imageold="$imagold" />
                            @error('image')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.name') }}</label>
                            <input type="text" class="form-control" wire:model="name" required />
                            @error('name')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstaccount_name">{{ __('tran.account_name') }}</label>
                            <input type="text" class="form-control" wire:model="account_name" required />
                            @error('account_name')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.iban_number') }}</label>
                            <input type="text" class="form-control" wire:model="iban_number" required />
                            @error('iban_number')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstaccount_number">{{ __('tran.account_number') }}</label>
                            <input type="text" class="form-control" wire:model="account_number" required />
                            @error('account_number')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="d-flex flex-column">
                                <label class="form-check-label mb-50" for="type">
                                    {{ __('tran.typemethod') }}</label>
                                <div class="form-check form-switch form-check-success">
                                    <input type="checkbox" class="form-check-input" wire:model='type'
                                        id="type" />
                                    <label class="form-check-label " for="type">
                                        <span class="switch-icon-left"> Online</span>
                                        <span class="switch-icon-right">Offline</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if ($edit)
                            <div class="col-12 col-md-6">
                                <div class="d-flex flex-column">
                                    <label class="form-check-label mb-50" for="active">
                                        {{ __('tran.active') }}</label>
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
