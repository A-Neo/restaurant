@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование блока - Программа лояльности</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.additions.update', ['addition' => $addition->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Программа лояльности на главной странице</h3>
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
                                        <div class="form-group">
                                            <label for="title_ru">Заголовок на главной (русский)</label>
                                            <input type="text" name="title_ru"
                                                   class="form-control @error('title_ru') is-invalid @enderror" id="title_ru"
                                                   value="{{ $addition->title_ru }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_ru">Описание на главной (русский)</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="5" id="description_ru">{{ $addition->description_ru }}</textarea>
                                        </div>
                                        <div class="index" style="visibility: hidden;"></div>
                                        <div class="index" id="group_btn_ru">
                                            <div class="form-group">
                                                <label for="btn_ru">Текст кнопки на главной (русский)</label>
                                                <input type="text" name="btn_ru"
                                                       class="form-control @error('btn_ru') is-invalid @enderror" id="btn_ru"
                                                       value="{{ $addition->btn_ru }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group">
                                            <label for="title_en">Заголовок на главной (английский)</label>
                                            <input type="text" name="title_en"
                                                   class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                   value="{{ $addition->title_en }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Описание на главной (английский)</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="5" id="description_en">{{ $addition->description_en }}</textarea>
                                        </div>
                                        <div class="form-group" id="group_btn_en">
                                            <label for="btn_en">Текст кнопки на главной (английский)</label>
                                            <input type="text" name="btn_en"
                                                   class="form-control @error('btn_en') is-invalid @enderror" id="btn_en"
                                                   value="{{ $addition->btn_en }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="index">
                                    <div class="form-group" id="group_apple">
                                        <label for="apple_link">Ссылка в кнопке</label>
                                        <input type="text" name="apple_link"
                                               class="form-control @error('apple_link') is-invalid @enderror" id="apple_link"
                                               value="{{ $addition->apple_link }}">
                                    </div>
                                    <div class="form-group" id="group_google">
                                        <label for="google_link">Текст кнопки</label>
                                        <input type="text" name="google_link"
                                               class="form-control @error('google_link') is-invalid @enderror" id="google_link"
                                               value="{{ $addition->google_link }}">
                                    </div>
                                </div>
                                <div class="form-group" id="group_btn_link">
                                    <label for="btn_link">Кнопка (ссылка)</label>
                                    <input type="text" name="btn_link"
                                           class="form-control @error('btn_link') is-invalid @enderror" id="btn_link"
                                           value="{{ $addition->btn_link }}" placeholder="https://dedi.ru">
                                </div>
                                <div class="form-group">
                                    <label for="image">Изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Изменить изображение</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    @if($addition->image)
                                        <p class="mb-0">
                                            <img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$addition->image"))) }}" alt="{{$addition->title_ru}}">
                                            <span>{{ str_replace('\\', '/', asset(trim("uploads/$addition->image"))) }}</span>
                                        </p>
                                    @else
                                        <p class="mb-0">Изображение не заполнено</p>
                                    @endif
                                </div>
                                <hr>
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
