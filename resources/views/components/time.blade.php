@props(['date' => '', 'id' => '', 'optionss' => []])
@php
    $optionss = array_merge(
        [
            'noCalendar' => true,
            'enableTime' => true,

        ],
        $optionss,
    );
@endphp
<div>
    <input {{ $attributes }}  {{ $attributes->merge(['class' => 'form-control flatpickr-time text-start']) }}
    x-data="{
        value: @entangle($attributes->wire('model')),
        instance: undefined,
        init() {
            $watch('value', value => this.instance.setDate(value, false));
            this.instance =flatpickr(this.$refs.input, {{ json_encode((object) $optionss) }});
        }
    }"

    x-ref="input"
    type="text"
    id="{{$id}}"
    placeholder="HH:MM:SS" />
</div>
