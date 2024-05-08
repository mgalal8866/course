<div x-data="{ content: @entangle($attributes->wire('model')) }" wire:ignore>
    <div id="editor3" x-data x-bind:content="content">
        <p>Hello World!</p>
        <p>Some initial <strong>bold</strong> text</p>
        <p><br></p>
    </div>
    @push('jslive')
        <script>
            const toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                ['blockquote', 'code-block'],
                ['link', 'image', 'video', 'formula'],

                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }, {
                    'list': 'check'
                }],
                [{
                    'script': 'sub'
                }, {
                    'script': 'super'
                }], // superscript/subscript
                [{
                    'indent': '-1'
                }, {
                    'indent': '+1'
                }], // outdent/indent
                [{
                    'direction': 'rtl'
                }], // text direction

                [{
                    'size': ['small', false, 'large', 'huge']
                }], // custom dropdown
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],

                [{
                    'color': []
                }, {
                    'background': []
                }], // dropdown with defaults from theme
                [{
                    'font': []
                }],
                [{
                    'align': []
                }],

                ['clean'] // remove formatting button
            ];
            const quill = new Quill('#editor3', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow'
            });
            quill.on('text-change', function() {
                $wire.set('model', quill.root.innerHTML)
            });
        </script>
    @endpush
</div>
