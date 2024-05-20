<div>
    @push('csslive')
        <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/wizard/bs-stepper.min.css') }}">
        @if (LaravelLocalization::getCurrentLocaleDirection() == 'rtl')
            <link rel="stylesheet" type="text/css" href="{{ asset('asset/css-rtl/plugins/forms/form-wizard.min.css') }}">
        @else
            <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.min.css') }}">
        @endif

    @endpush

    <div wire:ignore.self class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog   modal-lg modal-dialog-scrollable modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">00</h1>
                    </div>
                    <form id="editUserForm" class="row gy-1 pt-75" wire:submit.prevent="save">
                        <div class="col-4">
                            <label class="form-label" for="">ألمرحلة</label>
                            <select class="form-select" wire:model.live='questions.0.stages' required>
                                <option value=""> اختيارالقسم</option>
                                @foreach ($stages as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('questions.0.stages')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="">القسم</label>
                            <select class="form-select" wire:model='questions.0.stage_child' required>
                                <option value=""> اختيارالقسم</option>
                                @foreach ($stage_child as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('questions.0.stage_child')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="">درجه السؤال</label>
                            <input class="form-control" wire:model="questions.0.degree" type="number" step="0.1"  />
                            @error('questions.0.mark')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="">وصف السؤال</label>
                            <x-summernote wire:model='questions.0.description' id="description" />
                            @error('questions.0.description')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">

                            <label class="form-label" for=""><i class="fas fa-question"></i>السؤال</label>
                            <x-summernote wire:model='questions.0.question' id="questions" />
                            @error('questions.0.question')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="divider divider-danger">
                            {{-- <div class="divider-text">
                                <a wire:click='addanswerquestions(0)' class="btn btn-sm btn-success">
                                    اضافة الاجابة
                                </a>
                            </div> --}}
                        </div>

                        @foreach ($questions[0]['answers'] as $key1 => $value1)
                            <div class="card shadow-none bg-transparent border-success">
                                <div class="card-header">
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="radio" name="questions.0.answers"
                                                value="{{ $key1 }}" id="inlineRadio1"
                                                wire:model="questions.0.correct"  />
                                            <label class="form-check-label" for="inlineRadio1">الاجابه
                                                الصحيحة</label>
                                        </div>
                                        @error('questions.0.correct')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    {{-- <a wire:click='removeanswerquestions(0,{{ $key1 }})' class="btn btn-sm btn-danger">
                                    حذف الاجابة </a> --}}
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <label class="form-label" for=""></label>
                                        <x-summernote wire:model='questions.0.answers.{{ $key1 }}.answer'  id="answer_{{$key1}}" />
                                        @error('questions.0.answers.' . $key1 . '.answer')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
