@extends('layouts.dashboard.app')
@section('content')
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.QrCode') }}</h4>
                    <button id="addQRCodeButton" class="btn btn-primary">إضافة كود QR</button>



                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.Qr') }}</th>
                                <th>{{ __('tran.link') }}</th>

                                <th>{{ __('tran.redirect_to') }}</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($qrCode  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{!! $item->qr !!}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ env('APP_URL') . '/qr/' . $item->code }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->redirect_to }}</span>
                                    </td>


                                    <td>
                                        <a class="btn btn-info waves-effect waves-float waves-light btn-sm edit-btn"
                                            data-id="{{ $item->id }}" data-redirect="{{ $item->redirect_to }}"
                                            href="javascript:void(0);">تعديل </a>


                                        <a class="btn btn-info waves-effect waves-float waves-light btn-sm"
                                            href="{{ route('detailsorder', ['id' => $item->id]) }}">Pdf</a>
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
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ __('tran.Edit QrCode') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="redirect_to" class="form-label">{{ __('tran.redirect_to') }}</label>
                            <input type="text" class="form-control" id="redirect_to" name="redirect_to" required>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('tran.Save Changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for adding QR Code -->
    <div class="modal fade" id="addQrcodeModal" tabindex="-1" aria-labelledby="addQrcodeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addQrcodeModalLabel">إضافة كود QR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addQrcodeForm" method="POST" action="{{ route('qr-codes.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="redirect_to" class="form-label">رابط التحويل</label>
                            <input type="url" class="form-control" id="redirect_to" name="redirect_to" required>
                        </div>
                        <div class="mb-3">
                            <label for="backcolor" class="form-label">اختر اللون الخلفية</label>
                            <input type="color" class="form-control form-control-color" id="backcolor" name="backcolor"
                                value="#ffffff" required>
                               
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">اختر اللون</label>
                            <input type="color" class="form-control form-control-color" id="color" name="color"
                                value="#000000" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('jslive')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const addQRCodeButton = document.getElementById('addQRCodeButton');
                const addQrcodeModal = new bootstrap.Modal(document.getElementById('addQrcodeModal'));

                if (addQRCodeButton) {
                    addQRCodeButton.addEventListener('click', () => {
                        addQrcodeModal.show();
                    });
                }

                const addQrCodeForm = document.getElementById('addQrcodeForm'); // Make sure the form ID is correct

                if (addQrCodeForm) {
                    addQrCodeForm.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent normal form submission

                        const formData = new FormData(this);
                        const actionUrl = this.action;

                        fetch(actionUrl, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .content
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    return response.text(); // Assuming response is HTML or redirect
                                } else {
                                    throw new Error('Failed to submit form');
                                }
                            })
                            .then(html => {
                                // Optional: Handle success or update the page as needed
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'QR code has been added.',
                                    icon: 'success',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    },
                                    buttonsStyling: false
                                }).then(() => {
                                    location.reload(); // Reload the page to show the new QR code
                                });
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something went wrong.',
                                    icon: 'error',
                                    customClass: {
                                        confirmButton: 'btn btn-danger'
                                    },
                                    buttonsStyling: false
                                });
                            });
                    });
                } else {
                    console.error('Form not found!');
                }
            });


            document.addEventListener('DOMContentLoaded', () => {
                const editButtons = document.querySelectorAll('.edit-btn');

                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const redirect = this.getAttribute('data-redirect');

                        // تعبئة البيانات في المودال
                        document.getElementById('redirect_to').value = redirect;

                        // تحديث الـ form action
                        const form = document.getElementById('editForm');
                        form.action = `/dashboard/qr-codes/${id}`;

                        // فتح المودال
                        const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                        editModal.show();
                    });
                });

                // إضافة حدث لعرض SweetAlert عند استقبال الرسالة
                const editForm = document.getElementById('editForm');
                editForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const formData = new FormData(this);
                    const actionUrl = this.action;

                    fetch(actionUrl, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // إظهار رسالة باستخدام SweetAlert
                            Swal.fire({
                                title: data.message,
                                icon: 'success',
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                },
                                buttonsStyling: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // عند النقر على زر OK، يتم تحديث الصفحة
                                    location.reload(); // تحديث الصفحة
                                }
                            });

                            // إغلاق المودال
                            const editModal = bootstrap.Modal.getInstance(document.getElementById(
                                'editModal'));
                            editModal.hide();
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong!',
                                icon: 'error',
                                customClass: {
                                    confirmButton: 'btn btn-danger'
                                },
                                buttonsStyling: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // عند النقر على زر OK، يمكن إضافة أي إجراء إضافي هنا إذا أردت
                                    location.reload(); // تحديث الصفحة
                                }
                            });
                        });
                });
            });
        </script>
    @endpush
    </div>
@endsection
