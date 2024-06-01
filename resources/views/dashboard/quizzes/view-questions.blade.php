<div class="  mt-5">
    @if ($quiz != null)
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <h3 class="card-title">{{ $quiz->name }}</h3>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <h6>وقت الاختبار: {{ $quiz->time }} دقيقة</h6>
                            </div>
                            <div class="col-md-3">
                                <h6>درجة النجاح: 50</h6>
                            </div>
                            @if ($quiz->course_id != null)
                                <div class="col-md-3">
                                    <h6>أسم الدورة: {{ $quiz->course->name }}</h6>
                                </div>
                            @endif
                            @if ($quiz->category_id != null)
                                <div class="col-md-3">
                                    <h6>اسم القسم : {{ $quiz->category->name }}</h6>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">

                        @if ($quiz->image != null)
                            <img src="{{ $quiz->imageurl }}" alt="Course Image" class="img-fluid">
                        @endif

                    </div>
                </div>
            </div>
        </div>
        @foreach ($quiz->question as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{!! $item->question !!}</h5>
                    <p class="card-text">{!! $item->description !!}</p>
                    <h6 class="card-subtitle  mt-1">درجة السؤال : <span class="badge bg-info "> {{ $item->mark }}</h6>

                    <ul class="list-group mt-2">
                        @foreach ($item->answer as $answer)
                            <li
                                class="list-group-item @if ($answer->correct == 1) list-group-item-success @endif ">
                                <div class="d-flex align-items-start">
                                    {!! $answer->answer !!}
                                </div>
                            </li>
                        @endforeach

                        {{-- <li class="list-group-item">
                        <div class="d-flex align-items-start">
                            <img src="paris.jpg" class="me-3" alt="Paris" style="width: 50px;">
                            <div>
                                <strong>C. Paris</strong> - Paris is the capital and most populous city of France, with
                                an
                                estimated population of 2,165,423 residents in 2019 in an area of 105 square kilometers.
                                (Correct)
                            </div>
                        </div>
                    </li> --}}

                    </ul>
                </div>
            </div>
        @endforeach
    @else
    <div class="alert alert-danger" role="alert">
        <div class="alert-body"><strong>  لا يوجد اختبار!</strong></div>
    </div>

    @endif
</div>
