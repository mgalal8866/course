<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.freecourse') }}</h4>
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser">{{__('tran.newfreecourse')}}</button> --}}
                     <a  class="btn btn-primary" wire:click="$dispatch('edit')">{{__('tran.newfreecourse')}}</a>
                    {{-- <button type="button" class="btn btn-primary" wire:click="$dispatch('openmodel')">{{__('tran.newcategory')}}</button> --}}

                </div>
                @livewire('dashboard.free-course.new-free-course')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.image') }}</th>
                                <th>{{ __('tran.country') }}</th>
                                <th>{{ __('tran.name') }}</th>
                                <th>{{ __('tran.category') }}</th>
                                <th>{{ __('tran.videolink') }}</th>
                                <th>{{ __('tran.statu') }}</th>
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($freecourse  as $item)
                                <tr>
                                    <td>
                                        <img src="{{ $item->imageurl ?? 'N/A' }}" class="me-75" height="50" width="50" alt="Noimage" />
                                    </td>
                                    <td>
                                        <img src="{{ asset('asset/flag/country-') .Str::lower($item->category->country->iso2??'').'.svg' }}" class="me-75" height="20" width="20" alt="Noimage" />
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->category->name ?? 'N/A' }}</span>
                                    </td>

                                    <td>
                                        <span class="fw-bold">{{ $item->video_link ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span
                                        class="badge  bg-@switch($item->active)
                                            @case(0)danger
                                            @break

                                            @case(1)success
                                            @break
                                            @endswitch">
                                            @switch($item->active)
                                                @case(0)
                                                    غير مفعل
                                                @break

                                                @case(1)
                                                    مفعل
                                                @break
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        <a wire:click="$dispatch('edit',{id:'{{$item->id}}'})"><i  class="fas fa-edit fa-lg"  style="color: #c2881e;"></i></a>
                                        <a wire:click="delete('{{$item->id}}')"><i  class="fas fa-trash-alt fa-lg "  style="color: #ff0000;"></i></a>
                                        <a wire:click="activetoggle('{{$item->id}}')"> <i   class="fas {{$item->active ==1 ?'fas fa-eye':'fa-eye-slash'}} fa-lg "   style="{{$item->active ==1 ?'color: #1caa0f;':''}}"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="alert alert-danger text-center"> No Data Here</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
        </script>
    @endpush
</div>
