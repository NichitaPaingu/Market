<x-layout>
    <x-slot:heading>
        Редактировать профиль
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-head-products">
                <h1>Редактировать профиль</h1>
                <a href="/user/private">Вернуться</a>
            </div>
            <form action="{{ route('user.private.update') }}" method="POST" class="can-form">
                @csrf
                @method('PATCH')
                <div class="can-form-group">
                    <label for="first_name">Имя:</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required class="can-form-input">
                    <x-form-error name="first_name"/>
                </div>
                <div class="can-form-group">
                    <label for="last_name">Фамилия:</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required class="can-form-input">
                    <x-form-error name="last_name"/>
                </div>
                <div class="can-form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="can-form-input">
                    <x-form-error name="email"/>
                </div>
                <div class="can-form-group">
                    <label for="old_password">Старый пароль:</label>
                    <input type="password" id="old_password" name="old_password" class="can-form-input">
                    <x-form-error name="old_password"/>
                </div>
                <div class="can-form-group">
                    <label for="password">Новый пароль (оставьте пустым, если не хотите менять):</label>
                    <input type="password" id="password" name="password" class="can-form-input">
                    <x-form-error name="password"/>
                </div>
                <div class="can-form-group">
                    <label for="password_confirmation">Подтверждение нового пароля:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="can-form-input">
                    <x-form-error name="password_confirmation"/>
                </div>
                <div class="can-form-group">
                    <button type="submit" class="can-button">Обновить</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
