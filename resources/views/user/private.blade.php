<x-layout>
    <x-slot:heading>
        Личные данные
    </x-slot:heading>
    <x-succes message="{{session('succes')}}"></x-succes>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                <a href="/dashboard" class="can-button">Личный кабинет</a>
                <h1>Личные данные</h1>
                <a href="{{ route('user.private.edit') }}" class="can-button">Редактировать</a>
            </div>
            @if(session('success'))
                <p class="can-alert-success">{{ session('success') }}</p>
            @endif
            <div class="can-user-info">
                <p><strong>Имя:</strong> {{ $user->first_name }}</p>
                <p><strong>Фамилия:</strong> {{ $user->last_name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>
    </div>
</x-layout>