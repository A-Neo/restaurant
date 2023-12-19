@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактировать мероприятие</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.banquets.update', ['banquet' => $banquet->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Мероприятие: "{{ $banquet->title_ru }}"</h3>
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
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                        <div class="form-group">
                                            <label for="title_ru">Название на русском</label>
                                            <input type="text" name="title_ru"
                                                   class="form-control @error('title_ru') is-invalid @enderror" id="title_ru"
                                                   value="{{ $banquet->title_ru }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle_ru">Подпись на баннере - русский</label>
                                            <textarea name="subtitle_ru" class="form-control @error('subtitle_ru') is-invalid @enderror" rows="5" id="subtitle_ru" placeholder="Подпись баннера">{{ $banquet->subtitle_ru }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_ru">Текст на русском</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="5" id="description_ru" placeholder="Текст">{{ $banquet->description_ru }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group" id="content_en_text">
                                            <label for="title_en">Название на английском</label>
                                            <input type="text" name="title_en"
                                                   class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                   value="{{ $banquet->title_en }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="subtitle_en">Подпись на баннере - английский</label>
                                            <textarea name="subtitle_en" class="form-control @error('subtitle_en') is-invalid @enderror" rows="5" id="subtitle_en" placeholder="Подпись баннера">{{ $banquet->subtitle_en }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Текст на английском</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="5" id="description_en" placeholder="Текст">{{ $banquet->description_en }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-slider" role="tabpanel" aria-labelledby="custom-tabs-three-slider-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="mb-0">Слайдер</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="sliders-wrap">
                                                    <div class="form-group slider-group">
                                                        <label for="image">Изображение для слайдера</label>
                                                        <div class="d-flex" style="align-items: center;flex-wrap: wrap">
                                                            @foreach($banquet->sliders as $image)
                                                                <div style="display: flex;flex-direction: column; align-items: center;margin-right: 20px;" class="slider-item">
                                                                    <img style="width: 100px;height: 100px;object-fit: cover" src="{{ str_replace('\\', '/', asset(trim("uploads/$image->image"))) }}" alt="{{ $banquet->title_ru }}">
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
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="image">Баннер (изображение)</label>
                                    <div class="input-group">
                                        <div class="custom-file"><input name="image" type="file" class="custom-file-input" id="image"><label class="custom-file-label" for="image">Изменить</label></div>
                                    </div>
                                </div>
                                <hr>

                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    <p class="mb-0"><img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$banquet->image"))) }}" alt="{{$banquet->title}}"><span>{{ str_replace('\\', '/', asset(trim("uploads/$banquet->image"))) }}</span></p>
                                </div>
                                <hr>

                                <div class="form-group" style="margin-top: 20px">
                                    <label for="title_ru">Meta-title</label>
                                    <input type="text" name="meta_title"
                                           class="form-control @error('meta_title') is-invalid @enderror" id="title_en"
                                           placeholder="Мета заголовок" value="{{ $banquet->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-description</label>
                                    <input type="text" name="meta_description"
                                           class="form-control @error('meta_description') is-invalid @enderror" id="title_en"
                                           placeholder="Мета описание" value="{{ $banquet->meta_description }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-keywords</label>
                                    <input type="text" name="meta_keywords"
                                           class="form-control @error('meta_keywords') is-invalid @enderror" id="title_en"
                                           placeholder="Мета ключи" value="{{ $banquet->meta_keywords }}">
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

                let image = $(this).attr('href');

                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    url: '{{ route('admin.banquet.delete.slide', ['id' => $banquet->id])  }}',
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
