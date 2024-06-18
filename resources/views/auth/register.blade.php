<x-layout>
    <x-slot:heading>
        Sign Up
    </x-slot:heading>
    <div class="can-content">
        <div class="can-content-inner">
            <div class="can-breadcrumbs">
                <span>Главная</span>
                <a href="/" class="can-button">На главную</a>
            </div>
            <div class="can-category">
                <div class="can-category_sidebar">
                    <div class="can-section_title">
                        <h4>Регистрация</h4>
                    </div>
                    <div class="can-d-catalog_categories-personal">
                        <a href="/dashboard" class="can-d-catalog_link">
                            <div class="icon">
                                <i class="fa-solid fa-circle-user"></i>
                                <span>Персональный раздел</span>
                            </div>
                        </a>
                        <a href="/orders/history" class="can-d-catalog_link">
                            <div class="icon">
                                <i class="fa-solid fa-store"></i>
                                <span>Текущие заказы</span>
                            </div>
                        </a>
                        <a href="/user/private" class="can-d-catalog_link">
                            <div class="icon">
                                <i class="fa-solid fa-circle-user"></i>
                                <span>Личные данные</span>
                            </div>
                        </a>
                        <a href="/orders/history" class="can-d-catalog_link">
                            <div class="icon">
                                <i class="fa-solid fa-clock"></i>
                                <span>История заказов</span>
                            </div>
                        </a>
                        <a href="/cart" class="can-d-catalog_link">
                            <div class="icon">
                                <i class="fa-solid fa-cart-shopping"></i>
                                <span>Корзина</span>
                            </div>
                        </a>
                        <a href="/favorites/index" class="can-d-catalog_link">
                            <div class="icon">
                                <i class="fa-regular fa-heart"></i>
                                <span>Избранное</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="can-category_content-profile">
                    <div class="profile-page">
                        <div class="profile-set-data">
                            <div class="can-section_title">
                                <h4>Пожалуйста, авторизуйтесь</h4>
                            </div>
                            <div class="profile-set-data-form profile-set-data-form_auth">
                                <form action="/register" method="POST">
                                    @csrf
                                    <div class="social-auth">
                                        <div class="profile-set-data-form_input">
                                            <input class="can-text-input" type="text" id="first_name" name="first_name" placeholder="Имя:" required value="{{old('first_name')}}" >
                                            <x-form-error name="first_name"/>
                                        </div>
                                        <div class="profile-set-data-form_input">
                                            <input class="can-text-input" type="text"  id="last_name" name="last_name" placeholder="Фамилия:" required value="{{old('last_name')}}">
                                            <x-form-error name="last_name"/>
                                        </div>
                                        <div class="profile-set-data-form_input">
                                            <input class="can-text-input" type="email" id="email" name="email" placeholder="Email:" required value="{{old('email')}}">
                                            <x-form-error name="email"/>
                                        </div>
                                        <div class="profile-set-data-form_input">
                                            <input class="can-text-input" type="password" id="password" name="password" placeholder="Пароль:" required >
                                            <x-form-error name="password"/>
                                        </div>
                                        <div class="profile-set-data-form_input">
                                            <input class="can-text-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Подтвердите пароль:" required>
                                            <x-form-error name="password_confirmation"/>
                                        </div>
                                        <div class="profile-set-data-form_input">
                                            <div class="can-checkbox">
                                                <input type="checkbox" id="user_remember" name="user_remember">
                                                <label for="user_remember">
                                                    Запомнить меня
                                                </label>
                                            </div>
                                        </div>
                                        <div class="profile-set-data-form_confirm">
                                            <button class="can-button" type="submit" value="Войти">Войти</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-layout>