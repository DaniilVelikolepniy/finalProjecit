<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="mb-6">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-sm border border-gray-100 overflow-hidden rounded-2xl">
        {{ $slot }}
    </div>
</div>
