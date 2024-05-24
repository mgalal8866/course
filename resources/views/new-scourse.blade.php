<div>
    <div class="card border-primary">
        <div class="card-header">
            <h3>اضافه اختبار</h3>
            <a class="btn btn-primary" wire:click="$dispatch('edit')">اضافة سؤال</a>
        </div>
        @livewire('dashboard.quizzes.model')

        <div class="card-body">
            <form id="editUserForm" class="row gy-1 pt-75" wire:submit.prevent="save">
                <div class="row">


                    <div class="col-12 col-md-4">
                        <label class="form-label" for="testname">{{ __('tran.testname') }}</label>
                        <input type="text" class="form-control" wire:model="testname" id="testname" required />
                        @error('testname')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-2">
                        <label class="form-label" for="testtime">{{ __('tran.testtime') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="testtime"
                            id="testtime" />
                        @error('testtime')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="form-label" for="degree_success">{{ __('tran.degree_success') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="degree_success"
                            id="degree_success" required />
                        @error('degree_success')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-2">
                        <label class="form-label" for="total_scores">{{ __('tran.total_scores') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="total_scores"
                            id="total_scores" required />
                        @error('total_scores')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="accordion accordion-margin" id="accordionMargin" wire:ignore.self>


                        @foreach ($questions as $key => $value)
                            <div class="accordion-item" wire:ignore.self>
                                <h2 class="accordion-header" id="headingMarginOne{{ $key }}">
                                    <button wire:ignore.self class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#accordionMarginOne{{ $key }}" aria-expanded="false"
                                        aria-controls="accordionMarginOne{{ $key }}">
                                        <span class="text-warning">
                                            السؤال
                                            {{ $loop->iteration }}
                                        </span>

                                    </button>
                                </h2>
                                <div id="accordionMarginOne{{ $key }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingMarginOne{{ $key }}"
                                    data-bs-parent="#accordionMargin" wire:ignore.self>
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="mb-1 row">
                                                <div class="col-2">
                                                    {!! $questions[$key]['degree'] !!}
                                                </div>
                                                <div class="col-6">
                                                    <i class="fas fa-question"></i>
                                                    {!! $questions[$key]['question'] !!}
                                                </div>
                                                <div class="col-4">
                                                    <div class="input-group input-group-merge">
                                                        {!! $questions[$key]['description'] !!}
                                                    </div>
                                                </div>
                                                @foreach ($questions[$key]['answers'] as $key1 => $value1)
                                                    <div class="mb-1 mt-2 row">
                                                        <div class="col-1">
                                                            <i class="fas fa-circle"
                                                                @if ($questions[$key]['correct'] == $key1) style="color: #0d9123;" @endif>
                                                            </i>
                                                        </div>
                                                        <div class="col-3">
                                                            {!! $questions[$key]['answers'][$key1]['answer'] !!}
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-12 text-center mt-2 pt-50">

                    <button
                        @empty($questions)
                    disabled
                    @endempty
                        type="submit" class="btn btn-success me-1">{{ __('tran.save') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>
