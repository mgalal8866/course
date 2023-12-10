<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.category_free') }}</h4>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser">{{__('tran.newcategory')}}</button>
                    {{-- <button type="button" class="btn btn-primary" wire:click="$dispatch('openmodel')">{{__('tran.newcategory')}}</button> --}}

                </div>
                @livewire('dashboard.free-course.category.new-category')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.category') }}</th>
                                <th>{{ __('tran.statu') }}</th>
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($CfCourse  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->name ?? 'N/A' }}</span>
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
                                        <a   wire:click="$dispatch('edit',{id:'{{$item->id}}'})"><i  class="fas fa-edit fa-lg"  style="color: #c2881e;"></i></i></a>
                                        <a wire:click="delete('{{$item->id}}')"><i  class="fas fa-trash-alt fa-lg "  style="color: #ff0000;"></i></i></a>
                                        <a  wire:click="activetoggle('{{$item->id}}')"> <i   class="fas {{$item->active ==1 ?'fas fa-eye':'fa-eye-slash'}} fa-lg "   style="{{$item->active ==1 ?'color: #1caa0f;':''}}"></i></a>
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
