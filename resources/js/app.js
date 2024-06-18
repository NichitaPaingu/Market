import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
document.addEventListener('DOMContentLoaded', function() {
    
    // Показ содержимого по наведению на ссылки{{Burger-menu}}
    const links = document.querySelectorAll('.can_d_catalog_link');
    const contentBlocks = document.querySelectorAll('.can-d-catalog_layer');

    function hideAllContent() {
        contentBlocks.forEach(block => {
            block.style.display = 'none';
        });
    }

    hideAllContent();
    links.forEach((link, index) => {
        link.addEventListener('mouseover', () => {
            hideAllContent();
            contentBlocks[index].style.display = 'block';
        });
    });

    // Показ бургер-меню
    var burgerButton = document.querySelector('.can-catalog-button');
    var burgerMenu = document.querySelector('.can-header-catalog_links-burger-menu');
    var burgerIcon = burgerButton.querySelector('.burger-menu');
    burgerButton.addEventListener('click', function() {
        burgerMenu.classList.toggle('active');
        burgerIcon.classList.toggle('open');
        contentBlocks[0].style.display='block';
    });




    // Модальное окно выбора города {{CityHeader}}
    document.getElementById('city-button').addEventListener('click', function(){
        document.getElementById('city-modal').style.display = 'block';
    });

    document.querySelector('.close').addEventListener('click', function(){
        document.getElementById('city-modal').style.display = 'none';
    });

    // Сохранение выбранного города
    var cityContainer = document.getElementById('city-select');
    cityContainer.querySelectorAll('span').forEach(function(span) {
        span.addEventListener('click', function() {
            document.getElementById('city-button').textContent = this.textContent;
            document.getElementById('city-modal').style.display = 'none';
        });
    });




    //Добавление поля для фотографии продукта
    function addImage() {
        const container = document.getElementById('images-container');
        const newImage = document.createElement('div');
        newImage.className = 'image-group';
        newImage.innerHTML = `
            <input type="file" name="images[]" class="can-form-input" required>
            <button type="button" class="can-button can-button-red margin-10" onclick="removeImage(this)">Remove</button>
        `;
        container.appendChild(newImage);
    }

    // Удалить поле для фотографии
    function removeImage(button) {
        const imageGroup = button.parentElement;
        imageGroup.remove();
    }
    

    // Использование методов в глобальном доступе
    window.addImage = addImage;
    window.removeImage = removeImage;

});

//category create {{добавление поля для типа категории товара}}
window.addCategoryType = function() {
    const container = document.getElementById('category-types-container');
    const newCategoryType = document.createElement('div');
    newCategoryType.className = 'category-type-group';
    newCategoryType.innerHTML = `
        <input type="text" name="category_types[]" class="can-form-input" placeholder="Category Type">
        <button type="button" class="can-button can-button-red" onclick="removeCategoryType(this)">Remove</button>
    `;
    container.appendChild(newCategoryType);
}
//Удаление поля для типа категории товара
window.removeCategoryType = function(button) {
    const categoryTypeGroup = button.parentElement;
    categoryTypeGroup.remove();
}

//Первая карусель
$(document).ready(function(){
    $('.can-products_carousel').slick({
        infinite: true,
        slidesToScroll: 1,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
        // Обработчики событий для кнопок
    $('#product-prev').on('click', function() {
        $('.can-products_carousel').slick('slickPrev');
    });
    $('#product-next').on('click', function() {
        $('.can-products_carousel').slick('slickNext');
    });
    
});


//Карусель 2
$(document).ready(function(){
    $('.can-products_carousel2').slick({
        infinite: true,
        slidesToScroll: 1,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $('#category-prev').on('click', function() {
        $('.can-products_carousel2').slick('slickPrev');
    });
    $('#category-next').on('click', function() {
        $('.can-products_carousel2').slick('slickNext');
    });
});




//Вы смотрели 
//Здесь мы добавляем просмотренный товар в local storage
document.addEventListener("DOMContentLoaded", function() {
    if (!localStorage.getItem('sessionInitialized')) {
        localStorage.removeItem('seenProducts');
        localStorage.setItem('sessionInitialized', true);
    }
    
    displaySeenProducts();
});
    
//очищает все айтемы из storage 
function clearSeenProducts() {
    localStorage.removeItem('seenProducts');
}

// Эти функции можно привязать к событиям входа и выхода пользователя
//При входе и выходе очистка Local storage
document.getElementById('logoutButton').addEventListener('click', clearSeenProducts);
document.getElementById('loginButton').addEventListener('click', clearSeenProducts);


//Получение данных всех просмотренных товаров
function getSeenProducts() {
    return JSON.parse(localStorage.getItem('seenProducts')) || [];
}
    
    //Метод для отображения всех просмотренных товаров
function displaySeenProducts() {
    const seenProducts = getSeenProducts();
    const seenProductsContainer = document.getElementById('seen-products-container');

    seenProductsContainer.innerHTML = ''; // Очистка контейнера

    seenProducts.forEach(product => {
        let priceHtml;

        if (product.discounted_price == product.price) {
            priceHtml = `<span class="old_simple">${product.price} лей</span>`;
        } else {
            priceHtml = `<span class="current">${product.discounted_price} лей</span>
                            <span class="old">${product.price} лей</span>`;
        }
        
        const productHtml = `
        <a href="/products/${product.id}">
            <div class="can-product-card-home">
                <img src="${product.image}" alt="${product.name}" class="can-product-image-home">
                <div class="can-product-details">
                    <h2 class="can-product-title">${product.name}</h2>
                    <div class="can-product-card_price-deals">
                    ${priceHtml}
                    </div>
                </div>
            </div>
        </a>
        `;
        seenProductsContainer.insertAdjacentHTML('beforeend', productHtml);
    });

    // Инициализация карусели снова после добавления новых элементов
    if (seenProducts.length > 0) {
        $('.products_carousel_three').slick({
            infinite: true,
            slidesToShow: seenProducts.length >= 4 ? 4 : seenProducts.length,
            slidesToScroll: 1,
            variableWidth: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: seenProducts.length >= 3 ? 3 : seenProducts.length,
                        slidesToScroll: 1,
                        centerMode: false, // Включение centerMode для этого breakpoint
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: seenProducts.length >= 2 ? 2 : seenProducts.length,
                        slidesToScroll: 1,
                        centerMode: false, // Включение centerMode для этого breakpoint
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        centerMode: false,
                    }
                }
            ]
        });

        $('#seen-prev').on('click', function() {
            $('.products_carousel_three').slick('slickPrev');
        });
        $('#seen-next').on('click', function() {
            $('.products_carousel_three').slick('slickNext');
        });
    }
}

    
    