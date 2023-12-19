@foreach($foods as $food)
    @if(!$food->products->isEmpty())
        <div class="food-wrap">
            <div class="food-head">
                <h2>{{ $food->__('title') }}</h2>
                <div class="food-line"></div>
            </div>
            <div class="food-list">
                @foreach($food->products as $product)
                <div class="food-item">
                    <div class="food-item__img">
                        <img src="{{ $product->getImage() }}" alt="{{ $product->title_ru }}">
                    </div>
                    <div class="food-item__text">
                        <h3>{!! $product->__('title') !!}</h3>
                        <p>{!! $product->__('describe') !!}</p>
                        <div class="food-item__price">
                            {{ $product->price }} ₽ <span>@if($product->weight)/ {{ $product->weight }} г @endif</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    @endif
@endforeach
