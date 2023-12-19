<select name="street" id="order-street-one" class="select-order-change">
    <option value="0" selected disabled>Добавьте адрес</option>
    @if($user && count($user->addresses) > 0)
        @foreach($user->addresses as $k => $v)
        <option value="{{ $v->id }}" data-id="{{ $v->id }}" data-coor="{{ $v->coordinates }}" data-delivery="{{ $v->delivery_zone_id }}">{{ $v->address_line }}</option>
        @endforeach
    @endif
</select>
