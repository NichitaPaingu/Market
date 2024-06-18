<div class="can-content">
    <div class="can-content-inner">
        <div class="can-breadcrumbs">
            <span><a href="/" class="can-button">На главную</a></span>
            <span id="name">{{ $user->first_name }} {{ $user->last_name }}</span>
            <span><form action="/logout" method="POST">
                @csrf
                <div class="profile-set-data-form_confirm">
                    <button class="can-button" type="submit" value="Выйти" id="logoutButton">Выйти</button>
                </div>
            </form></span>
        </div>
        <div class="can-category">
            <div class="can-category_sidebar">
                <div class="can-d-catalog_categories-personal">
                    <div class="can-section_title_link">
                        <h3>Личный кабинет</h3>
                    </div>
                    <a href="/categories/index" class="can-d-catalog_link">
                        <div class="icon">
                            <i class="fa-solid fa-circle-user"></i>
                            <span>Управление категориями</span>
                        </div>
                    </a>
                    <a href="/products/index" class="can-d-catalog_link">
                        <div class="icon">
                            <i class="fa-solid fa-store"></i>
                            <span>Управление продуктами</span>
                        </div>
                    </a>
                    <a href="/orders/history" class="can-d-catalog_link">
                        <div class="icon">
                            <i class="fa-solid fa-clock"></i>
                            <span>История заказов</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="can-category_content-profile">
                <div class="profile-page">
                    <div class="can-section">
                        <div class="can-personal">
                            <div class="can_personal_col">
                                <a href="/categories/index">
                                    <div class="can_personal_item">
                                        <i class="fa-solid fa-circle-user"></i>
                                        <span>Управление категориями</span>
                                    </div>
                                </a>
                            </div>
                            <div class="can_personal_col">
                                <a href="/products/index">
                                    <div class="can_personal_item">
                                        <i class="fa-solid fa-store"></i>
                                        <span>Управление продуктами</span>
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
                        </div>
                    </div>                            
                </div>
            </div>
        </div>
    </div>
</div>

