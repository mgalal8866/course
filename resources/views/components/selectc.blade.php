@props([
    'selectnull' => '',
    'items' => '',
    'value' => '',
    'display' => '',
    'display2' => '',
    'displaylvl2' => '',
    'lvl2' => '',
    'lvl3' => '',
    'lvl4' => '',
    'id' => '',
    'emit' => '',
])
<div wire:ignore>
    <select id="{{ $id }}" {{ $attributes }} class="select2 form-select" id="select2-basic">
        <option value="">{{ $selectnull ?? '' }}</option>
        @foreach ($items as $item)
            <option value="{{ $item->$value ?? '' }}">
                {{ $lvl2 == '' ? $item->$display??'' : $item->$display->$lvl2 ?? '' }}
                {{ $display2 != '' ? ($displaylvl2  == '' ? $item->$display2??'' : $item->$display2->$displaylvl2??''): '' }}</option>

        @endforeach
    </select>

</div>
@push('csslive')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/forms/select/select2.min.css') }}">
@endpush
@push('jslive')
    <script src="{{ asset('asset/vendors/js/forms/select/select2.full.min.js') }}"></script>
    <script>
        var select = $('.select2');
        select.each(function() {
            var $this = $(this);
            $this.wrap('<div wire:ignore class="position-relative"></div>');
            $this.select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%',
                dropdownParent: $this.parent()
            });
            $this.on('change', function(e) {
                livewire.emit('{{ $emit }}', e.target.value)
            });
        });
    </script>
@endpush
