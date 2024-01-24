<div>
    @push('csslive')
        {{--    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/katex.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/monokai-sublime.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/quill.snow.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/quill.bubble.css') }}">
--}}
    @endpush
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
                            <x-imageupload wire:model='image' :imagenew="$image" :imageold="$imageold" />
                            @error('image')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.title') }}</label>
                            <input type="text" class="form-control" wire:model="title"
                                data-msg="Please enter your fisssssssrst name" required />
                            @error('title')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="modalEditUserFirstName">{{ __('tran.article') }}</label>
                            <x-summernote  wire:model='article'  name="article" id="article"/>
                            {{-- <x-editor  wire:model='article'  name="article" id="article"/> --}}
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
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
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

@push('jslive')
    {{-- <script src="{{ asset('asset/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/js/editors/quill/quill.min.js') }}"></script> --}}
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
