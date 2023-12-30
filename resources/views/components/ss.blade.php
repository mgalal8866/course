<div>
    
    <div wire:ignore>
        <select wire:ignore class="select2 form-select" id="select2-multiple" multiple="multiple" required>
            @foreach ($triners as $item)
                <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}
                </option>
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
                $this.select2().on('change', function(e) {
                    @this.set('triner', $(this).val())
                    // console.log($(this).val());
                });
            });
        </script>
    @endpush

</div>
