<x-layouts.app>
    @php
        $roleLabels = ['admin' => 'Администратор', 'editor' => 'Редактор', 'client' => 'Клиент'];
    @endphp
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Пользователи с ролью: {{ $roleLabels[$role->name] ?? ucfirst($role->name) }}</h1>
        <ul class="space-y-2">
            @foreach($users as $user)
                <li class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                    <span class="font-medium text-gray-900">{{ $user->name }}</span>
                    <span class="text-gray-500">({{ $user->email }})</span>
                </li>
            @endforeach
        </ul>
    </div>
</x-layouts.app>
