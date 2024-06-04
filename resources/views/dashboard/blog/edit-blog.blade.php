<div wire:ignore.self>
    <div class="card outline-success">
        <div class="card-header">
            <h4 class="card-title">{{ __('tran.edit') . ' ' . __('tran.blog') }}</h4>
        </div>
        <div class="card-body">

        <form id="editUserForm" class="row gy-1 pt-75" enctype="multipart/form-data" wire:submit.prevent="save">

            <div class="col-12 col-md-12">
                <x-imageupload wire:model='image' :imagenew="$image" :imageold="$imageold" />
                @error('image')
                    <span class="error" style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">{{ __('tran.country') }}</label>
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
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">{{ __('tran.category') }}</label>
                <select class="form-select" wire:model='category_id' required>
                    <option value=""> اختيار ألقسم</option>
                    @foreach ($categoryblog as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="error" style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">{{ __('tran.title') }}</label>
                <input type="text" class="form-control" wire:model="title" required />
                @error('title')
                    <span class="error" style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-12 col-md-6">
                <label class="form-label" for="modalEditUserFirstName">{{ __('tran.writer') }}</label>
                <input type="text" class="form-control" wire:model="writer" required />
                @error('writer')
                    <span class="error" style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-12 col-md-12"  >
                <label class="form-label" for="modalEditUserFirstName">{{ __('tran.article') }}</label>

                <x-summernote  wire:model='article' name="article" id="article" value='{{ $article }}' />
                @error('article')
                    <span class="error" style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="col-12 col-md-6">
                <div class="d-flex flex-column">
                    <label class="form-check-label mb-50" for="active">
                        {{ __('tran.statu') }}</label>
                    <div class="form-check form-switch form-check-success">
                        <input type="checkbox" class="form-check-input" wire:model='active' id="active" />
                        <label class="form-check-label" for="active">
                            <span class="switch-icon-left"><i data-feather="check"></i></span>
                            <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                    </div>
                </div>
            </div>


            <div class="col-12 text-center mt-2 pt-50">

                <button wire:loading.attr="disabled" type="submit" class="btn btn-primary me-1">
                    <div wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                    {{ __('tran.save') }}
                </button>
                <button   class="btn btn-outline-secondary" wire:click="cancel()">

                    {{ __('tran.cancel') }}
                </button>
            </div>
        </form>

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
    </script>
@endpush
