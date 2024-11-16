@extends('layouts.dashboard.app')
@section('content')
<div class="mt-5">

    @if ($quiz != null)
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">{{ $quiz->name }}</h3>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="input-group " style="width:auto; ">
                            <a class="btn btn-outline-success btn-sm btnmodal" href="javascript:void(0)" data-id="0" data-quiz="{{ $quiz->id }}">اضافه
                                سؤال</a>
                            <a class="btn btn-outline-warning btn-sm edit_quiz_nmodal" data-quiz="{{ $quiz->id }}" href="javascript:void(0)">تعديل بيانات الاختبار</a>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row">
                <div class="col-md-9 col-12">

                    <div class="row mb-1">
                        <div class="col-md-3 col-6">
                            <h6>وقت الاختبار: {{ $quiz->time }} دقيقة</h6>
                        </div>
                        <div class="col-md-3 col-6">
                            <h6>درجة النجاح: 50</h6>
                        </div>
                        @if ($quiz->course_id != null)
                        <div class="col-md-3 col-6">
                            <h6>أسم الدورة: {{ $quiz->course->name }}</h6>
                        </div>
                        @endif
                        @if ($quiz->category_id != null)
                        <div class="col-md-3 col-6">
                            <h6>اسم القسم : {{ $quiz->category->name }}</h6>
                        </div>
                        @endif
                    </div>
                </div>
                @if ($quiz->image != null)
                <div class="col-md-3 col-12 text-md-end text-center">
                    <img src="{{ $quiz->imageurl }}" alt="Course Image" class="img-fluid mb-3 mb-md-0" style="max-width: 200px;">
                </div>
                @endif
            </div>
        </div>
    </div>
    @foreach ($quiz->question->sortBy('sort')  as $item)
    <div class="card mb-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{!! $item->question !!}</h5>
                <div class="input-group " style="width:auto; ">

                    <a class="btn btn-outline-warning btn-sm btnmodal" href="javascript:void(0)" data-id="{{ $item->id }}" data-quiz="{{ $quiz->id }}">تعديل</a>

                    <a class="btn btn-outline-danger btn-sm btndelete" href="javascript:void(0)" data-id="{{ $item->id }}"> حذف</a>

                </div>
            </div>
            <p class="card-text">{!! $item->description !!}</p>
            {{-- <h6 class="card-subtitle mt-1">درجة السؤال : <span class="badge bg-info"> {{ $item->mark }}</span> --}}
            </h6>
            <ul class="list-group mt-2">
                @foreach ($item->answer->sortBy('sort') as $answer)
                <li class="list-group-item @if ($answer->correct == 1) list-group-item-success @endif">
                    <div class="d-flex align-items-start">
                        {!! $answer->answer !!}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
    @else
    <div class="alert alert-danger" role="alert">
        <div class="alert-body"><strong> لا يوجد اختبار!</strong></div>
    </div>
    @endif

    <div id="modalPlaceholder"></div>
</div>


@push('jslive')
<script>
    $('body').on('click', '.btnmodal', function(event) {
        var id = $(this).data('id');
        var quiz = $(this).data('quiz');

        $.ajax({
            url: '{{ route('get-modal') }}' + '/' + id + '/' + quiz
            , method: 'GET'
            , success: function(response) {
                $('#modalPlaceholder').html(response);
                $('#editUser').modal('show');
            }
        });
    });
    $('body').on('click', '.edit_quiz_nmodal', function(event) {

        var quiz = $(this).data('quiz');

        $.ajax({
            url: '{{ route('get_edit_quiz_Modal') }}' + '/' + quiz
            , method: 'GET'
            , success: function(response) {
                $('#modalPlaceholder').html(response);
                $('#editUser').modal('show');
            }
        });
    });
    $('body').on('click', '.btndelete', function(event) {
        var id = $(this).data('id');
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: '{{ route('deletequestion') }}' + '/' + id
                , method: 'GET'
                , success: function(response) {
                    location.reload();
                }
            });
        }
    });

</script>
@endpush

@endsection
