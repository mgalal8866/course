<div>

    <div wire:ignore.self class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{$header}}</h1>
                    </div>
                    <form id="editUserForm" class="row gy-1 pt-75"  wire:submit.prevent="save">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{__('tran.name')}}</label>
                            <input type="text"  class="form-control"  wire:model="name" />
                          @error('name') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{__('tran.specialist')}}</label>
                            <input type="text"  class="form-control"  wire:model="specialist" />
                          @error('specialist') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{__('tran.gender')}}</label>
                            <select class="form-select" wire:model='category_id'>
                                <option value=""> النوع</option>
                                <option value="1">{{ __('tran.male') }}</option>
                                <option value="2">{{ __('tran.female') }}</option>
                            </select>
                             @error('gender') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{__('tran.mail')}}</label>
                            <input type="text"  class="form-control"  wire:model="mail" />
                          @error('mail') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{__('tran.phone')}}</label>
                            <input type="text"  class="form-control"  wire:model="phone"  />
                          @error('phone') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{__('tran.country')}}</label>
                            <input type="text"  class="form-control"  wire:model="country" />
                          @error('country') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="modalEditUserFirstName">{{__('tran.balance')}}</label>
                            <input type="text"  class="form-control"  wire:model="balance" />
                          @error('c') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1" >{{__('tran.save')}}</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                {{__('tran.cancel')}}
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
