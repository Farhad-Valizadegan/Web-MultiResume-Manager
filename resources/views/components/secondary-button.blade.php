<button {{ $attributes->merge(['type' => 'button', 'class' => 'rf-button rf-button-secondary']) }}>
    {{ $slot }}
</button>
