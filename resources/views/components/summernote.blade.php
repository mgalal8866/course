{{-- <div id="{{ $attributes['name'] }}">
    <div class="editor" {{ $attributes->wire('model') }} >
    </div>
</div> --}}
<div wire:ignore class="form-group" dir="ltr">
    <label>Description</label>
    <div {{ $attributes->wire('model') }} class="summernote">summernote 1</div>

    {{-- <textarea {{ $attributes->wire('model') }} id="summernote" name="body"></textarea> --}}
</div>

@pushonce('csslive')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" /> --}}
@endpushonce

@pushonce('jslive')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script> --}}
    <script type="text/javascript">
        $(document).ready(function() {

            $('.summernote').summernote({
                height: 300,
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
                //         // ['font', ['bold', 'underline', 'clear']],
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
                        console.log('onChange:', contents, $editable);
                    },
                    // onImageUpload: function(files) {
                    //     // $summernote.summernote('insertNode', imgNode);
                    //     console.log(files[0]);
                    // }
                }
            });
        });
    </script>
@endpushonce
