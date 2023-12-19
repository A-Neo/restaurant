@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование блока о нас на главной</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.abouts.update', ['about' => $about->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">О нас на главной</h3>
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
                                            <label for="subtitle_ru">Заголовок на главной (русский)</label>
                                            <input type="text" name="subtitle_ru"
                                                   class="form-control @error('subtitle_ru') is-invalid @enderror" id="subtitle_ru"
                                                   value="{{ $about->subtitle_ru }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="describe_ru">Описание на главной (русский)</label>
                                            <textarea name="describe_ru" class="form-control @error('describe_ru') is-invalid @enderror" rows="5" id="describe_ru">{{ $about->describe_ru }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="btn_ru">Текст кнопки на главной (русский)</label>
                                            <input type="text" name="btn_ru"
                                                   class="form-control @error('btn_ru') is-invalid @enderror" id="btn_ru"
                                                   value="{{ $about->btn_ru }}">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group">
                                            <label for="subtitle_en">Заголовок на главной (английский)</label>
                                            <input type="text" name="subtitle_en"
                                                   class="form-control @error('subtitle_en') is-invalid @enderror" id="subtitle_en"
                                                   value="{{ $about->subtitle_en }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="describe_en">Описание на главной (английский)</label>
                                            <textarea name="describe_en" class="form-control @error('describe_en') is-invalid @enderror" rows="5" id="describe_en">{{ $about->describe_en }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="btn_en">Текст кнопки на главной (английский)</label>
                                            <input type="text" name="btn_en"
                                                   class="form-control @error('btn_en') is-invalid @enderror" id="btn_en"
                                                   value="{{ $about->btn_en }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="btn_link">Кнопка (ссылка)</label>
                                    <input type="text" name="btn_link"
                                           class="form-control @error('btn_link') is-invalid @enderror" id="btn_link"
                                           value="{{ $about->btn_link }}" placeholder="https://dedi.ru">
                                </div>
                                <div class="form-group">
                                    <label for="image">Контент - (изображение)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Изменить изображение</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    @if($about->image)
                                        <p class="mb-0">
                                            <img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$about->image"))) }}" alt="{{$about->title_ru}}">
                                            <span>{{ str_replace('\\', '/', asset(trim("uploads/$about->image"))) }}</span>
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
