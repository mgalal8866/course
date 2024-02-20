@props([
    'id' => '',
    'value'=>''
])
<div>

    <textarea {{ $attributes->wire('model') }} class="form-control" id="{{ $id }}"> </textarea>
</div>


@pushonce('csslive')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" />
@endpushonce

@pushonce('jslive')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
@endpushonce
@push ('jslive')
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
                // popover: {
                //     image: [
                //         ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                //         ['float', ['floatLeft', 'floatRight', 'floatNone']],
                //         ['remove', ['removeMedia']]
                //     ],
                //     link: [
                //         ['link', ['linkDialogShow', 'unlink']]
                //     ],
                //     table: [
                //         ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                //         ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                //     ],
                //     air: [
                //         ['color', ['color']],
                //         ['para', ['ul', 'paragraph']],
                //         ['table', ['table']],
                //         ['insert', ['link', 'picture']]
                //     ]
                // },
                // toolbar: [
                //     ['style', ['style']],
                //     ['font', ['bold', 'underline', 'clear']],
                //     ['color', ['color']],
                //     ['para', ['ul', 'ol', 'paragraph']],
                //     ['table', ['table']],
                //     ['insert', ['link', 'picture', 'video']],
                //     ['view', ['fullscreen', 'codeview', 'help']]
                // ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('{{ $attributes->wire('model')->value() }}', contents);
                        // if ($(selector).summernote('isEmpty')) {
                        //     @this.set('{{ $attributes->wire('model')->value() }}', '');
                        // } else {
                        //     @this.set('{{ $attributes->wire('model')->value() }}', contents);
                        // }
                    }
                }
            });

        }
    </script>
@endpush
