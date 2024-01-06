<div>
    <div class="card border-primary">
        <div class="card-header">Header</div>


        <div class="card-body">
            <form id="editUserForm" class="row gy-1 pt-75" wire:submit.prevent="save">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <label class="form-label" for="testname">{{ __('tran.testname') }}</label>
                        <input type="text" class="form-control" wire:model="testname" id="testname" />
                        @error('testname')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="testcategory">{{ __('tran.testcategory') }}</label>
                        <select class="form-select" id="testcategory" wire:model='testcategory'>
                            <option value="">اختار القسم</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('testcategory')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="col-12 col-md-6">
                        <label class="form-label" for="testtime">{{ __('tran.testtime') }}</label>
                        <input type="text" class="form-control" wire:model="testtime" id="testtime" />
                        @error('testtime')
                            <span class="error" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="accordion accordion-margin" id="accordionMargin"  wire:ignore.self>

                        @foreach ($quetions as $key => $value)
                            <div class="accordion-item" wire:ignore.self>
                                <h2 class="accordion-header" id="headingMarginOne{{$key }}">
                                    <button  wire:ignore.self class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionMarginOne{{$key }}" aria-expanded="false"
                                        aria-controls="accordionMarginOne{{$key }}">
                                        {{ $loop->iteration }}
                                        <a wire:click='removequetions({{ $key }})' type="button"
                                            class="btn btn-sm btn-danger ">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </button>
                                </h2>
                                <div id="accordionMarginOne{{$key }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingMarginOne{{$key }}" data-bs-parent="#accordionMargin">
                                    <div class="card ">
                                        <div class="card-body">
                                            <div class="mb-1 row">
                                                <div class="col">
                                                    <input class="form-control"
                                                        wire:model="quetions.{{ $key }}.quetion"
                                                        placeholder="name" type="text" />
                                                    @error('quetions.' . $key . '.quetion')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input class="form-control"
                                                        wire:model="quetions.{{ $key }}.degree" type="text"
                                                        placeholder="{{ $key }}" />
                                                    @error('quetions.' . $key . '.degree')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                @foreach ($quetions[$key]['answers'] as $key1 => $value1)
                                                    <div class="mb-1 row">
                                                        <div class="col">
                                                            <label>{{ $quetions[$key]['answers'][$key1]['answer'] }}</label>
                                                            <a wire:click='removeanswerquetions({{ $key }},{{ $key1 }})'
                                                             class="btn btn-sm btn-danger">
                                                                حذف الاجابة
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-1">
                                                    {{-- @if ($key != 0) --}}




                                                    {{-- @endif --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-12 text-center mt-2 pt-50">
                    <a wire:click='addquetions()' class="btn btn-primary me-1">{{ __('tran.add') }}</a>
                    <button type="submit" class="btn btn-primary me-1">{{ __('tran.save') }}</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        {{ __('tran.cancel') }}
                    </button>
                </div>
        </div>
        </form>
    </div>
</div>

</div>
