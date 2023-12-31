@props([
    'tlabel' => null,
])
<div class="d-flex flex-column">
    <label class="form-check-label mb-50" for="{{ $attributes['id'] }}">{{ $tlabel }}</label>
    <div class="form-check form-switch form-check-success">
        <input type="checkbox" class="form-check-input" {{ $attributes }} />
        <label class="form-check-label" for='{{ $attributes['id'] }}'>
            <span class="switch-icon-left">
                @if ($attributes['left'])
                    {{ $attributes['left'] }}
                @else
                    <i class="fas fa-check"></i>
                @endif
            </span>
            <span class="switch-icon-right">
                @if ($attributes['right'])
                {{ $attributes['right'] }}
            @else
            <i class="fas fa-times"></i>
            @endif
        </label>
    </div>
</div>
