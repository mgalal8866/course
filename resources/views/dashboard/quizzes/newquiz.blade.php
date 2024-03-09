<div>


    <div class="card border-primary">
        <div class="card-header">
            <h3>اضافه اختبار</h3>
        </div>


        <div class="card-body">
            <form id="editUserForm" class="row gy-1 pt-75" wire:submit.prevent="save">
                <div class="row">

                    <div class="col-12 col-md-4">
                        <label class="form-label" for="testname">{{ __('tran.testname') }}</label>
                        <input type="text" class="form-control" wire:model="testname" id="testname" />
                        @error('testname')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="modalEditUserFirstName">{{__('tran.typecategory')}}</label>
                        <select class="form-select" id="typecategory" wire:model.live='typecategory'>

                            @foreach ( \App\Enum\Quiz::cases() as $q)

                            <option value="{{$q->value}}">{{ __('tran.typequiz-'.$q->name)}} </option>
                            @endforeach
                        </select>
                      @error('typecategory') <span class="error" style="color: red" >{{ $message }}</span> @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="testcategory">{{ __('tran.testcategory') }}</label>
                        <select class="form-select" id="testcategory" wire:model='testcategory' @empty($category) disabled @endempty>
                            <option value="">اختار القسم</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('testcategory')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-12 col-md-4">
                        <label class="form-label" for="testtime">{{ __('tran.testtime') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="testtime" id="testtime" />
                        @error('testtime')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="degree_success">{{ __('tran.degree_success') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="degree_success" id="degree_success" />
                        @error('degree_success')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="total_scores">{{ __('tran.total_scores') }}</label>
                        <input type="number" step="0.1" class="form-control" wire:model="total_scores" id="total_scores" />
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
                                                <div class="col-6">
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-question"></i></span>
                                                        <input class="form-control"
                                                            wire:model="questions.{{ $key }}.question"
                                                            placeholder="السؤال" type="text" required />
                                                    </div>
                                                    @error('questions.' . $key . '.question')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-2">

                                                    <input class="form-control"
                                                        wire:model="questions.{{ $key }}.degree"
                                                        type="number" step="0.1" placeholder="درجه السؤال" required />

                                                    @error('questions.' . $key . '.degree')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @foreach ($questions[$key]['answers'] as $key1 => $value1)
                                                    <div class="mb-1 mt-2 row">
                                                        <div class="col-8">
                                                            <div class="input-group input-group-merge">
                                                                <span class="input-group-text"><i
                                                                        class="fas fa-circle"></i></span>


                                                                <input class="form-control"
                                                                    wire:model="questions.{{ $key }}.answers.{{ $key1 }}.answer"
                                                                    type="text" placeholder="الاجابة" required />
                                                            </div>
                                                            @error('questions.' . $key . '.answers.' . $key1 .
                                                                '.answer')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="form-check form-check-success">
                                                                <input class="form-check-input" type="radio"
                                                                    name="questions.{{ $key }}.answers"
                                                                    value="true" id="inlineRadio1"
                                                                    wire:model="questions.{{ $key }}.answers.{{ $key1 }}.correct"
                                                                    required />
                                                                <label class="form-check-label"
                                                                    for="inlineRadio1">الاجابه الصحيحة</label>
                                                            </div>
                                                            @error('questions.' . $key . '.answers.' . $key1 .
                                                                '.correct')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-2">
                                                            @if ($key1 != 0)
                                                                <a wire:click='removeanswerquestions({{ $key }},{{ $key1 }})'
                                                                    class="btn btn-sm btn-danger">
                                                                    حذف الاجابة
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="card-footer text-muted">

                                            <a wire:click='addanswerquestions({{ $key }})'
                                                class="btn btn-sm btn-success">
                                                اضافة الاجابة
                                            </a>
                                            @if ($key != 0)
                                                <a wire:click='removequestions({{ $key }})'
                                                    class="btn btn-sm btn-danger">
                                                    حذف السؤال
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-12 text-center mt-2 pt-50">
                    <a wire:click='addquestions()' class="btn btn-primary me-1">اضافه سؤال</a>
                    <button type="submit" class="btn btn-success me-1">{{ __('tran.save') }}</button>

                </div>
            </form>
        </div>
    </div>
</div>

</div>
