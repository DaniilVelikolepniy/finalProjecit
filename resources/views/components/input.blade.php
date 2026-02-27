@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-gray-200 rounded-xl py-2.5 px-4 text-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition shadow-sm']) !!}>
