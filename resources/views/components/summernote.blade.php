@props([
    'id' => '',
    'value' => '',
])
<div wire:ignore>
    <textarea {{ $attributes->wire('model') }} class="form-control" id="{{ $id }}"> </textarea>
</div>
@push('jslive')
    <script type="text/javascript">
        document.addEventListener('livewire:initialized', () => {
            Livewire.hook('morph.added', (element) => {
                initialize_{{ $id }}('#{{ $id }}');
            });
            initialize_{{ $id }}('#{{ $id }}');
        });


        function initialize_{{ $id }}(selector) {
            $(selector).summernote({
                lang: 'ar-AR',
                tabsize: 2,
                minHeight: 100,
                callbacks: {
                    onChange: function(contents, $editable) {

                        if ($(selector).summernote('isEmpty')) {
                            @this.set('{{ $attributes->wire('model')->value() }}', '');
                        } else {
                            @this.set('{{ $attributes->wire('model')->value() }}', contents);
                        }
                    } 
                }
            });

        }
    </script>
@endpush
