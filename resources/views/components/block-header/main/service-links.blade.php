<div class="can-header-main_service-links">
    <div class="can-header-main_service-links-width960">
        <a href="/favorites/index"><i class="fa-regular fa-heart">Избранное</i> </a>
        @guest
            <a href="/register"><i class="fa-regular fa-user">Регистрация</i></a>
            <a href="/login"><i class="fa-solid fa-user">Вход</i></a>
        @endguest
        @auth
            <a href="/dashboard"><i class="fa-solid fa-user">Личный Кабинет</i></a>
        @endauth
        <a href="/cart"><i class="fa-solid fa-cart-shopping">Корзина</i></a>
    </div>
</div>