@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование отзывы</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.reviews.update', ['review' => $review->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Отзыв от - {{ $review->name_ru }}</h3>
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
                                            <label for="name_ru">Ф.И.О (русский)</label>
                                            <input type="text" name="name_ru"
                                                   class="form-control @error('name_ru') is-invalid @enderror" id="name_ru"
                                                   value="{{ $review->name_ru }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_ru">Отзыв (русский)</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="5" id="description_ru">{{ $review->description_ru }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group">
                                            <label for="name_en">Ф.И.О (английский)</label>
                                            <input type="text" name="name_en"
                                                   class="form-control @error('name_en') is-invalid @enderror" id="name_en"
                                                   value="{{ $review->name_en }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Отзыв (английский)</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="5" id="description_en">{{ $review->description_en }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Аватарка</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Изменить изображение</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex" style="align-items: center;justify-content: space-between">
                                    @if($review->image)
                                        <p class="mb-0">
                                            <img style="width:100px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$review->image"))) }}" alt="{{$review->name_ru}}">
                                            <span>{{ str_replace('\\', '/', asset(trim("uploads/$review->image"))) }}</span>
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
