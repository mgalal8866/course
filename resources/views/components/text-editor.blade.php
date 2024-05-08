@props(['value' => ''])
<div
class="rounded-md shadow-sm"
x-data="{
    value: @entangle($attributes->wire('model')),
    isFocused() { return document.activeElement !== this.$refs.trix },
    setValue() { if(this.$refs.trix.editor) this.$refs.trix.editor.loadHTML(this.value) },
}"
x-init="setValue(); $watch('value', () => isFocused() && setValue())"
x-on:trix-change="value = $event.target.value"
{{ $attributes->whereDoesntStartWith('wire:model') }}
wire:ignore>
<input id="body" value="{!!  $value !!}" type="hidden">
<trix-editor x-ref="trix" input="body" class="trix-editor form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></trix-editor>
</div>
