<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.orders') }}</h4>
                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUser">{{__('tran.newfreecourse')}}</button> --}}
                    {{-- <a class="btn btn-primary" wire:click="$dispatch('edit')">{{ __('tran.newfreecourse') }}</a> --}}
                    {{-- <button type="button" class="btn btn-primary" wire:click="$dispatch('openmodel')">{{__('tran.newcategory')}}</button> --}}

                </div>
                @livewire('dashboard.free-course.new-free-course')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.name') }}</th>
                                <th>{{ __('tran.coupon') }}</th>
                                <th>{{ __('tran.subtotal') }}</th>
                                <th>{{ __('tran.discount') }}</th>
                                <th>{{ __('tran.total') }}</th>
                                <th>{{ __('tran.statu') }}</th>
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->user->first_name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span><i class="fas fa-ticket-alt fa-rotate-by"
                                                style="color: #FFD43B; --fa-rotate-angle: 45deg;"></i>
                                            {{ $item->coupon->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->subtotal ?? 'N/A' }}</span>
                                    </td>

                                    <td>
                                        <span class="fw-bold">{{ $item->discount ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->total ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        @if ($item->transaction)
                                            {!! $item->transaction->statu->getLabelHtml() !!}
                                        @endif

                                    </td>

                                    <td>
                                        <a class="btn btn-info waves-effect waves-float waves-light btn-sm"
                                            href="{{ route('detailsorder',['id' => $item->id] ) }}">عرض</a>
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
