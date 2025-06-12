<button {{ $attributes->merge([
    'class' =>
        'px-2 py-1 rounded bg-blue-600 text-white text-xs hover:bg-blue-700 focus:outline-none'
]) }}>
    {{ $slot }}
</button>
