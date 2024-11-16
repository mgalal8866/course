@props([
    'id' => '',
    'value' => '',
])

<div wire:ignore>
    <textarea {{ $attributes->wire('model') }} class="form-control" id="{{ $id }}" placeholder="Enter the Description" rows="5" name="body">{{ $value }}</textarea>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#{{ $id }}')){
                
            }
            .then(editor => {
                // Set the initial value
                editor.setData(@json($value));

                // Update Livewire model on change
                editor.model.document.on('change:data', () => {
                    @this.set('{{ $attributes->wire('model')->value() }}', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>
