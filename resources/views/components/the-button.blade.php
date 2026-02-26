<button {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-primary-600 border border-transparent rounded-xl font-semibold text-sm text-white tracking-wide hover:bg-primary-700 active:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 disabled:opacity-50 transition duration-200']) }}>
    {{ $slot }}
</button>
