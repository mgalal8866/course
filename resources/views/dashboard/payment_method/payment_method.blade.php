<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.view') . ' ' . __('tran.payment_method') }}</h4>
                    <a class="btn btn-primary"
                        wire:click="$dispatch('edit')">{{ __('tran.add') . ' ' . __('tran.payment_method') }}</a>
                </div>

                @livewire('dashboard.payments.new-payment_method')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.image') }}</th>
                                <th>{{ __('tran.name') }}</th>
                               <th>{{ __('tran.type') }}</th>
                                  {{--<th>{{ __('tran.mail') }}</th>
                                <th>{{ __('tran.phone_parent') }}</th>
                                <th>{{ __('tran.mail_parent') }}</th>
                                <th>{{ __('tran.country') }}</th> --}}
                                {{-- <th>{{ __('tran.gender') }}</th>
                                <th>{{ __('tran.point') }}</th>
                                <th>{{ __('tran.wallet') }}</th>
                                <th>{{ __('tran.statu') }}</th> --}}
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paymentmethod  as $item)
                                <tr>
                                    <td>
                                        <img src="{{ $item->imageurl ?? 'N/A' }}" class="me-75" height="50" width="50" alt="Noimage" />
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{!! $item->type->getLabelHtml() !!}</span>
                                    </td>

                                    <td>

                                        {{-- <a class="btn btn-danger waves-effect waves-float waves-light btn-sm">حالة</a> --}}
                                        {{-- <a class="btn btn-info waves-effect waves-float waves-light btn-sm">عرض</a> --}}
                                       @if($item->type->value != 2)  <a class="btn btn-info waves-effect waves-float waves-light btn-sm"
                                        wire:click="$dispatch('edit',{id:'{{ $item->id }}'})" >تعديل</a>
                                        @endif

                                        {{-- <a wire:click="$dispatch('edit',{id:'{{ $item->id }}'})"><i
                                                class="fas fa-edit fa-lg" style="color: #c2881e;"></i></a>
                                        <a wire:click="delete('{{ $item->id }}')"><i
                                                class="fas fa-trash-alt fa-lg " style="color: #ff0000;"></i></a>
                                        <a wire:click="activetoggle('{{ $item->id }}')"> <i
                                                class="fas {{ $item->active == 1 ? 'fas fa-eye' : 'fa-eye-slash' }} fa-lg "
                                                style="{{ $item->active == 1 ? 'color: #1caa0f;' : '' }}"></i></a> --}}
                                    </td>
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
