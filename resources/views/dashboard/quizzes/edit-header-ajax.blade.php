<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">تعديل السؤال </h1>
                </div>
                <form id="editUserForm" class="row gy-1 pt-75">
                    <div class="form-group">
                        <label for="degree">درجه السؤال</label>
                        <input id="degree" type='number' name="degree" class="form-control"
                            value="{{ $question->mark ?? '' }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="question">السؤال </label>
                        <textarea id="question" name="question" class="form-control summernote">{!! $question->question ?? '' !!}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">وصف السؤال</label>
                        <textarea id="description" name="description" class="form-control summernote">{!! $question->description ?? '' !!}</textarea>
                    </div>
                    <input type="hidden" name="quiz_id" value="{{ $quiz }}">
                    @if (!empty($question)  )
                        @foreach ($question->answer as $index => $item)
                            <div class="form-group">
                                <label for="answer">الاجابة {{ $index + 1 }}</label>

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <div class="form-check form-check-success">
                                                <input class="form-check-input" type="radio" name="correct"
                                                    value="{{ $index }}"
                                                    @if ($item->correct == 1) checked @endif />
                                                <label class="form-check-label">الاجابه الصحيحة</label>
                                            </div>

                                        </div>
                                    </div>
                                    <textarea id="answer" name="answer[]" class="form-control summernote">{!! $item->answer !!}</textarea>
                                </div>
                                <input type="hidden" name="answer_id[]" value="{{ $item->id }}">
                            </div>
                        @endforeach
                        <input type="hidden" name="id" value="{{ $question->id }}">
                    @else
                        <div class="form-group">
                            <label for="answer">الاجابة 1</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="radio" name="correct"
                                                value="1" />
                                            <label class="form-check-label">الاجابه الصحيحة</label>
                                        </div>

                                    </div>
                                </div>
                                <textarea id="answer" name="answer[]" class="form-control summernote"></textarea>
                            </div>
                            <input type="hidden" name="answer_id[]" value="0">
                        </div>
                        <div class="form-group">
                            <label for="answer"> الاجابة 2</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="radio" name="correct"
                                                value="1" />
                                            <label class="form-check-label">الاجابه الصحيحة</label>
                                        </div>

                                    </div>
                                </div>
                                <textarea id="answer" name="answer[]" class="form-control summernote"></textarea>
                            </div>
                            <input type="hidden" name="answer_id[]" value="0">
                        </div>
                        <div class="form-group">
                            <label for="answer">الاجابة 3</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="radio" name="correct"
                                                value="1" />
                                            <label class="form-check-label">الاجابه الصحيحة</label>
                                        </div>

                                    </div>
                                </div>
                                <textarea id="answer" name="answer[]" class="form-control summernote"></textarea>
                            </div>
                            <input type="hidden" name="answer_id[]" value="0">
                        </div>
                        <div class="form-group">
                            <label for="answer">الاجابة 4</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <div class="form-check form-check-success">
                                            <input class="form-check-input" type="radio" name="correct"
                                                value="1" />
                                            <label class="form-check-label">الاجابه الصحيحة</label>
                                        </div>

                                    </div>
                                </div>
                                <textarea id="answer" name="answer[]" class="form-control summernote"></textarea>
                            </div>
                            <input type="hidden" name="answer_id[]" value="0">
                        </div>
                        <input type="hidden" name="id" value="0">
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

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150
        });

        $('#editUserForm').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('save-modal-data') }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {

                    $('#editUser').modal('hide');
                    location.reload();
                },
                error: function(xhr) {
                    // Handle error
                }
            });
        });
    });
</script>
