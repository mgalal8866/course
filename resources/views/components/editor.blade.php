@props([])

<div id="full-wrapper" wire:ignore>
    <div id="full-container">
        <div class="editor" wire:ignore>

        </div>
    </div>
</div>
@push('csslive')
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/katex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/monokai-sublime.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/quill.snow.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/quill.bubble.css') }}">
@endpush
@push('jslive')
    <script src="{{ asset('asset/vendors/js/editors/quill/katex.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/js/editors/quill/highlight.min.js') }}"></script>
    <script src="{{ asset('asset/vendors/js/editors/quill/quill.min.js') }}"></script>
    <script>
        (function(window, document, $) {
            'use strict';

            var Font = Quill.import('formats/font');
            Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
            Quill.register(Font, true);

            // Full Editor
            var fullEditor = new Quill('#full-container .editor', {
                bounds: '#full-container .editor',
                modules: {
                    formula: true,
                    syntax: true,
                    toolbar: [
                        [{
                                font: []
                            },
                            {
                                size: []
                            }
                        ],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{
                                color: []
                            },
                            {
                                background: []
                            }
                        ],
                        [{
                                script: 'super'
                            },
                            {
                                script: 'sub'
                            }
                        ],
                        [{
                                header: '1'
                            },
                            {
                                header: '2'
                            },
                            'blockquote',
                            'code-block'
                        ],
                        [{
                                list: 'ordered'
                            },
                            {
                                list: 'bullet'
                            },
                            {
                                indent: '-1'
                            },
                            {
                                indent: '+1'
                            }
                        ],
                        [
                            'direction',
                            {
                                align: []
                            }
                        ],
                        ['link', 'image', 'video', 'formula'],
                        ['clean']
                    ]
                },
                theme: 'snow'
            });

            var editors = [fullEditor];

            fullEditor.on('text-change', function() {
                let value = document.getElementsByClassName('ql-editor')[0].innerHTML;
                console.log(value);
                @this.set('article', value)
            })
        })(window, document, jQuery);
    </script>

@endpush
