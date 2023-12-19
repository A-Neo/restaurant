@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование статьи</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.articles.update', ['article' => $article->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Статья - "{{ $article->title_ru }}"</h3>
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
                                                   value="{{ $article->title_ru }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_ru">Описание на русском</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="description_ru">{{ $article->description_ru }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group" id="content_en_text">
                                            <label for="title_en">Название на английском</label>
                                            <input type="text" name="title_en"
                                                   class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                   value="{{ $article->title_en }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Описание на английском</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="description_en">{{ $article->description_en }}</textarea>
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
                                                        <div class="d-flex" style="align-items: center;flex-wrap: wrap">
                                                            @foreach($article->sliders as $image)
                                                            <div style="display: flex;flex-direction: column; align-items: center;margin-right: 20px;" class="slider-item">
                                                                <img style="width: 100px;height: 100px;object-fit: cover" src="{{ str_replace('\\', '/', asset(trim("uploads/$image->image"))) }}" alt="{{ $article->title_ru }}">
                                                                <a href="{{ $image->id }}" class="img-slide-delete btn btn-danger btn-sm" style="width: 100%;border-radius: 0"><i class="fas fa-trash-alt"></i></a>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <hr>
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
                                                        <div class="d-flex" style="align-items: center;flex-wrap: wrap">
                                                            @foreach($article->galleries as $image)
                                                                <div style="display: flex;flex-direction: column; align-items: center;margin-right: 20px;" class="gallery-item">
                                                                    <img style="width: 100px;height: 100px;object-fit: cover" src="{{ str_replace('\\', '/', asset(trim("uploads/$image->image"))) }}" alt="{{ $article->title_ru }}">
                                                                    <a href="{{ $image->id }}" class="img-gallery-delete btn btn-danger btn-sm" style="width: 100%;border-radius: 0"><i class="fas fa-trash-alt"></i></a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <hr>
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
                                                <div class="btn btn-primary add-slide">Добавить изображение</div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Баннер (изображение)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Изменить изображение</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    @if($article->image)
                                        <p class="mb-0">
                                            <img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$article->image"))) }}" alt="{{$article->title_ru}}">
                                            <span>{{ str_replace('\\', '/', asset(trim("uploads/$article->image"))) }}</span>
                                        </p>
                                    @else
                                        <p class="mb-0">Изображение не заполнено</p>
                                    @endif
                                </div>
                                <hr>
                                <div class="row pb-0 p-0" style="padding: 1.25rem">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="rubric">Рубрика</label>
                                            <select name="rubric" id="rubric" class="form-control">
                                                @foreach($rubrics as $k => $v)
                                                    <option value="{{ $v->id }}" @if($v->id == $article->rubric) selected @endif> {{ $v->title_ru }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="form">Добавить форму (в конце)</label>
                                            <select name="form" id="form" class="form-control">
                                                <option value="0" @if($article->form == 0) selected @endif>Нет</option>
                                                <option value="1" @if($article->form == 1) selected @endif>Бронь стола</option>
                                                <option value="2" @if($article->form == 2) selected @endif>Бронь банкета</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <div class="form-group">
                                    <label for="order">Порядковый номер</label>
                                    <input type="number" name="order"
                                           class="form-control @error('order') is-invalid @enderror" id="order"
                                           placeholder="Порядковый номер" value="{{ $article->order }}">
                                </div>
                                <div class="form-group" style="margin-top: 20px">
                                    <label for="title_ru">Meta-title</label>
                                    <input type="text" name="meta_title"
                                           class="form-control @error('meta_title') is-invalid @enderror" id="title_en"
                                           placeholder="Мета заголовок" value="{{ $article->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-description</label>
                                    <input type="text" name="meta_description"
                                           class="form-control @error('meta_description') is-invalid @enderror" id="title_en"
                                           placeholder="Мета описание" value="{{ $article->meta_description }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-keywords</label>
                                    <input type="text" name="meta_keywords"
                                           class="form-control @error('meta_keywords') is-invalid @enderror" id="title_en"
                                           placeholder="Мета ключи" value="{{ $article->meta_keywords }}">
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
        let editor1 = CKEDITOR.replace('description_ru');
        let editor2 = CKEDITOR.replace('description_en');

        CKFinder.setupCKEditor(editor1);
        CKFinder.setupCKEditor(editor2);

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

        let token = $("input[name='_token']").attr("value");

        $('.img-slide-delete').click(function (event) {
            event.preventDefault();

            let item = $(this).closest('.slider-item');

            let image = $(this).attr('href');

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: '{{ route('admin.article.delete.slide', ['id' => $article->id])  }}',
                data: {
                    image: image
                },
                success: function (data) {
                    console.log(data);
                    item .remove();
                    console.log('123');
                },
                error: function(result){
                    console.log(result);
                }
            });
        });

        $('.img-gallery-delete').click(function (event) {
            event.preventDefault();

            let item = $(this).closest('.gallery-item');

            let image = $(this).attr('href');

            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: '{{ route('admin.article.delete.gallery', ['id' => $article->id])  }}',
                data: {
                    image: image
                },
                success: function (data) {
                    console.log(data);
                    item .remove();
                    console.log('123');
                },
                error: function(result){
                    console.log(result);
                }
            });
        });


    </script>
@endpush
