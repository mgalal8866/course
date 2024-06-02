@extends('layouts.dashboard.app')
@section('content')
    <div class="mt-5">

        @if ($quiz != null)
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">{{ $quiz->name }}</h3>
                            <button class="btn btn-warning btn-sm">تعديل</button>
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
                                <img src="{{ $quiz->imageurl }}" alt="Course Image" class="img-fluid mb-3 mb-md-0"
                                    style="max-width: 200px;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @foreach ($quiz->question as $item)
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">{!! $item->question !!}</h5>
                             {{-- <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="modal"  data-bs-id="{{ $item->id }}" data-bs-target="#editUser"> نعديل</button> --}}
                             <button class="btn btn-warning btn-sm" type="button" onclick="Livewire.dispatch('edit',{id:'{{$item->id}}'}, { component: 'edit_header_quiz-user'})"> نعديل</button>
                        </div>
                        <p class="card-text">{!! $item->description !!}</p>
                        <h6 class="card-subtitle mt-1">درجة السؤال : <span class="badge bg-info"> {{ $item->mark }}</span>
                        </h6>
                        <ul class="list-group mt-2">
                            @foreach ($item->answer as $answer)
                                <li
                                    class="list-group-item @if ($answer->correct == 1) list-group-item-success @endif">
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


    </div>
    @livewire('dashboard.quizzes.edit-header-quiz')
    <div class="modal fade" id="trainingModal" tabindex="-1" aria-labelledby="trainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog   modal-fullscreen    modal-dialog-scrollable modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                @livewire('dashboard.quizzes.edit-questions', ['questionId' => ''])
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

@endsection

