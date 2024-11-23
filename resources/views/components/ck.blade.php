@props([
    'id' => '',
    'value' => '',
])

<div wire:ignore>
    <textarea {{ $attributes->wire('model') }} class="form-control" id="{{ $id }}"
        placeholder="Enter the Description" rows="5" name="body">{{ $value }}</textarea>
</div>
<link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    var currentLocale = '{{ LaravelLocalization::getCurrentLocale() }}';

    document.addEventListener('DOMContentLoaded', function() {

        CKEDITOR.plugins.addExternal('ckeditor_wiris', 'https://www.wiris.net/demo/plugins/ckeditor/',
            'plugin.js');
        CKEDITOR.editorConfig = function(config) {
            config.allowedContent = true;
            config.versionCheck = false;
            config.contentsCss = ['body { font-family: "Cairo", sans-serif; }'];

            config.image2_alignClasses = ['image-align-left', 'image-align-center', 'image-align-right'];
            config.image2_disableResizer = false; // Enable image resizing
        };
        const editor = CKEDITOR.replace(document.querySelector('#{{ $id }}'), {
            // filebrowserUploadUrl: '/notes/add/ajax/upload-inline-image/index.cfm',
            extraPlugins: 'ckeditor_wiris'
        });

        // Bind CKEditor changes to Livewire property
        editor.on('change', function() {
            @this.set('{{ $attributes->wire('model')->value() }}', editor.getData());
        });
        editor.on('instanceReady', function () {
        // Listen for MathType button clicks
        editor.on('afterCommandExec', function (event) {
            if (event.data.name === 'ckeditor_wiris_formulaEditor') {
                // Delay to ensure MathType editor is fully rendered
                setTimeout(function () {
                    const mathEditorInput = document.querySelector('.wrs_modal_dialog textarea, .wiris_formula_editor');
                    if (mathEditorInput) {
                        mathEditorInput.focus(); // Set focus inside MathType editor
                    }
                }, 500); // Adjust delay as needed
            }
        });
    });


        editor.setData(@json($value));

    });
</script>
