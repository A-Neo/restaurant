@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создание новой статьи</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form role="form" method="post" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card card-primary card-outline card-tabs">
                                <div class="card-header">
                                    <h3 class="card-title">Новая статья</h3>
                                </div>
                                <div class="card-header p-0 pt-1 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Русский</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">English</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-slider-tab" data-toggle="pill" href="#custom-tabs-three-slider" role="tab" aria-controls="custom-tabs-three-slider" aria-selected="true">Слайдер</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-three-gallery-tab" data-toggle="pill" href="#custom-tabs-three-gallery" role="tab" aria-controls="custom-tabs-three-gallery" aria-selected="true">Галерея</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-three-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                            <div class="form-group">
                                                <label for="title_ru">Название на русском</label>
                                                <input type="text" name="title_ru"
                                                       class="form-control @error('title_ru') is-invalid @enderror" id="title_ru"
                                                       placeholder="Название пункта меню">
                                            </div>
                                            <div class="form-group">
                                                <label for="description_ru">Описание на русском</label>
                                                <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="description_ru"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                            <div class="form-group" id="content_en_text">
                                                <label for="title_en">Название на английском</label>
                                                <input type="text" name="title_en"
                                                       class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                       placeholder="Название пункта меню">
                                            </div>
                                            <div class="form-group">
                                                <label for="description_en">Описание на английском</label>
                                                <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="description_en"></textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-slider" role="tabpanel" aria-labelledby="custom-tabs-three-slider-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="mb-0">Слайдер</label><span> - вставьте в описание: «x-slider» <small>(без кавычек)</small></span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="sliders-wrap">
                                                        <div class="form-group slider-group">
                                                            <label for="image">Изображение для слайдера</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="sliders[]" type="file" class="custom-file-input">
                                                                    <label class="custom-file-label" for="sliders">Добавить изображение</label>
                                                                </div>
                                                                <div class="input-delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr>
                                                <div class="col-12">
                                                    <div class="btn btn-primary add-slide">Добавить слайд</div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-three-gallery" role="tabpanel" aria-labelledby="custom-tabs-three-gallery-tab">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="mb-0">Галерея</label><span> - вставьте в описание: «x-galleries» <small>(без кавычек)</small></span> - <small>Количество кратное: 3</small>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="sliders-wrap">
                                                        <div class="form-group gallery-group">
                                                            <label for="image">Изображение для галереи</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input name="galleries[]" type="file" class="custom-file-input">
                                                                    <label class="custom-file-label" for="sliders">Добавить изображение</label>
                                                                </div>
                                                                <div class="input-delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-12">
                                                    <div class="btn btn-primary add-slide">Добавить слайд</div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Изображение (основное)</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input name="image" type="file" class="custom-file-input" id="image">
                                                <label class="custom-file-label" for="image">Добавить изображение</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row pb-0 p-0" style="padding: 1.25rem">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="rubric">Рубрика</label>
                                                <select name="rubric" id="rubric" class="form-control">
                                                    @foreach($rubrics as $k => $v)
                                                        <option value="{{ $v->id }}" @if($k == 0) selected @endif>{{ $v->title_ru }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="form">Добавить форму (в конце)</label>
                                                <select name="form" id="form" class="form-control">
                                                    <option value="0" selected>Нет</option>
                                                    <option value="1">Бронь стола</option>
                                                    <option value="2">Бронь банкета</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <label for="order">Порядковый номер</label>
                                        <input type="number" name="order"
                                               class="form-control @error('order') is-invalid @enderror" id="order"
                                               value="0">
                                    </div>
                                    <div class="form-group" style="margin-top: 20px">
                                        <label for="title_ru">Meta-title</label>
                                        <input type="text" name="meta_title"
                                               class="form-control @error('meta_title') is-invalid @enderror" id="title_en"
                                               placeholder="Мета заголовок">
                                    </div>
                                    <div class="form-group">
                                        <label for="title_ru">Meta-description</label>
                                        <input type="text" name="meta_description"
                                               class="form-control @error('meta_description') is-invalid @enderror" id="title_en"
                                               placeholder="Мета описание">
                                    </div>
                                    <div class="form-group">
                                        <label for="title_ru">Meta-keywords</label>
                                        <input type="text" name="meta_keywords"
                                               class="form-control @error('meta_keywords') is-invalid @enderror" id="title_en"
                                               placeholder="Мета ключи">
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
    <script>

        let editor = CKEDITOR.replace('description_ru');

        CKFinder.setupCKEditor(editor);

        let wrap_slide =  $('.sliders-wrap .slider-group');
        let wrap_gallery =  $('.sliders-wrap .gallery-group');

        $('#custom-tabs-three-slider .add-slide').click(function () {
            let slide = undefined;

            slide = $('.slider-group .input-group').first().clone();
            slide.find('input').val('');
            slide.find('label').text('Добавить изображение');

            wrap_slide.append(slide.css('margin', '20px 0'));

            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });

        $(".slider-group").on("click", '.input-group .input-delete', function () {
            if($('.slider-group .input-group .custom-file-input').length > 1) {
                $(this).closest('.input-group').remove();
            }
        });

        $('#custom-tabs-three-gallery .add-slide').click(function () {
            let slide = undefined;

            slide = $('.gallery-group .input-group').first().clone();
            slide.find('input').val('');
            slide.find('label').text('Добавить изображение');

            wrap_gallery.append(slide.css('margin', '20px 0'));

            $(".custom-file-input").on("change", function () {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });

        $(".gallery-group").on("click", '.input-group .input-delete', function () {
            if($('.gallery-group .input-group .custom-file-input').length > 1) {
                $(this).closest('.input-group').remove();
            }
        });
    </script>
@endpush
