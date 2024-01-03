@props(['date' => '', 'id' => '', 'options' => []])
@php
    $options = array_merge(
        [
            'dateFormat' => 'Y/m/d',
            'enableTime' => false,
            // 'altFormat' => 'j F Y',
            // 'altInput' => true,
        ],
        $options,
    );
@endphp
<div wire:ignore>
    <input {{ $attributes }} x-data="{
        value: @entangle($attributes->wire('model')),
        instance: undefined,
        init() {
            $watch('value', value => this.instance.setDate(value, false));
            this.instance = flatpickr(this.$refs.input, {{ json_encode((object) $options) }});
        }
    }" x-ref="input" x-bind:value="value" type="text"
      id="{{$id}}" class="form-control flatpickr-basic" value="{{ $date }}" placeholder="Y-m-d" />
</div>
