@props(['label' => null, 'name', 'rows' => 4, 'placeholder' => '', 'required' => false])

<div class="admin-form-group">
    @if($label)
        <label for="{{ $name }}" class="admin-label">
            {{ $label }} @if($required) <span class="text-danger">*</span> @endif
        </label>
    @endif

    <textarea id="{{ $name }}" name="{{ $name }}" wire:model="{{ $name }}" rows="{{ $rows }}"
        class="admin-textarea @error($name) is-invalid @enderror" placeholder="{{ $placeholder }}" {{ $required ? 'required' : '' }} {{ $attributes }}></textarea>

    @error($name)
        <span class="text-danger small mt-1 d-block">{{ $message }}</span>
    @enderror
</div>