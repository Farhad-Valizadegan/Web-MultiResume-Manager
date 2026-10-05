<button {{ $attributes->merge(['type' => 'submit', 'class' => 'rf-button rf-button-primary']) }}>
    {{ $slot }}
</button>
