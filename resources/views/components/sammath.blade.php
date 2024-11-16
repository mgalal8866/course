@props([
    'id' => '',
    'value' => '',
])

@push('csslive')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.9.0/katex.min.css">
    <script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>

@endpush

<div wire:ignore>
    <textarea {{ $attributes->wire('model') }} class="form-control" id="{{ $id }}">{{ $value }}</textarea>
</div>

@push('jslive')

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
<script src="https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image"></script>
<script>
    $('#mathTypeBtn').on('click', function() {
        WIRISplugin.openEditor(function(content) {
            console.log('Inserted content:', content);
        });
    });
</script>
<script type="text/javascript">
    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('morph.added', (element) => {
            initializeSummernote('#{{ $id }}');
        });
        initializeSummernote('#{{ $id }}');
    });

    function initializeSummernote(selector) {
        $(selector).summernote({
            toolbar: [
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video', 'hr', 'mathType']], // Add MathType button
                ['view', ['fullscreen', 'codeview']]
            ],
            lang: 'ar-AR',
            tabsize: 2,
            minHeight: 100,
            buttons: {
                mathType: function() {
                    return {
                        contents: '<button type="button" class="btn btn-default">Math Type</button>',
                        callback: function() {
                            // Ensure WIRISplugin is loaded and ready
                            if (typeof WIRISplugin !== 'undefined') {
                                WIRISplugin.openEditor(function(content) {
                                    $(selector).summernote('insertHTML', content);
                                });
                            } else {
                                console.error('WIRIS plugin is not defined.');
                            }
                        }
                    };
                }
            },
            callbacks: {
                onChange: function(contents) {
                    @this.set('{{ $attributes->wire('model')->value() }}', contents || ''); // Use contents or set to empty
                }
            }
        }).summernote('code', @json($value)); // Set initial value from the model
    }
</script>
@endpush
