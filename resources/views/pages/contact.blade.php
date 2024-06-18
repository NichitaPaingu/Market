<x-layout>
    <x-slot:heading>
        Контакты
    </x-slot:heading>
    <x-succes message="{{session('succes')}}"></x-succes>
    <div class="contact-page">
        <div class="contact-info">
            <h2>Свяжитесь с нами</h2>
            <p><strong>Телефон:</strong>+373 68 99 99 99</p>
            <p><strong>Email:</strong> cantare@gmail.com</p>
            <p><strong>Часы работы:</strong> Пн-Пт с 9:00 до 21:00, Сб-Вс с 10:00 до 18:00</p>
            <div class="social-media">
                <a href="#"><i class="fab fa-vk"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-telegram"></i></a>
            </div>
        </div>
        <div class="contact-form">
            <h2>Обратная связь</h2>
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Имя:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Сообщение:</label>
                    <textarea type="text" id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="submit-button">Отправить</button>
            </form>
        </div>
        <div class="contact-map">
            <h2>Наше местоположение</h2>
            <div id="map"></div>
        </div>
    </div>
</x-layout>

<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
<script>
function initMap() {
    const location = { lat: 47.0105, lng: 28.8638 }; // Координаты Кишинева
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: location
    });
    const marker = new google.maps.Marker({
        position: location,
        map: map
    });
}

window.initMap = initMap;
</script>
