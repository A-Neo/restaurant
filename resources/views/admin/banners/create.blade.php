@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создание баннера</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form role="form" method="post" action="{{ route('banners.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header">
                                    <h3 class="card-title">Новый баннер</h3>
                                </div>
                                <div class="row pb-0" style="padding: 1.25rem">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Задний фон</label>
                                            <select name="mode_bg" id="mode_bg" class="form-control">
                                                <option value="0" selected>Не выбрано</option>
                                                <option value="1">Изображение (background)</option>
                                                <option value="2">Видео</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Контент</label>
                                            <select name="mode_content" id="mode_content" class="form-control">
                                                <option value="0" selected>Не выбрано</option>
                                                <option value="1">Заголовок + текс</option>
                                                <option value="2">Изображение + текст</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Выравнивание</label>
                                            <select name="mode_align" id="mode_align" class="form-control">
                                                <option value="1" selected>По левому краю</option>
                                                <option value="2">По центру</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
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
                                            <div class="index_content" style="visibility: hidden;"></div>
                                            <div class="index_content">
                                                <div class="form-group">
                                                    <label for="title_ru">Заголовок баннера на русском</label>
                                                    <input type="text" name="title_ru"
                                                           class="form-control @error('title_ru') is-invalid @enderror" id="title_ru"
                                                           placeholder="Заголовок баннера">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="subtitle_ru">Подпись на русском</label>
                                                <textarea name="subtitle_ru" class="form-control @error('subtitle_ru') is-invalid @enderror" rows="5" id="subtitle_ru" placeholder="Подпись баннера"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="btn_ru">Текст кнопки на русском</label>
                                                <input type="text" name="btn_ru"
                                                       class="form-control @error('btn_ru') is-invalid @enderror" id="btn_ru"
                                                       placeholder="Текст кнопки">
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <div class="form-group" id="content_en_text">
                                                <label for="title_ru">Заголовок баннера на английском</label>
                                                <input type="text" name="title_en"
                                                       class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                       placeholder="Заголовок баннера">
                                            </div>
                                            <div class="form-group">
                                                <label for="subtitle_en">Подпись на английском</label>
                                                <textarea name="subtitle_en" class="form-control @error('subtitle_en') is-invalid @enderror" rows="5" id="subtitle_en" placeholder="Подпись баннера"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="btn_en">Текст кнопки на английском</label>
                                                <input type="text" name="btn_en"
                                                       class="form-control @error('btn_en') is-invalid @enderror" id="btn_en"
                                                       placeholder="Текст кнопки">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="btn_link">Кнопка (ссылка)</label>
                                        <input type="text" name="btn_link"
                                               class="form-control @error('btn_link') is-invalid @enderror" id="btn_link"
                                               placeholder="Ссылка на страницу">
                                    </div>
                                    <div class="index_content">
                                        <div class="form-group">
                                            <label for="image">Контент - (изображение)</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input name="image" type="file" class="custom-file-input" id="image">
                                                    <label class="custom-file-label" for="image">Добавить изображение</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="form-group">
                                        <div class="index_bg" style="visibility: hidden;"></div>
                                        <div class="index_bg">
                                            <div class="form-group">
                                                <label for="bg_image">Задний фон (background)</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="bg_image" type="file" class="custom-file-input" id="bg_image">
                                                        <label class="custom-file-label" for="bg_image">Добавить изображение</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="index_bg">
                                            <div class="form-group">
                                            <label for="video">Ссылка на видео</label>
                                            <input name="video_link" type="text" class="form-control @error('video_link') is-invalid @enderror" id="video_link"
                                                   placeholder="Ссылка на видео с youtube">
                                            </div>
                                            <div class="form-group">
                                                <label for="bg_image">Задний фон (background)</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input name="bg_image" type="file" class="custom-file-input" id="bg_image">
                                                        <label class="custom-file-label" for="bg_image">Добавить изображение</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="order">Порядковый номер</label>
                                            <input type="number" name="order"
                                                   class="form-control @error('order') is-invalid @enderror" id="order"
                                                   placeholder="Порядковый номер">
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
    <style>
        .index_bg {
            display: none;
        }

        .index_content {
            display: none;
        }

        #content_en_text {
            display: none;
        }

    </style>
@endpush

@push('scripts')
    <script>
        // Для mode_bg
        let bg = document.getElementById('mode_bg');
        let bg_block = document.querySelectorAll('.index_bg');
        let bg_lastIndex = 0; // После каждой смены опции, сохраняем сюда индекс предыдущего блока

        bg.addEventListener('change', function() {
            bg_block[bg_lastIndex].style.display = "none";
            // Чтобы сразу делать именно его невидимым при следующей смене

            let index = bg.selectedIndex; // Определить индекс выбранной опции
            bg_block[index].style.display = "block"; // Показать блок с соответствующим индексом

            bg_lastIndex = index; // Обновить сохраненный индекс.
        });

        // Для mode_content
        let content = document.getElementById('mode_content');
        let content_block = document.querySelectorAll('.index_content');
        let content_lastIndex = 0; // После каждой смены опции, сохраняем сюда индекс предыдущего блока
        let en_text = document.getElementById('content_en_text');

        content.addEventListener('change', function() {
            content_block[content_lastIndex].style.display = "none";
            en_text.style.display = "none";
            // Чтобы сразу делать именно его невидимым при следующей смене

            let index =content.selectedIndex; // Определить индекс выбранной опции

            if (index === 1) {
                en_text.style.display = "block";
            }

            content_block[index].style.display = "block"; // Показать блок с соответствующим индексом

            content_lastIndex = index; // Обновить сохраненный индекс.
        });
    </script>
@endpush
