@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование страницы</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" action="{{ route('admin.pages.update', ['page' => $page->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Страница "{{ $page->title_ru }}"</h3>
                            </div>
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Русский</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">English</a>
                                    </li>
                                    @if($page->id == 4 || $page->id == 8 || $page->id == 12)
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-slider-tab" data-toggle="pill" href="#custom-tabs-three-slider" role="tab" aria-controls="custom-tabs-three-slider" aria-selected="true">Галерея</a>
                                    </li>
                                     @endif
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                        <div class="form-group">
                                            <label for="title_ru">Название на русском</label>
                                            <input type="text" name="title_ru"
                                                   class="form-control @error('title_ru') is-invalid @enderror" id="title_ru"
                                                   value="{{ $page->title_ru }}">
                                        </div>
                                        @if($page->id !== 9 && $page->id !== 10 && $page->id !== 11)
                                        <div class="form-group">
                                            <label for="subtitle_ru">Подпись на баннере - русский</label>
                                            <textarea name="subtitle_ru" class="form-control @error('subtitle_ru') is-invalid @enderror" rows="5" id="subtitle_ru" placeholder="Подпись баннера">{{ $page->subtitle_ru }}</textarea>
                                        </div>
                                        @endif
                                        @if($page->id == 4 || $page->id == 8 || $page->id == 9 || $page->id == 10 || $page->id == 11 || $page->id == 12)
                                        <div class="form-group">
                                            <label for="description_ru">Текст на русском</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="5" id="description_ru" placeholder="Текст">{{ $page->description_ru }}</textarea>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="pdf_ru">PDF - Кнопка</label>
                                            <input type="text" name="pdf_ru" class="form-control @error('pdf_ru') is-invalid @enderror" id="pdf_ru" placeholder="Текст для кнопки" value="{{ $page->pdf_ru }}">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group" id="content_en_text">
                                            <label for="title_en">Название на английском</label>
                                            <input type="text" name="title_en"
                                                   class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                   value="{{ $page->title_en }}">
                                        </div>
                                        @if($page->id !== 9 && $page->id !== 10 && $page->id !== 11)
                                        <div class="form-group">
                                            <label for="subtitle_en">Подпись на баннере - английский</label>
                                            <textarea name="subtitle_en" class="form-control @error('subtitle_en') is-invalid @enderror" rows="5" id="subtitle_en" placeholder="Подпись баннера">{{ $page->subtitle_en }}</textarea>
                                        </div>
                                        @endif
                                        @if($page->id == 4 || $page->id == 8 || $page->id == 9 || $page->id == 10 || $page->id == 11 || $page->id == 12)
                                        <div class="form-group">
                                            <label for="description_en">Текст на английском</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="5" id="description_en" placeholder="Текст">{{ $page->description_en }}</textarea>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="pdf_en">PDF - Button</label>
                                            <input type="text" name="pdf_en" class="form-control @error('pdf_en') is-invalid @enderror" id="pdf_en" placeholder="Text for button" value="{{ $page->pdf_en }}">
                                        </div>
                                    </div>
                                    @if($page->id == 4 || $page->id == 8 || $page->id == 12)
                                    <div class="tab-pane fade" id="custom-tabs-three-slider" role="tabpanel" aria-labelledby="custom-tabs-three-slider-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="mb-0">Галерея</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="title_gallery">Заголовок</label>
                                                    <input type="text" name="title_gallery"
                                                           class="form-control @error('title_gallery') is-invalid @enderror" id="title_gallery"
                                                           value="{{ $page->title_gallery }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="sliders-wrap">
                                                    <div class="form-group slider-group">
                                                        <label for="image">Изображения</label>
                                                        <div class="d-flex" style="align-items: center;flex-wrap: wrap">
                                                            @foreach($page->sliders as $image)
                                                                <div style="display: flex;flex-direction: column; align-items: center;margin-right: 20px;" class="slider-item">
                                                                    <img style="width: 100px;height: 100px;object-fit: cover" src="{{ str_replace('\\', '/', asset(trim("uploads/$image->image"))) }}" alt="{{ $page->title_ru }}">
                                                                    <a href="{{ $image->id }}" class="img-slide-delete btn btn-danger btn-sm" style="width: 100%;border-radius: 0"><i class="fas fa-trash-alt"></i></a>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <hr>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input name="sliders[]" multiple type="file" class="custom-file-input">
                                                                <label class="custom-file-label" for="sliders">Добавить изображение</label>
                                                            </div>
                                                            <div class="input-delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <hr>
                                            <div class="col-12">
{{--                                                <div class="btn btn-primary add-slide">Добавить слайд</div>--}}
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    @endif
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="pdf_file">PDF</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="pdf_file" type="file" class="custom-file-input" id="pdf_file"><label class="custom-file-label" for="pdf_file">Изменить</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="image">Баннер (изображение)</label>
                                    <div class="input-group">
                                        <div class="custom-file"><input name="image" type="file" class="custom-file-input" id="image"><label class="custom-file-label" for="image">Изменить</label></div>
                                    </div>
                                </div>
                                <hr>
                                @if($page->image)
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    <p class="mb-0"><img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$page->image"))) }}" alt="{{$page->title}}"><span>{{ str_replace('\\', '/', asset(trim("uploads/$page->image"))) }}</span></p>
                                </div>
                                <hr>
                                @endif
                                @if($page->pdf_file)
                                    <div class="d-flex" style="align-items: center;justify-content: space-between">
                                        <p class="mb-0">{{ $page->pdf_ru ?? 'PDF' }} <span>{{ str_replace('\\', '/', asset(trim("uploads/$page->pdf_file"))) }}</span></p>
                                    </div>
                                    <hr>
                                @endif
                                <div class="form-group" style="margin-top: 20px">
                                    <label for="title_ru">Meta-title</label>
                                    <input type="text" name="meta_title"
                                           class="form-control @error('meta_title') is-invalid @enderror" id="title_en"
                                           placeholder="Мета заголовок" value="{{ $page->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-description</label>
                                    <input type="text" name="meta_description"
                                           class="form-control @error('meta_description') is-invalid @enderror" id="title_en"
                                           placeholder="Мета описание" value="{{ $page->meta_description }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-keywords</label>
                                    <input type="text" name="meta_keywords"
                                           class="form-control @error('meta_keywords') is-invalid @enderror" id="title_en"
                                           placeholder="Мета ключи" value="{{ $page->meta_keywords }}">
                                </div>
                                <input type="text" name="test" value="{{ route('admin.pages.update', ['page' => $page->id]) }}">
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
    @if($page->id == 9 || $page->id == 10 || $page->id == 11)
        <script>
            let editor1 = CKEDITOR.replace('description_ru');
            let editor2 = CKEDITOR.replace('description_en');

            CKFinder.setupCKEditor(editor1);
            CKFinder.setupCKEditor(editor2);
        </script>
    @endif
    @if($page->id == 4 || $page->id == 8 || $page->id == 12)
        <script>
            let editor1 = CKEDITOR.replace('description_ru');
            let editor2 = CKEDITOR.replace('description_en');

            CKFinder.setupCKEditor(editor1);
            CKFinder.setupCKEditor(editor2);

            let wrap_slide =  $('.sliders-wrap .slider-group');

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

            $(".gallery-group").on("click", '.input-group .input-delete', function () {
                if($('.gallery-group .input-group .custom-file-input').length > 1) {
                    $(this).closest('.input-group').remove();
                }
            });

            let token = $("input[name='_token']").attr("value");

            $('.img-slide-delete').click(function (event) {
                event.preventDefault();

                let item = $(this).closest('.slider-item');
                let image_id = $(this).attr('href');

                let page_id = {{ $page->id }};
                console.log(page_id);
                console.log(image_id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: '/admin/pages/' + page_id + '/delete-slide', // URL для запроса
                    type: 'POST',
                    data: {
                        pageId:  page_id,
                        imageId: image_id,
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
    @endif
@endpush
