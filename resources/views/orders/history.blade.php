<x-layout>
    <x-slot:heading>
        История заказов
    </x-slot:heading>
    <div class="can-orders-history-content">
        <div class="can-orders-history-content-inner">
            <div class="can-head-products">
                <a href="/dashboard" class="can-button">Личный кабинет</a>
                <h1>История Заказов</h1>
                <h2>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
            </div>   
            @if($orders->count() > 0)
                <div class="can-orders-list">
                    @foreach ($orders as $order)
                        <div class="can-order">
                            <div class="can-head-products">
                                <h2>Заказ №{{ $order->id }}</h2>
                                <a href="/order/{{$order->id}}" class="can-button">Посмотреть</a>
                            </div>
                            @if(Auth::user()->is_admin)
                                <p>Клиент: {{ $order->user->first_name }} {{ $order->user->last_name }} ({{ $order->user->email }})</p>
                            @endif
                            <p>Дата: {{ $order->created_at }}</p>
                            <p>Статус: {{ $order->status }}</p>
                            <div class="can-order-items">
                                @foreach ($order->items as $item)
                                    <div class="can-order-item">
                                        <p>{{ $item->product->name }}</p>
                                        <p>Количество: {{ $item->quantity }}</p>
                                        <p>Цена: {{ number_format($item->price, 0, '') }} лей</p>
                                    </div>
                                @endforeach
                            </div>
                            <p>Общая стоимость: {{ number_format($order->total_price, 0, '', ' ') }} лей</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Нет заказов для отображения.</p>
            @endif
        </div>
    </div>
</x-layout>