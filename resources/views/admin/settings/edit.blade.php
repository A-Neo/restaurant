@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Настройки и информация о ресторане</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.settings.update', ['setting' => $setting->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Настройки и информация о ресторане</h3>
                            </div>
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Русский</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">English</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="time_ru">Время работы (русский)</label>
                                                    <input type="text" name="time_ru"
                                                           class="form-control @error('time_ru') is-invalid @enderror" id="time_ru"
                                                           value="{{ $setting->time_ru }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="delivery_ru">Работа доставки (русский)</label>
                                                    <input type="text" name="delivery_ru"
                                                           class="form-control @error('delivery_ru') is-invalid @enderror" id="delivery_ru"
                                                           value="{{ $setting->delivery_ru }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="street_ru">Адрес (русский)</label>
                                                    <input type="text" name="street_ru"
                                                           class="form-control @error('street_ru') is-invalid @enderror" id="street_ru"
                                                           value="{{ $setting->street_ru }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="time_en">Время работы (английский)</label>
                                                    <input type="text" name="time_en"
                                                           class="form-control @error('time_en') is-invalid @enderror" id="time_en"
                                                           value="{{  $setting->time_en }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="delivery_en">Работа доставки (английский)</label>
                                                    <input type="text" name="delivery_en"
                                                           class="form-control @error('delivery_en') is-invalid @enderror" id="delivery_en"
                                                           value="{{ $setting->delivery_en }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="street_en">Адрес (английский)</label>
                                                    <input type="text" name="street_en"
                                                           class="form-control @error('street_en') is-invalid @enderror" id="street_en"
                                                           value="{{ $setting->street_en }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="phone">Номер телефона</label>
                                            <input type="text" name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                   value="{{ $setting->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="mail">E-mail</label>
                                            <input type="text" name="mail"
                                                   class="form-control @error('mail') is-invalid @enderror" id="mail"
                                                   value="{{ $setting->mail }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="mail_two">E-mail для писем</label>
                                            <input type="text" name="mail_two"
                                                   class="form-control @error('mail_two') is-invalid @enderror" id="mail_two"
                                                   value="{{ $setting->mail_two }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="logo">Логотип</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="logo" type="file" class="custom-file-input" id="logo">
                                            <label class="custom-file-label" for="logo">Изменить логотип</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    @if($setting->logo)
                                        <p class="mb-0">
                                            <img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$setting->logo"))) }}" alt="Логотип">
                                            <span>{{ str_replace('\\', '/', asset(trim("uploads/$setting->logo"))) }}</span>
                                        </p>
                                    @else
                                        <p class="mb-0">Изображение не заполнено</p>
                                    @endif
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="logo_b">Логотип (темная версия)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="logo_b" type="file" class="custom-file-input" id="logo_b">
                                            <label class="custom-file-label" for="logo_b">Изменить логотип</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    @if($setting->logo_b)
                                        <p class="mb-0">
                                            <img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$setting->logo_b"))) }}" alt="Логотип">
                                            <span>{{ str_replace('\\', '/', asset(trim("uploads/$setting->logo_b"))) }}</span>
                                        </p>
                                    @else
                                        <p class="mb-0">Изображение не заполнено</p>
                                    @endif
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="overlay">Затемнение фона (от 0.1 до 0.9)</label>
                                    <input type="text" name="overlay"
                                           class="form-control @error('overlay') is-invalid @enderror" id="overlay"
                                           value="{{ $setting->overlay }}">
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="facebook_link">Ссылка на Telegram</label>
                                            <input type="text" name="facebook_link"
                                                   class="form-control @error('facebook_link') is-invalid @enderror" id="facebook_link"
                                                   value="{{ $setting->facebook_link }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="instagram_link">Ссылка на VK</label>
                                            <input type="text" name="instagram_link"
                                                   class="form-control @error('instagram_link') is-invalid @enderror" id="instagram_link"
                                                   value="{{ $setting->instagram_link }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="tiktok_link">Ссылка на TikTok</label>
                                            <input type="text" name="tiktok_link"
                                                   class="form-control @error('tiktok_link') is-invalid @enderror" id="tiktok_link"
                                                   value="{{ $setting->tiktok_link }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="table_reservation">Форма - Бронь стола - <small>максимальное количество человек</small></label>
                                            <input type="number" name="table_reservation"
                                                   class="form-control @error('max_human') is-invalid @enderror" id="table_reservation"
                                                   value="{{ $reservation->max_human }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="banquet">Форма - Бронь банкета - <small>максимальное количество человек</small></label>
                                            <input type="number" name="banquet"
                                                   class="form-control @error('banquet') is-invalid @enderror" id="banquet"
                                                   value="{{ $banquet->max_human }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="category_id">Выборка на главной</label>
                                            <select name="category_id" id="category_id" class="form-control" data-placeholder="Выберите категорию" style="width: 100%;">
                                                    @foreach($categories as $k => $v)
                                                        <option value="{{ $v->id }}"
                                                                @if($random->category_id == $v->id)
                                                                selected
                                                            @endif
                                                        >{{ $v->title_ru }}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="discount">Скидка при самовывозе <small>(в процентах)</small></label>
                                            <input type="text" name="discount"
                                                   class="form-control @error('discount') is-invalid @enderror" id="discount"
                                                   value="{{ $discount->discount }}">
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="en_on">Английская версия</label>
                                            <select name="en_on" id="en_on" class="form-control" data-placeholder="Вкл/Выкл" style="width: 100%;">
                                                    <option value="0" @if($setting->en_on == 0) selected @endif >Выключить</option>
                                                    <option value="1" @if($setting->en_on == 1) selected @endif >Включить</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="max_distance">Максимальное расстояние доставки</label>
                                            <input type="text" name="max_distance"
                                                   class="form-control @error('max_distance') is-invalid @enderror" id="discount"
                                                   value="{{ $setting->max_distance }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                            <!-- /.card -->
                    </div>
                    </form>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@push('style')
@endpush

@push('scripts')
@endpush
