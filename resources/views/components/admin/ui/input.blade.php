@props(['label', 'name', 'type' => 'text', 'placeholder' => '', 'value' => '', 'required' => false])

<div class="admin-form-group">
    @if($label)
        <label for="{{ $name }}" class="admin-label">
            {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" wire:model="{{ $name }}"
        class="admin-input @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $attributes }}>

    @error($name)
        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
    @enderror
</div>