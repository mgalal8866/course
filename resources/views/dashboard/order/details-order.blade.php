@push('csslive')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-invoice.min.css') }}">
@endpush
<div>
    <section class="invoice-preview-wrapper">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12">
                <div class="card invoice-preview-card">
                    <div class="card-body invoice-padding pb-0">
                        <!-- Header starts -->
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                            <div>
                                <div class="logo-wrapper">
                                    <img src="{{ asset('asset/images/logo.png') }}" width="50" />

                                </div>
                                {{-- <p class="card-text mb-25">{{$setting->address_shop}}</p>
                                <p class="card-text mb-0">{{$setting->phone_shop}}</p> --}}
                            </div>
                            <div class="mt-md-0 mt-2">
                                <h4 class="invoice-title">
                                    {{ __('tran.invoicenumber') }}
                                    <span class="invoice-number"># {{ $order->id ?? '' }}</span>
                                </h4>
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">{{ __('tran.invodate') }}:</p>
                                    <p class="invoice-date">{{ $order->date ?? '' }}</p>
                                </div>
                                {{-- <div class="invoice-date-wrapper">
                                <p class="invoice-date-title">{{__('tran.derivername')}}:</p>
                                    <p class="invoice-date">{{$order->employee->name??''}}</p>
                                </div> --}}
                                <div class="invoice-date-wrapper">
                                    <p class="invoice-date-title">{{ __('tran.username') }}:</p>
                                    {{-- <p class="invoice-date">{{$order->user->first_name??''}}</p> --}}
                                </div>
                            </div>
                        </div>
                        <!-- Header ends -->
                    </div>

                    <hr class="invoice-spacing" />

                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row invoice-spacing">
                            <div class="col-xl-8 p-0">
                                <h6 class="mb-2"> {{ __('tran.customerdata') }} :</h6>
                                <h6 class="mb-25">{{ $order->user->first_name ?? '' }}</h6>
                                {{-- <p class="card-text mb-25">{{$order->user->region->city->name??'' .' , '. $order->user->region->name??'' .' , '. $order->user->client_state??''}}</p>
                                <p class="card-text mb-25">{{$order->user->client_fhonewhats??''}}</p> --}}
                            </div>
                            <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                <h6 class="mb-2">{{ __('tran.paymentdetails') }} :</h6>
                                <table>
                                    <tbody>

                                        <tr>
                                            <td class="pe-1">{{ __('tran.coupondis') }} : </td>
                                            <td><span
                                                    class="fw-bold">{{ $order->code != null ? $order->coupon->name : 'لايوجد' }}</span>
                                            </td>
                                            <td><span
                                                    class="fw-bold">{{ $order->code != null ? $order->coupon->discount . '%' : '' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">{{ __('tran.paymentname') }} : </td>
                                            <td><span
                                                    class="fw-bold">{{ $order->transaction->payment_id != 0 ? $order->transaction->payment->name : 'محفظة' }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">{{ __('tran.statu') }} : </td>
                                            <td><span class="fw-bold">
                                                    @if ($order->transaction)
                                                        {!! $order->transaction->statu->getLabelHtml() !!}
                                                    @endif
                                                </span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Address and Contact ends -->

                    <!-- Invoice Description starts -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="py-1">{{ __('tran.product') }}</th>
                                    <th class="py-1">{{ __('tran.price') }}</th>
                                    <th class="py-1">{{ __('tran.qty') }}</th>
                                    <th class="py-1">{{ __('tran.subtotal') }}</th>
                                    <th class="py-1">{{ __('tran.coupon') }}</th>
                                    <th class="py-1">{{ __('tran.discount') }}</th>
                                    <th class="py-1">{{ __('tran.total') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->order_details as $invod)
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text fw-bold mb-25">
                                                {{ $invod->is_book == 1 ? $invod->book->book_name : $invod->course->name }}
                                            </p>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ $invod->price ?? '' }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ $invod->qty ?? '' }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ $invod->subtotal ?? '' }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">
                                                @if ($invod->coupon_id)
                                                    <span
                                                        class="badge badge-light-success ">{{ $invod->coupon->name ?? '' }}</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ $invod->discount }}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ $invod->total }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="card-body invoice-padding pb-0">
                        <div class="row invoice-sales-total-wrapper">
                            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                <p class="card-text mb-0">
                                    @if ($order->code != null)
                                        <span class="fw-bold ">{{ __('tran.note') }}:</span> <span
                                            class="ms-75 text-danger">كوبون الخصم سارى فقط على الكورسات </span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                <div class="invoice-total-wrapper">
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{ __('tran.subtotal') }}:</p>
                                        <p class="invoice-total-amount">{{ $order->order_details->sum('subtotal') }}
                                        </p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{ __('tran.discount') }} : </p>
                                        <p class="invoice-total-amount">{{ $order->order_details->sum('discount') }}
                                        </p>
                                    </div>
                                    {{-- <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{__('tran.total_add_amount')}} : </p>
                                        <p class="invoice-total-amount">{{$order->total_add_amount}}</p>
                                    </div> --}}

                                    <hr class="my-50" />
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{ __('tran.total') }}:</p>
                                        <p class="invoice-total-amount">{{ $order->order_details->sum('total') }}</p>
                                    </div>
                                    {{-- <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{__('tran.paymentval')}}:</p>
                                        <p class="invoice-total-amount">{{$order->paid}}</p>
                                    </div> --}}
                                    {{-- <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{__('tran.remaining')}}:</p>
                                        <p class="invoice-total-amount">{{$order->remaining}}</p>
                                    </div> --}}
                                    {{-- <div class="invoice-total-item">
                                        <p class="invoice-total-title">Tax:</p>
                                        <p class="invoice-total-amount">21%</p>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Description ends -->

                    <hr class="invoice-spacing" />
                    <!-- Invoice Note starts -->
                    {{-- <div class="card-body invoice-padding pt-0">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-bold">Note:</span>
                                <span>It was a pleasure working with you and your team. We hope you will keep us in mind
                                    for future freelance
                                    projects. Thank You!</span>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Invoice Note ends -->
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                <div class="card">
                    <div class="card-body">
                        <select class="form-select mb-2" wire:model.live='status' required>
                            @foreach (\App\Enum\PaymentStatus::cases() as $q)
                                <option value="{{ $q->value }}">{{ __('tran.typep-' . $q->name) }} </option>
                            @endforeach
                        </select>
                        {{-- <a class="btn btn-success w-100 mb-75" href="" target="_blank"> {{ __('tran.save') }} </a> --}}
                        {{-- <a class="btn btn-outline-secondary w-100 mb-75" href="{{route('print',['type'=>'open','id'=>$order->id])}}"
                            target="_blank"> طباعة </a> --}}
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </section>
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
    <script src="{{ asset('app-assets/js/scripts/pages/app-invoice.min.js') }}"></script>
@endpush
