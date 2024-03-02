<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                {{-- <div class="card-header">
                    <h4 class="card-title">{{ __('tran.category') }}</h4>
                    <a  class="btn btn-primary" wire:click="$dispatch('edit')">{{__('tran.newcategory')}}</a>

                </div> --}}
                {{-- @livewire('dashboard.courses.category.new-category') --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.course') }}</th>
                                <th>{{ __('tran.category') }}</th>
                                <th>{{ __('tran.action') }}</th>
                                <th>{{ __('tran.date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->category->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->created_at->format('m/d/Y') ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm" wire:click="dup('{{$item->id}}')">نسخ الدورة </a>
                                        {{-- <a   wire:click="$dispatch('edit',{id:'{{$item->id}}'})"><i  class="fas fa-edit fa-lg"  style="color: #c2881e;"></i></i></a>
                                        <a wire:click="delete('{{$item->id}}')"><i  class="fas fa-trash-alt fa-lg "  style="color: #ff0000;"></i></i></a>
                                        <a  wire:click="activetoggle('{{$item->id}}')"> <i   class="fas {{$item->active ==1 ?'fas fa-eye':'fa-eye-slash'}} fa-lg "   style="{{$item->active ==1 ?'color: #1caa0f;':''}}"></i></a> --}}
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
