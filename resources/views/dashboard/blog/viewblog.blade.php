<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.view') . ' ' . __('tran.blog') }}</h4>
                    <a class="btn btn-primary"
                        wire:click="$dispatch('edit')">{{ __('tran.add') . ' ' . __('tran.blog') }}</a>

                </div>
                @livewire('dashboard.blog.new-blog')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.title') }}</th>
                                <th>{{ __('tran.short') }}</th>
                                <th>{{ __('tran.image') }}</th>
                                <th>{{ __('tran.views') }}</th>
                                <th>{{ __('tran.category') }}</th>
                                <th>{{ __('tran.statu') }}</th>
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($blog  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->title ?? 'N/A' }}</span>
                                    </td>

                                        <td>
                                            <span class="fw-bold">  {{ Str::of(strip_tags( $item->article))->limit(20) ?? 'N/A' }}</span>
                                        </td>


                                    <td>
                                        @if ($item->image !=null)

                                        <img src="{{  $item->imageurl ?? 'N/A' }}" class="me-75" height="50" width="50" alt="Noimage" />
                                        @else
                                        <span class="fw-bold"> N/A</span>

                                        @endif
                                    </td>


                                    <td>
                                        <span class="fw-bold"> <i class="fas fas fa-eye fa-sm "> </i> {{ $item->views ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->category_id ?? 'N/A' }}</span>
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
                                                   {{__('tran.unactive')}}
                                                @break

                                                @case(1)
                                                {{__('tran.active')}}
                                                @break
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        <a wire:click="$dispatch('edit',{id:'{{ $item->id }}'})"><i
                                                class="fas fa-edit fa-lg" style="color: #c2881e;"></i></a>
                                        <a wire:click="delete('{{ $item->id }}')"><i
                                                class="fas fa-trash-alt fa-lg " style="color: #ff0000;"></i></a>
                                        <a wire:click="activetoggle('{{ $item->id }}')"> <i
                                                class="fas {{ $item->active == 1 ? 'fas fa-eye' : 'fa-eye-slash' }} fa-lg "
                                                style="{{ $item->active == 1 ? 'color: #1caa0f;' : '' }}"></i></a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="alert alert-danger text-center"> No Data Here</td>
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
