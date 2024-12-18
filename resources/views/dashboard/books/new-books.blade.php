<div>

    <div wire:ignore.self class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-edit-user">
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
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.book_name') }}</label>
                            <input type="text" class="form-control" wire:model="book_name" />
                            @error('book_name')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalEditUserFirsttype">{{ __('tran.type') }}</label>
                            <select class="form-select" wire:model.live='type' required>
                                <option value="">نوع الكتاب</option>
                                <option value="0">كتاب مطبوع</option>
                                <option value="1">كتاب الكترونى (PDF)</option>
                            </select>

                            @error('type')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        @if ($type == 1)
                            <div class="col-12 col-md-12">
                                <x-fileupload wire:model='link' id='file_test' :tlabel="__('tran.link')"
                                :namefile="$link != null ? $link->getClientOriginalName() : null" />
                                @error('link')
                                    <span class="error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <div class="col-12 col-md-12">

                            {{-- <label class="form-label" for="">{{ __('tran.features') }}</label> --}}
                            {{-- <x-summernote wire:model='features' name="features" id="features"
                                value="{{ $features }}" />
                            @error('features')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror --}}
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.features') }}</label>
                            <textarea type="text" class="form-control" wire:model="features"></textarea>
                            @error('features')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.category') }}</label>
                            <select class="form-select" wire:model='category_id' required>
                                <option value=""> اختيارالقسم</option>
                                   
                                @foreach ($categorys as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.qty_max') }}</label>
                            <input type="number" class="form-control" wire:model="qty_max" />
                            @error('qty_max')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.price') }}</label>
                            <input type="text" class="form-control" wire:model="price" />
                            @error('price')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
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
