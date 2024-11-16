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
            initialize_{{$id}}('#{{ $id }}');
        });
        initialize_{{$id}}('#{{ $id }}');
    });


    function initialize_{{$id}}(selector) {
        $(selector).summernote({
            toolbar: [
             


                ['font', ['bold', 'italic', 'underline', 'clear']]
                , ['fontname', ['fontname']]
                , ['fontsize', ['fontsize']]
                , ['color', ['color']]
                , ['para', ['ul', 'ol', 'paragraph']]
                , ['height', ['height']]
                , ['table', ['table']]
                , ['insert', ['link', 'picture', 'video']]
                , ['view', ['fullscreen', 'codeview', 'help']],

            ]
            , lang: 'ar-AR'
            , tabsize: 2
            , minHeight: 100,

            callbacks: {
                onChange: function(contents, $editable) {

                    if ($(selector).summernote('isEmpty')) {
                        @this.set('{{ $attributes->wire('model')->value()}}', '');
                    } else {
                        @this.set('{{ $attributes->wire('model')->value()}}', contents);
                    }
                }
            }
        });

    }

</script>
@endpush
