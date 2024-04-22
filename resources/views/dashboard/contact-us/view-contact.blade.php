<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.contactus') }}</h4>
                </div>

                @livewire('dashboard.contact-us.show-details')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.date') }}</th>
                                <th>{{ __('tran.name') }}</th>
                                <th>{{ __('tran.mail') }}</th>
                                <th>{{ __('tran.phone') }}</th>
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contents  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->created_at ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->mail ?? 'N/A' }}</span>
                                    </td>

                                    <td>
                                        <span class="fw-bold">{{ $item->phone ?? 'N/A' }}</span>
                                    </td>

                                    <td>
                                        <a class="btn btn-info waves-effect waves-float waves-light btn-sm"
                                        wire:click="$dispatch('showdetails',{id:'{{$item->id}}'})">عرض التفاصيل</a>

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
