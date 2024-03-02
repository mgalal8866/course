@props([
    'namefile' => null,
    'tlabel' => null,

])
@if($tlabel)
    <label class="form-label"   >{{ $tlabel }} : </label>
@endif
{{-- <div x-data="{ isUploading: false, progress: 0, name: '{{ $namefile??null }}'}" --}}
<div x-data="{ isUploading: false, progress: 0, name: null}"
    x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false"
    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress">

    <div class="overflow-hidden position-relative w-64 ">
        <label class="btn btn-success" x-show="!name">
            <i class="fas fa-upload"></i>
            <span class="ml-2">Select File</span>
            <input class="hidden" type="file" {{ $attributes }}  x-on:change="name = $event.target.files[0].name">
        </label>
        <div class="text-gray-500" x-show="name">
            <span x-show="isUploading">Uploading... Please wait.</span>
            <div class="d-flex align-items-center" x-show="!isUploading">
                <div class="d-flex flex-grow-1 overflow-hidden mr-2">
                    <span x-text="name"></span>
                </div>
                <span  x-show="!isUploading">

                    <button  type="button" class="btn btn-sm btn-danger d-inline-flex align-items-center justify-content-center rounded-circle
                    bg-red-600 hover:bg-red-800 text-white shadow-lg hover-shadow-xl
                    transition duration-150 ease-in-out focus:bg-red-700 outline-none focus-outline-none" style="height: 2rem; width: 2rem; " x-on:click="progress = 0; name = null; $wire.file = null; $wire.set('{{$attributes->wire('model')->value()}}', '')">
                    <i class="fas fa-trash-alt"></i>

                </button>
            </span>
            </div>
        </div>

    </div>

    <!-- Progress Bar -->
    <div x-show="isUploading"  >
        <x-loading></x-loading>
    </div>

    <div x-show="isUploading" class="progress progress-sm mt-2 rounded">
        <div class="progress-bar bg-success  progress-bar-striped" role="progressbar" aria-valuenow="40"
            aria-valuemin="0" aria-valuemax="100" :style="`width: ${progress}%`">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div>

</div>
{{-- @props([
    'imagenew' => null,
    'tlabel' => null,
    'id' => null,
])
<label class="form-label" for="{{ $imagenew }}">{{ $tlabel ?? __('tran.image') }} : </label>

<div wire:ignore x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true" x-on:livewire-upload-finish="uploading = false"
    x-on:livewire-upload-error="uploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
<div wire:ignore>

    <input class="form-control" {{ $attributes }}  id="{{ $id }}" type="file" />
</div>

    <div x-show="uploading" class="progress progress-sm mt-2 rounded">
        <div class="progress-bar bg-success  progress-bar-striped" role="progressbar" aria-valuenow="40"
            aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div>
</div> --}}
