<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.view') . ' ' . __('tran.notifications') }}</h4>
                    <a class="btn btn-primary"
                        wire:click="$dispatch('edit')">{{ __('tran.send') . ' ' .__('tran.notification') }}</a>
                </div>

                @livewire('dashboard.notification.new-notification')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.user') }}</th>
                                <th>{{ __('tran.title') }}</th>
                                <th>{{ __('tran.type') }}</th>
                                <th>{{ __('tran.redirect') }}</th>
                                <th>{{ __('tran.read') }}</th>
                                <th>{{ __('tran.date') }}</th>

                                {{-- <th>{{ __('tran.action') }}</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notifcation  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->user->first_name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->title ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{!! $item->type->getLabelHtml() !!}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->redirect}}</span>
                                        {{-- <span class="fw-bold">{{ $item->redirect_id}}</span> --}}
                                    </td>
                                    <td>
                                        <span class="fw-bold">@if ($item->is_read == 0 )
                                            <i class="far fa-eye" style="color: #63E6BE;"></i>
                                            @else
                                            <i class="far fa-eye-slash" style="color: #fa0000;"></i>
                                        @endif</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->created_at}}</span>
                                    </td>

                                    {{-- <td> --}}
                                        {{-- <a class="btn btn-danger waves-effect waves-float waves-light btn-sm">حالة</a> --}}
                                        {{-- <a class="btn btn-info waves-effect waves-float waves-light btn-sm">عرض</a> --}}
                                        {{-- <a class="btn btn-info waves-effect waves-float waves-light btn-sm"
                                        wire:click="$dispatch('edit',{id:'{{ $item->id }}'})" >تعديل</a> --}}

                                        {{-- <a wire:click="$dispatch('edit',{id:'{{ $item->id }}'})"><i
                                                class="fas fa-edit fa-lg" style="color: #c2881e;"></i></a>
                                        <a wire:click="delete('{{ $item->id }}')"><i
                                                class="fas fa-trash-alt fa-lg " style="color: #ff0000;"></i></a>
                                        <a wire:click="activetoggle('{{ $item->id }}')"> <i
                                                class="fas {{ $item->active == 1 ? 'fas fa-eye' : 'fa-eye-slash' }} fa-lg "
                                                style="{{ $item->active == 1 ? 'color: #1caa0f;' : '' }}"></i></a> --}}
                                    {{-- </td> --}}
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="15" class="alert alert-danger text-center"> No Data Here</td>
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
