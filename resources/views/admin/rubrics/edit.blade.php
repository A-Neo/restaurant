@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование рубрики</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.rubrics.update', ['rubric' => $rubric->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Рубрика - "{{ $rubric->title_ru }}"</h3>
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
                                            <label for="title_ru">Название на русском</label>
                                            <input type="text" name="title_ru"
                                                   class="form-control @error('title_ru') is-invalid @enderror" id="title_ru"
                                                   value="{{ $rubric->title_ru }}">
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group" id="content_en_text">
                                            <label for="title_en">Название на английском</label>
                                            <input type="text" name="title_en"
                                                   class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                   value="{{ $rubric->title_en }}">
                                        </div>
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
                                <hr>
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    @if($rubric->image)
                                        <p class="mb-0">
                                            <img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$rubric->image"))) }}" alt="{{$rubric->title_ru}}">
                                            <span>{{ str_replace('\\', '/', asset(trim("uploads/$rubric->image"))) }}</span>
                                        </p>
                                    @else
                                        <p class="mb-0">Изображение не заполнено</p>
                                    @endif
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="order">Порядковый номер</label>
                                    <input type="number" name="order"
                                           class="form-control @error('order') is-invalid @enderror" id="order"
                                           placeholder="Порядковый номер" value="{{ $rubric->order }}">
                                </div>
                                <div class="form-group" style="margin-top: 20px">
                                    <label for="title_ru">Meta-title</label>
                                    <input type="text" name="meta_title"
                                           class="form-control @error('meta_title') is-invalid @enderror" id="title_en"
                                           placeholder="Мета заголовок" value="{{ $rubric->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-description</label>
                                    <input type="text" name="meta_description"
                                           class="form-control @error('meta_description') is-invalid @enderror" id="title_en"
                                           placeholder="Мета описание" value="{{ $rubric->meta_description }}">
                                </div>
                                <div class="form-group">
                                    <label for="title_ru">Meta-keywords</label>
                                    <input type="text" name="meta_keywords"
                                           class="form-control @error('meta_keywords') is-invalid @enderror" id="title_en"
                                           placeholder="Мета ключи" value="{{ $rubric->meta_keywords }}">
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
