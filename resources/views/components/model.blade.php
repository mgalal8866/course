@props([
    'questions' => 'null',
    'keys' => 'null',
])



<div class="modal fade" id="fullscreenModal-{{ $keys }}" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-fullscreen" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFullTitle">اضافه تدريب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- <form class="row gy-1 pt-75" wire:submit.prevent="savequti({{ $keys }})"> --}}
            <div class="modal-body">
                <div class="card border-primary">
                    <div class="card-header">
                        <h3>اضافه اختبار</h3>
                    </div>


                    <div class="card-body">
                        <div class="row">

                            <div class="col-12 col-md-6">
                                <label class="form-label" for="testname">{{ __('tran.testname') }}</label>
                                <input type="text" class="form-control" wire:model="testname" id="testname" />
                                @error('testname')
                                    <span class="error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 col-md-4">
                                <label class="form-label" for="testtime">{{ __('tran.testtime') }}</label>
                                <input type="number" class="form-control" wire:model="testtime" id="testtime" />
                                @error('testtime')
                                    <span class="error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="degree_success">{{ __('tran.degree_success') }}</label>
                                <input type="number" class="form-control" wire:model="degree_success"
                                    id="degree_success" />
                                @error('degree_success')
                                    <span class="error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label" for="total_scores">{{ __('tran.total_scores') }}</label>
                                <input type="number" class="form-control" wire:model="total_scores"
                                    id="total_scores" />
                                @error('total_scores')
                                    <span class="error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="accordion accordion-margin" id="accordionMargin" wire:ignore.self>
                                @if (count($questions) > 0)
                                    @foreach ($questions as $key => $value)
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="pe-1"> السؤال </td>
                                                    <td><span class="fw-bold">{!! $questions[$key]['question'] !!}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-1">وصف السؤال </td>
                                                    <td>
                                                        {!! $questions[$key]['testdescription'] !!}

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pe-1">درجة السؤال </td>
                                                    <td>
                                                         {!! $questions[$key]['degree'] !!} </td>
                                                </tr>
                                                @foreach ($questions[$key]['answers'] as $key1 => $value1)
                                                    <tr>
                                                        <td class="pe-1">@if ($questions[$key]['correct'] == $key1)
                                                            <i class="fas fa-check-circle fa-sm"
                                                                style="color: #0d9123;"></i>
                                                        @endif الاجابة
                                                        </td>
                                                        <td><span class="fw-bold">{!! $questions[$key]['answers'][$key1]['answer'] !!}
                                                        </td>
                                                    </tr>
                                                    {{-- <ul>
                                                <li>
                                                    {!! $questions[$key]['answers'][$key1]['answer'] !!}
                                                </li>
                                                <li>
                                                    {!! $questions[$key]['answers'][$key1]['correct'] !!}
                                                </li>
                                            </ul> --}}
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{-- <ul> --}}
                                        {{ $key }}
                                        {{-- <li>
                                                <h1>{!! $questions[$key]['question'] !!}</h1>
                                            </li>
                                            <li>
                                                <h1>{!! $questions[$key]['testdescription'] !!}</h1>
                                            </li> --}}
                                        {{-- <li>
                                                <h1>{!! $questions[$key]['degree'] !!}</h1>
                                            </li> --}}

                                        {{-- </ul> --}}
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="row">

                        </div>

                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="button" class="btn btn-outline-success" wire:click='addquestions()'>
                                اضافه سؤال
                            </button>
                            {{-- <button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                                data-bs-target="#forcoursemodel" wire:click='addquestions()'>
                                اضافه سؤال
                            </button> --}}
                            {{-- <a  class="btn btn-primary" wire:click="addquestions()">1اضافة سؤال</a> --}}
                            {{-- <a  class="btn btn-primary" wire:click="$dispatch('funquestion')">1اضافة سؤال</a> --}}

                            {{-- <a wire:click='addquestions()' class="btn btn-primary me-1">اضافه سؤال</a> --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>

                <a wire:click='savequti({{ $keys }})' class="btn btn-success me-1">{{ __('tran.save') }}</a>
            </div>
        </div>
    </div>

</div>
