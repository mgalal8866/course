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

                    <form id="editUserForm" class="row gy-1 pt-75" enctype="multipart/form-data" wire:submit.prevent="save">

                        <div class="col-12 col-md-12">
                            <x-imageupload wire:model='image' :imagenew="$image" :imageold="$imageold" />
                            @error('image')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
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
                        <div class="col-12 col-md-6">
                            <label class="form-label"
                                for="modalEditUserFirstName">{{ __('tran.category') }}</label>
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


                            <div class="col-12 col-md-12" wire:ignore>
                                <label class="form-label" for="modalEditUserFirstName">{{ __('tran.article') }}</label>
                                <textarea wire:model='article' class="form-control" id="article">{{$article}}</textarea>

                                @error('article')
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

                        <div class="col-12 text-center mt-2 pt-50">

                            <button wire:loading.attr="disabled" type="submit" class="btn btn-primary me-1">
                                <div wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </div>
                                {{ __('tran.save') }}
                            </button>
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
@push('csslive')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" />
@endpush



@push('jslive')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#article').summernote({
                lang: 'ar-AR',
                tabsize: 2,
                minHeight: 100,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('article', contents);
                        if ($(selector).summernote('isEmpty')) {
                            @this.set('article', '');
                        } else {
                            @this.set('article', contents);
                        }
                    }
                }
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
