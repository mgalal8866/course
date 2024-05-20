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
                    @if ($typecategory != 3)
                        <div class="mb-2 col-md-12">
                            <div class="mb-2 col-md-2">
                                <x-imageupload style="text-wrap: balance;" wire:model='image' :height='150'
                                    :width='150' :imagenew="$image" :tlabel="__('tran.image')" />
                                @error('image')
                                    <span class="error" style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="modalEditUserFirstName">{{ __('tran.typecategory') }}</label>
                        <select class="form-select" id="typecategory" wire:model.live='typecategory'>

                            @foreach (\App\Enum\Quiz::cases() as $q)
                                <option value="{{ $q->value }}">{{ __('tran.typequiz-' . $q->name) }} </option>
                            @endforeach
                        </select>
                        @error('typecategory')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    @if ($typecategory != 3)
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="testcategory">{{ __('tran.testcategory') }}</label>
                            <select class="form-select" id="testcategory" wire:model='testcategory'
                                @empty($category) disabled @endempty>
                                <option value="">اختار القسم</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('testcategory')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        <div class="col-4">
                            <label class="form-label" for="">الدورة</label>
                            <select class="form-select" wire:model.live='course_id' required>
                                <option value=""> اختيارالدورة</option>
                                @foreach ($courses as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('stages_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="">ألمرحلة</label>
                            <select class="form-select" wire:model.live='stages_id' required>
                                <option value=""> اختيارالمرحلة</option>
                                @foreach ($stages as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('stages_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            <label class="form-label" for="">القسم</label>
                            <select class="form-select" wire:model='stage_child_id' required>
                                <option value=""> اختيارالقسم</option>
                                @foreach ($stage_child as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('stage_child_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    @if ($typecategory == 2)
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="redirect_mark">{{ __('tran.redirect_mark') }}</label>
                            <input type="number" step="0.1" class="form-control" wire:model="redirect_mark"
                                id="redirect_mark" />
                            @error('redirect_mark')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="redirect_to_up">{{ __('tran.redirect_to_up') }}</label>
                            <input type="text" step="0.1" class="form-control" wire:model="redirect_to_up"
                                id="redirect_to_up" />
                            @error('redirect_to_up')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label" for="redirect_to_down">{{ __('tran.redirect_to_down') }}</label>
                            <input type="text" step="0.1" class="form-control" wire:model="redirect_to_down"
                                id="redirect_to_down" />
                            @error('redirect_to_down')
                                <span class="error" style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="testname">{{ __('tran.testname') }}</label>
                        <input type="text" class="form-control" wire:model="testname" id="testname" required />
                        @error('testname')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-12 col-md-1">
                        <label class="form-label" for="testtime">{{ __('tran.testtime') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="testtime"
                            id="testtime" />
                        @error('testtime')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-1">
                        <label class="form-label" for="degree_success">{{ __('tran.degree_success') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="degree"
                            id="degree" required />
                        @error('degree')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-1">
                        <label class="form-label" for="total_scores">{{ __('tran.total_scores') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="total_scores"
                            id="total_scores" required/>
                        @error('total_scores')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="accordion accordion-margin" id="accordionMargin" wire:ignore.self>

                        {{-- @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
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
                    {{-- <a wire:click='addquestions()' class="btn btn-primary me-1">اضافه سؤال</a> --}}
                    <button type="submit" class="btn btn-success me-1">{{ __('tran.save') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>
