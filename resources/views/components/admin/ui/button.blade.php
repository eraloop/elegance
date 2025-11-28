@props(['type' => 'submit', 'color' => 'primary', 'icon' => null, 'label' => '', 'ariaLabel' => null])

<button type="{{ $type }}" {{ $attributes->merge(['class' => 'admin-btn admin-btn-' . $color]) }} @if($ariaLabel || (!$label && $icon)) aria-label="{{ $ariaLabel ?? 'Button' }}" @endif>
    @if($icon)
        <i class="{{ $icon }}"></i>
    @endif
    {{ $label }}
    {{ $slot }}
</button>