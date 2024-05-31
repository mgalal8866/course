<div>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card outline-success">
                <div class="card-header">
                    <h4 class="card-title">{{ __('tran.quizz') }}</h4>
                </div>
                <div class="card-body" wire:ignore.self>
                    <ul class="nav nav-tabs" role="tablist" wire:ignore>
                        @foreach (\App\Enum\Quiz::cases() as $q)
                            <li class="nav-item" wire:ignore.self>
                                <a class="nav-link @if ($q->value == $selecttab) active @endif"
                                    id="{{ $q->value }}-tab"
                                    wire:click.prevent='changeselecttab({{ $q->value }})' data-bs-toggle="tab"
                                    aria-controls="tt{{ $q->value }}" role="tab"
                                    aria-selected="true">{{ __('tran.typequiz-' . $q->name) }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active  " id="{{ $q->value }}">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>{{ __('tran.testname') }}</th>
                                            @if ($q->value == 3)
                                                <th>{{ __('tran.category') }}</th>
                                            @else
                                                <th>{{ __('tran.category') }}</th>
                                            @endif
                                            <th>{{ __('tran.statu') }}</th>
                                            <th>{{ __('tran.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($quiz  as $item)
                                            <tr>
                                                <td>
                                                    <span class="fw-bold">{{ $item->name ?? 'N/A' }}</span>
                                                </td>
                                                <td>
                                                    @if ($selecttab == 3)
                                                        <span
                                                            class="fw-bold">{{ $item->course->name ?? 'N/A' }}</span>
                                                    @else
                                                        <span
                                                            class="fw-bold">{{ $item->category->name ?? 'N/A' }}</span>
                                                    @endif
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
                                                    {{-- <a wire:click="$dispatch('edit',{id:'{{ $item->id }}'})"><i
                                                        class="fas fa-edit fa-lg" style="color: #c2881e;"></i></i></a> --}}
                                                    <a wire:click="delete('{{ $item->id }}')"><i
                                                            class="fas fa-trash-alt fa-lg "
                                                            style="color: #ff0000;"></i></i></a>
                                                    <a wire:clicactk="activetoggle('{{ $item->id }}')"> <i
                                                            class="fas {{ $item->active == 1 ? 'fas fa-eye' : 'fa-eye-slash' }} fa-lg "
                                                            style="{{ $item->ive == 1 ? 'color: #1caa0f;' : '' }}"></i></a>
                                                </td>
                                            </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="alert alert-danger text-center"> No Data Here
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

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
