<div id="{{ $attributes['name'] }}" wire:ignore>
    <div class="editor" {{ $attributes->wire('model') }}  wire:ignore>
    </div>
</div>
@pushOnce('csslive')
<link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/katex.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/monokai-sublime.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('asset/vendors/css/editors/quill/quill.bubble.css') }}">


    <style>
        .ql-container {
            height: 100px;
        }
    </style>
@endPushOnce

@pushOnce('jslive')
<script src="{{ asset('asset/vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{ asset('asset/vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{ asset('asset/vendors/js/editors/quill/quill.min.js') }}"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            (function(window, document, $) {
                'use strict';
                // setTimeout(() => {
                    var Font = Quill.import('formats/font');
                    Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
                    Quill.register(Font, true);

                    // Full Editor
                    var fullEditor = new Quill('#{{ $attributes['name'] }} .editor', {
                        bounds: '#{{ $attributes['name'] }} .editor',
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
                        let value = fullEditor.root.innerHTML;
                        if('{{ $attributes->wire('model')->value() }}' != null){
                            @this.set('{{ $attributes->wire('model')->value() }}', value);
                        }

                    })

                // }, 100);
            })(window, document, jQuery);
            // Livewire.hook('morph.added', (element) => {
            Livewire.hook('morph.added', (element) => {
                // setTimeout(() => {
                var Font = Quill.import('formats/font');
                Font.whitelist = ['sofia', 'slabo', 'roboto', 'inconsolata', 'ubuntu'];
                Quill.register(Font, true);
                var fullEditor = new Quill('#{{ $attributes['name'] }} .editor', {
                    bounds: '#{{ $attributes['name'] }} .editor',
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
                    let value = fullEditor.root.innerHTML;
                    if('{{ $attributes->wire('model')->value() }}' != null){
                            @this.set('{{ $attributes->wire('model')->value() }}', value);
                        }

                })
            // }, 100);

            });
        });
    </script>
@endPushOnce
