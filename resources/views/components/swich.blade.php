
<div wire:ignore>
    <div class="form-check form-switch form-check-success ">
        <input type="checkbox" class="form-check-input"
        {{ $attributes->wire('model') }}

            id="{{$attributes->wire('model')->value()}}" />
        <label class="form-check-label" for='{{ $attributes->wire('model')->value()}}'>
            <span class="switch-icon-left">
                <i class="fas fa-dollar-sign"></i>
            </span>
            <span class="switch-icon-right">
                <i class="fas fa-times"></i>
            </span>

        </label>
    </div>
</div>

