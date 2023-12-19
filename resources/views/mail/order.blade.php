<h1>Расторан «ДЭДИ»</h1>
<p>Номер заказа {{ $order->id }}</p>
<br>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse;max-width:600px">
    <thead>
        <tr>
            <td style="border-bottom-color:#333333;border-bottom-style:solid;border-bottom-width:1px;padding:5px 10px 5px 10px;text-align:left">#</td>
            <td style="border-bottom-color:#333333;border-bottom-style:solid;border-bottom-width:1px;padding:5px 10px 5px 10px;text-align:left">Image</td>
            <td style="border-bottom-color:#333333;border-bottom-style:solid;border-bottom-width:1px;padding:5px 10px 5px 10px;text-align:left">Name</td>
            <td style="border-bottom-color:#333333;border-bottom-style:solid;border-bottom-width:1px;padding:5px 10px 5px 10px;text-align:left">Price</td>
            <td style="border-bottom-color:#333333;border-bottom-style:solid;border-bottom-width:1px;padding:5px 10px 5px 10px;text-align:left">Qnt</td>
            <td style="border-bottom-color:#333333;border-bottom-style:solid;border-bottom-width:1px;padding:5px 10px 5px 10px;text-align:left">Amount</td>
        </tr>
    </thead>
    <tbody>
    @foreach($order->product as $k => $v)
        <tr valign="middle">
            <td style="border-bottom-color:#dddddd;border-bottom-style:solid;border-bottom-width:1px;padding:15px 10px 15px 10px;text-align:left"><b>{{ $k+1 }}</b></td>
            <td style="border-bottom-color:#dddddd;border-bottom-style:solid;border-bottom-width:1px;padding:15px 10px 15px 10px;text-align:left"><img src="{{ $v->getImage() }}" alt="{{ $v->title_ru }}" style="width: 40px;"></td>
            <td style="border-bottom-color:#dddddd;border-bottom-style:solid;border-bottom-width:1px;padding:15px 10px 15px 10px;text-align:left"><b>{{ $v->title_ru }}</b></td>
            <td style="border-bottom-color:#dddddd;border-bottom-style:solid;border-bottom-width:1px;padding:15px 10px 15px 10px;text-align:left"><b>{{ $v->price }}</b></td>
            <td style="border-bottom-color:#dddddd;border-bottom-style:solid;border-bottom-width:1px;padding:15px 10px 15px 10px;text-align:left"><b>{{ $v->pivot->quantity }}</b></td>
            <td style="border-bottom-color:#dddddd;border-bottom-style:solid;border-bottom-width:1px;padding:15px 10px 15px 10px;text-align:left"><b>{{ $v->price *  $v->pivot->quantity}}</b></td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Приборы: @if($order->devices == 0) Нужны @else Не нужны @endif</p>
<br>
@if($order->delivery)
<p><b> @if($order->method == 0) Способ заказа: Доставка @else Способ заказа: Самовывоз @endif</b></p>
@endif
@if($order->delivery)
<p><b> @if($order->method == 0) Стоимость доставки: {{ $order->delivery }} ₽ @else Скидка: {{ $order->delivery }} % @endif</b></p>
@endif
<p><b>Итого: {{ $order->total }} ₽</b></p>
<br>
<strong>Payment information:</strong>
<p>Имя: {{ $order->name }}</p>
<p>Телефон: {{ $order->phone }}</p>
<p>Почта: {{ $order->email }}</p>
<p>Дата: {{ $order->date }}</p>
<p>Время: @if($order->time == 0) Как можно скорее @else {{ $order->time }} @endif</p>
<p>Способ оплаты: @if($order->payment_method == 0) Наличными @elseif($order->payment_method == 1) Картой @endif</p>
<p>Пожелания к заказу: @if($order->wishes) {{ $order->wishes }} @else Нет @endif</p>
@if($street)
    <p>Адрес: {{ $street->city }}, {{ $street->street }}, {{ $street->house }}</p>
    @if($street->flat)
        <p>Квартира: {{ $street->flat }}</p>
    @endif
    @if($street->entrance)
        <p>Подъезд: {{ $street->entrance }}</p>
    @endif
    @if($street->floor)
        <p>Этаж: {{ $street->floor }}</p>
    @endif
    @if( $street->intercom)
        <p>Домофон: {{ $street->intercom }}</p>
    @endif
@endif

