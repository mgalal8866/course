<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">تعديل الاختبار </h1>
                </div>
                <form id="editUserForm" class="row gy-1 pt-75">
                    @csrf
                    <div class="form-group">
                        <label for="name">اسم الاختبار </label>
                        <input id="name" type='text' name="name" class="form-control" value="{{ $quiz->name ?? '' }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="pass_marks">درجه النجاح</label>
                        <input id="pass_marks" type='number' name="pass_marks" class="form-control"  value="{{ $quiz->pass_marks ?? '' }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="time">وقت الاختبار</label>
                        <input id="time" type='number' name="time" class="form-control"  value="{{ $quiz->time ?? '' }}"></input>
                    </div>
                    <div class="form-group">
                        <label for="total_marks">درجه الاختبار</label>
                        <input id="total_marks" type='number' name="total_marks" class="form-control"  value="{{ $quiz->total_marks ?? '' }}"></input>
                    </div>
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

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


        $('#editUserForm').on('submit', function(event) {
            event.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '{{ route('save_edit_quiz_Modal') }}',
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
