<x-layouts.app>
    <h1>Пользователи с ролью: {{ $role->name }}</h1>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} ({{ $user->email }})</li>
        @endforeach
    </ul>
</x-layouts.app>
