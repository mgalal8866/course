@props([
    'id' => '',
    'value' => '',
])
<div wire:ignore>
{{-- <div > --}}
    <textarea {{ $attributes->wire('model') }} class="form-control" id="{{ $id }}"></textarea>
</div>

@push('csslive')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" />
@endpush

@push('jslive')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
@endpush
@push('jslive')
    <script type="text/javascript">
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('morph.added', (element) => {
                initialize_{{ $id }}('#{{ $id }}');
            });

            initialize_{{ $id }}('#{{ $id }}');
            // console.log('{{ $value }}');
        });



        function initialize_{{ $id }}(selector) {

            $(selector).summernote({
                lang: 'ar-AR',
                tabsize: 2,
                minHeight: 100,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('{{ $attributes->wire('model')->value() }}', contents);
                        if ($(selector).summernote('isEmpty')) {
                            @this.set('{{ $attributes->wire('model')->value() }}', '');
                        } else {
                            @this.set('{{ $attributes->wire('model')->value() }}', contents);
                        }
                    }
                }
            });


            // $(selector).summernote('pasteHTML', '{!! $value !!}');
        }
    </script>
@endpush
