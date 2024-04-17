<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.view') . ' ' . __('tran.payment_method') }}</h4>
                    {{-- <a class="btn btn-primary"
                        wire:click="$dispatch('edit')">{{ __('tran.add') . ' ' . __('tran.trainee') }}</a> --}}
                </div>
                {{-- @livewire('dashboard.payment_method.new-payment_method') --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.name') }}</th>
                                <th>{{ __('tran.phone') }}</th>
                                <th>{{ __('tran.mail') }}</th>
                                <th>{{ __('tran.phone_parent') }}</th>
                                <th>{{ __('tran.mail_parent') }}</th>
                                <th>{{ __('tran.country') }}</th>
                                <th>{{ __('tran.gender') }}</th>
                                <th>{{ __('tran.point') }}</th>
                                <th>{{ __('tran.wallet') }}</th>
                                <th>{{ __('tran.statu') }}</th>
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($paymentmethod  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->first_name ?? 'N/A' }} {{ $item->last_name  ?? 'N/A'  }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->phone ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->email ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->phone_parent ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->email_parent?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->country->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="badge  bg-secondary">
                                            @switch($item->gender)
                                                @case(1)
                                                    <i class="fas fa-mars" style="color: #1ac1f4;"></i>
                                                    {{ __('tran.male') }}
                                                @break

                                                @case(2)
                                                    <i class="fas fa-venus" style="color: #fb04f3;"></i>
                                                    {{ __('tran.female') }}
                                                @break
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->point ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->wallet ?? 'N/A' }}</span>
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
