<div>


    <div wire:ignore.self class="modal fade" id="forcoursemodel" tabindex="-1" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog     modal-lg modal-dialog-scrollable modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">

                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                @if (count($questions) > 0)

                    @php
                        $key9 = count($questions) - 1;
                    @endphp
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1"> {{ $key9 + 1 }} السؤال </h1>
                        </div>
                        {{-- <form id="editUserForm" class="row gy-1 pt-75" > --}}
                        <div class="col-12">
                            <label class="form-label" for="">درجه السؤال{{ $key9 }}</label>
                            <input class="form-control" wire:model.live="questions.{{ $key9 }}.degree"
                                type="number" id="degree{{ $key9 }}" step="0.1" required />
                            @error('questions' . $key9 . 'degree')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="">وصف السؤال{{ $key9 }}</label>


                            {{-- <x-text-editor :editorheight="'25rem'" class="w-full"
                                wire:model.live="questions.{{ $key9 }}.testdescription"></x-text-editor> --}}
                                <textarea class="form-control"  wire:model.live="questions.{{ $key9 }}.testdescription"  id="questions.{{ $key9 }}.testdescription" style="height: 100px"></textarea>

                            {{-- <x-summernote2 wire:model.live="questions.{{ $key9 }}.testdescription"  id="testdescription{{ $key9 }}" /> --}}
                            @error('questions' . $key9 . 'testdescription')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12">

                            <label class="form-label" for=""><i
                                    class="fas fa-question"></i>السؤال{{ $key9 }}</label>
                                    <textarea class="form-control"  wire:model.live="questions.{{ $key9 }}.question"  id="questions.{{ $key9 }}.question" style="height: 100px"></textarea>

                            {{-- <x-summernote2 wire:model.live="questions.{{ $key9 }}.question" id="question{{ $key9 }}" /> --}}
                            @error('questions' . $key9 . 'question')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="divider divider-danger">
                            <div class="divider-text">
                                <a wire:click='addanswerquestions({{ $key9 }})' class="btn btn-sm btn-success">
                                    اضافة الاجابة
                                </a>
                            </div>
                        </div>
                        @foreach ($questions[$key9]['answers'] as $key1 => $value1)
                            {{-- {{ $questions[$key9]['answers'] }} --}}
                            <div class="card shadow-none bg-transparent border-success">
                                <div class="card-header">
                                    <div class="form-check form-check-success">
                                        <input class="form-check-input" type="radio"
                                            name="questions.{{ $key9 }}.answers" value="{{ $key1 }}"
                                            id="inlineRadio1_{{ $key9 }}"
                                            wire:model.live="questions.{{ $key9 }}.correct" required />
                                        <label class="form-check-label" for="inlineRadio1">الاجابه
                                            الصحيحة{{ $key9 }}</label>
                                    </div>
                                    @error('questions' . $key9 . 'answers.' . $key1 . '.correct')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <a wire:click='removeanswerquestions({{ $key9 }},{{ $key1 }})'
                                        class="btn btn-sm btn-danger"> حذف الاجابة </a>
                                </div>
                                <div class="card-body">

                                    <div class="col-12">
                                        <label class="form-label" for="">- {{ $key1 }}</label>
                                        <textarea class="form-control"  wire:model.live="questions.{{ $key9 }}.answers.{{ $key1 }}.answer"  id="questions.{{ $key9 }}.answers.{{ $key1 }}.answer" style="height: 100px"></textarea>


                                        @error('questions' . $key9 . 'answers.' . $key1 . '.answer')
                                            <span class="error" style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 text-center mt-2 pt-50]">
                            {{-- <button type="submit" class="btn btn-primary me-1">{{ __('tran.save') }}</button> --}}
                            <button wire:click="cancelq({{ $key9  }})" type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">
                                {{ __('tran.cancel') }}
                            </button>
                            <a     class="btn btn-outline-success" data-bs-dismiss="modal"
                                aria-label="Close">
                                {{ __('tran.save') }}
                        </a>
                        </div>
                        {{-- </form> --}}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('jslazy')
    <script>
        // window.addEventListener('swal', event => {
        //     Swal.fire({
        //         title: event.detail.message,
        //         icon: 'info',
        //         customClass: {
        //             confirmButton: 'btn btn-danger'
        //         },
        //         buttonsStyling: false
        //     });
        // })
        // window.addEventListener('openmodel', event => {
        //     // console.log('www');
        //     $('#editUser').modal("show");

        // });
        // window.addEventListener('closemodel', event => {
        //     // console.log('www');
        //     $('#editUser').modal("hide");

        // });
    </script>
@endpush
