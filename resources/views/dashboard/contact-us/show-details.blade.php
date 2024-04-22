<div>
    <div wire:ignore.self class="modal fade" id="showdetails" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    @if ($contents1)
                        <table>
                            <tbody>

                                <tr>
                                    <td class="pe-1">{{ __('tran.name') }} : </td>
                                    <td><span class="fw-bold">{{ $contents1->name }}</span>
                                    </td>

                                </tr>
                                <tr>
                                    <td class="pe-1">{{ __('tran.phone') }} : </td>
                                    <td>
                                        <span class="fw-bold">{{ $contents1->phone }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pe-1">{{ __('tran.mail') }} : </td>
                                    <td>
                                        <span class="fw-bold">{{ $contents1->mail }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pe-1">{{ __('tran.typecontent') }} : </td>
                                    <td>
                                        <span class="fw-bold">{{ $contents1->type ==0?'ألعمل لدى المؤسسة':'التواصل بالمؤسسة' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pe-1">{{ __('tran.body') }} : </td>
                                    <td>
                                        <span class="fw-bold">{{ $contents1->body }}</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    @endif
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
        window.addEventListener('openmodel', event => {
            // console.log('www');
            $('#showdetails').modal("show");

        });
        window.addEventListener('closemodel', event => {
            // console.log('www');
            $('#showdetails').modal("hide");

        });
    </script>
@endpush
