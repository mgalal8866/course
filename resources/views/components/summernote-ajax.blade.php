@props([
    'id' => '',
    'value' => '',
])
{{-- <div wire:ignore> --}}
<div wire:ignore>

    <textarea   class="form-control" id="{{ $id }}"></textarea>
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

                        } else {

                        }
                    }
                }
            });


            // $(selector).summernote('pasteHTML', '{!! $value !!}');
        }




    </script>
@endpush
