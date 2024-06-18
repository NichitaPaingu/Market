<div class="can-content">
<div class="can-content-inner">
    <div class="can-breadcrumbs">
        <span><a href="/" class="can-button">На главную</a></span>
        <span id="name">{{$user->first_name}} {{$user->last_name}}</span>
        <form action="/logout" method="POST">
        @csrf
        <div class="profile-set-data-form_confirm">
            <button class="can-button" type="submit" value="Выйти" id="logoutButton">Выйти</button>
        </div>
        </form>
    </div>
    <div class="can-category">
        <div class="can-category_sidebar">
            <div class="can-d-catalog_categories-personal">
                <div class="can-section_title_link">
                    <h3>Личный кабинет</h3>
                </div>
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
                    <div class="can-section">
                        <div class="can-personal">
                            <div class="can_personal_col">
                                <a href="/dashboard">
                                    <div class="can_personal_item">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <span>Персональный раздел</span>
                                    </div>
                                </a>
                            </div>
                            <div class="can_personal_col">
                                <a href="/orders/history">
                                    <div class="can_personal_item">
                                        <i class="fa-solid fa-store"></i>
                                        <span>Текущие заказы</span>
                                    </div>
                                </a>
                            </div>
                            <div class="can_personal_col">
                                <a href="/user/private">
                                    <div class="can_personal_item">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <span>Личные данные</span>
                                    </div>
                                </a>
                            </div>
                            <div class="can_personal_col">
                                <a href="/orders/history">
                                    <div class="can_personal_item">
                                        <i class="fa-solid fa-clock"></i>
                                        <span>История заказов</span>
                                    </div>
                                </a>
                            </div>
                            <div class="can_personal_col">
                                <a href="/cart">
                                    <div class="can_personal_item">
                                        <i class="fa-solid fa-cart-shopping"></i>
                                        <span>Корзина</span>
                                    </div>
                                </a>
                            </div>
                            <div class="can_personal_col">
                                <a href="/favorites/index">
                                    <div class="can_personal_item">
                                        <i class="fa-regular fa-heart"></i>
                                        <span>Избранное</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>
