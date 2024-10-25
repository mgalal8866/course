<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                @if(session('swal_message'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                       localStorage.removeItem('course_id');
                        Swal.fire({
                            title: '{{ session('swal_message') }}',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    });
                </script>
               @endif
                {{-- <div class="card-header">
                    <h4 class="card-title">{{ __('tran.category') }}</h4>
                    <a  class="btn btn-primary" wire:click="$dispatch('edit')">{{__('tran.newcategory')}}</a>

                </div> --}}
                {{-- @livewire('dashboard.courses.category.new-category') --}}
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('tran.date') }}</th>
                                <th>{{ __('tran.course') }}</th>
                                <th>{{ __('tran.category') }}</th>
                                <th>{{ __('tran.country') }}</th>
                                <th>{{ __('tran.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses  as $item)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $item->created_at->format('m/d/Y') ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->category->name ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $item->category->country->name ?? 'All' }}</span>
                                    </td>

                                    <td>
                                        <a class="btn btn-outline-warning btn-sm" href="{{ route('editcourse',['id'=>$item->id]) }}">تعديل</a>
                                        <a class="btn btn-outline-info btn-sm"    wire:click="dup('{{$item->id}}')"    >نسخ</a>
                                        <a class="btn btn-outline-danger btn-sm"  wire:click="delete('{{$item->id}}')" >حذف</a>
                                        {{-- <a   wire:click="$dispatch('edit',{id:'{{$item->id}}'})"><i  class="fas fa-edit fa-lg"  style="color: #c2881e;"></i></i></a> --}}
                                             {{-- <a  wire:click="activetoggle('{{$item->id}}')"> <i   class="fas {{$item->active ==1 ?'fas fa-eye':'fa-eye-slash'}} fa-lg "   style="{{$item->active ==1 ?'color: #1caa0f;':''}}"></i></a> --}}
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
        @if (Session::has('toastr'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.{{ Session::get('toastr')['type'] }}("{{ Session::get('toastr')['message'] }}");
        @endif
    </script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
                case 'error':

                    toastr.options.timeOut = 10000;
                    toastr.error("{{ Session::get('message') }}");
                    var audio = new Audio('audio.mp3');
                    audio.play();

                    break;
            }
        @endif
    </script>
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
