@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Просмотр заказа</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="d-flex" style="justify-content: space-between;border-bottom: 1px solid rgba(0,0,0,.125);padding: .75rem 1.25rem;border-top-left-radius: .25rem;border-top-right-radius: .25rem;">
                            <h3 class="card-title">Заказ от «{{ $order->name }}»</h3>
                            <h3 class="card-title">{{ $order->created_at}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-header border-0">
                            <h3 class="card-title">Данные</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Email</th>
                                    <th>Телефон</th>
                                    <th>Дата</th>
                                    <th>Время</th>
                                    <th>Метод</th>
                                    <th>Скидка</th>
                                    <th>Доставка</th>
                                    <th>Приборы</th>
                                    <th>Оплата</th>
                                    <th>Итого</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->date }}</td>
                                        <td>@if($order->time) {{ $order->time }} @else Как можно скорее @endif</td>
                                        <td>@if($order->method == 0) Доставка @else Самовывоз @endif</td>
                                        <td>@if($order->method == 0) Нет @else {{ $order->discount}} ₽ @endif</td>
                                        <td>@if($order->method == 0) {{ $order->delivery}} ₽ @else Нет @endif</td>
                                        <td>@if($order->devices == 0) Да @else Нет @endif</td>
                                        <td>@if($order->payment_method == 0) Ресторан @elseif($order->payment_method == 1) Картой @else «Apple-Google-Sber | Pay» @endif</td>
                                        <td>{{ $order->total }} ₽</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="card-header border-0">
                            <h3 class="card-title">Товары</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>ID - товара</th>
                                    <th>Товар</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th style="text-align: right">Сумма</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->product as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>
                                        <td>
                                            <img src="{{ asset($product->getImage()) }}" alt="{{ $product->title_ru }}" class="img-size-32 mr-2">
                                            {{ $product->title_ru }}
                                        </td>
                                        <td>{{ $product->price }} ₽</td>
                                        <td>
                                            {{ $product->pivot->quantity }}
                                        </td>
                                        <td style="text-align: right" class="sum">
                                            <span>{{ $product->price *  $product->pivot->quantity}}</span> ₽
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <table class="table table-striped table-valign-middle">
                                <tr>
                                    <td style="font-weight: 700;font-size: 18px">Итого:</td>
                                    <td style="font-weight: 700;font-size: 18px;text-align: right" class="all-price"><span></span> ₽</td>
                                </tr>
                            </table>
                        </div>
                        @if($street)
                        <hr>
                        <div class="card-header border-0">
                            <h3 class="card-title">Адрес</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Город</th>
                                    <th>Улица</th>
                                    <th>Дом</th>
                                    <th>Квартира</th>
                                    <th>Подъезд</th>
                                    <th>Домофон</th>
                                    <th>Этаж</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $street->city }}</td>
                                        <td>{{ $street->street }}</td>
                                        <td>{{ $street->house }}</td>
                                        <td>{{ $street->flat }}</td>
                                        <td>{{ $street->entrance }}</td>
                                        <td>{{ $street->intercom }}</td>
                                        <td>{{ $street->floor }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <hr>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th>Пожелания</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $order->wishes }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('scripts')
    <script>
        var product = $('.sum span');
        var sum = null;

        product.each(function( index ) {
            sum += parseInt($(this).text());
        });

        $('.all-price span').html(sum);
    </script>
@endpush
