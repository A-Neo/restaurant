<form action="{{ route('callback', ['id' => $id]) }}" method="POST" class="form-black" data-id="{{ $id }}">
    @csrf
    <div style="display:none;"><input type="text" name="honeypot" id="honeypot" value="" /></div>

    <div class="form-group">
        <input name="name" type="text" placeholder="@lang('form.name')" required="required" minlength="2">
        <input type="tel" id="phone" name="phone"
               placeholder="@lang('form.phone')" required="required" minlength="11">
    </div>
    @if($id == 3)
        <div class="form-group">
            <input name="email" type="email" placeholder="@lang('form.email')" required="required" minlength="8">
            <input type="text" id="theme" name="theme" placeholder="@lang('form.theme')" required="required" minlength="2">
        </div>
        <div class="form-group form-group-width">
            <input name="message" type="text" placeholder="@lang('form.message')" required="required" minlength="10">
        </div>
    @else

        <div class="form-group">
            <input name="email" type="email" placeholder="@lang('form.email')" required="required" minlength="8">
			<!-- глюк с выбором кол-ва персон, скрыт в ожидании прогера
            
			-->
			<select name="qnt" id="form-black-qnt">
                <option value="0">@lang('form.guests_number')</option>
                @for ($i = 1; $i < $form->max_human + 1; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
        <select name="date" id="form-black-date">
            <option value="0">@lang('form.date')</option>
            @foreach($dates as $date)
                <option value="{{ $date->format('d-m-Y') }}">{{ $date->format('d-m-Y') }}</option>
            @endforeach
        </select>
        <select name="time" id="form-black-time">
            <option value="0">@lang('form.time')</option>
            @for ($i = 11; $i <= 23; $i++)
                @if($i > 11 && $i < 23)
                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                    <option value="{{ $i }}:30">{{ $i }}:30</option>
                @elseif($i == 24)
                    <option value="{{ $i }}:00">{{ $i }}:00</option>
                @elseif($i == 11)
                    <option value="{{ $i }}:30">{{ $i }}:30</option>
                @endif
            @endfor
        </select>

    </div>
    @endif
    <div id="form-message"></div>
    <div class="form-btn">
        <p>@lang('form.politic')</p>
            @if($type == 1)
        <button type="submit" onclick="ym(93100421,'reachGoal','booking'); return true;">@lang('form.reserve')
            @elseif($type == 2)
        <button type="submit" onclick="ym(93100421,'reachGoal','banquet'); return true;">@lang('form.reserve_banquet')
            @elseif($type == 3)
        <button type="submit" onclick="ym(93100421,'reachGoal','contact'); return true;">@lang('form.contact_btn')
            @endif
        </button>
    </div>
    <div class="form-data">
        <span>{{ $setting->__('time') }}</span>
        <span>{{ $setting->__('street') }}</span>
    </div>
</form>
