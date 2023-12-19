@foreach($foods as $food)
    @if(!$food->products->isEmpty())
        <div class="food-wrap">
            <div class="food-head beverage-head">
                <h2>{{ $food->__('title') }}</h2>
                <div class="food-line"></div>
            </div>
            <div class="food-list">
                @foreach($food->products as $product)
                    <div class="food-item beverage-item">
                        <div class="food-item__text">
                            <div class="beverage-item__head">
                                <h3>{!! $product->__('title') !!}</h3>
                                <div class="food-item__price">
                                    <span>@if($product->weight) {{ $product->weight }} мл. @endif</span> / {{ $product->price }} ₽
                                </div>
                            </div>
                            <p>{!! $product->__('describe') !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    @endif
@endforeach
