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
                    },
                    onImageUpload: function(files) {
                        var data = new FormData();
                        data.append("file", files[0]);
                        $.ajax({
                            url: '/upload-image', // Point to your image upload route
                            method: 'POST',
                            data: data,
                            processData: false,
                            contentType: false,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {


                                $(selector).summernote('insertImage', response.url);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log(textStatus + " " + errorThrown);
                            }
                        });
                    }
                }
            });

        }
    </script>
@endpush
