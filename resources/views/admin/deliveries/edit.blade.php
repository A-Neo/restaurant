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
                    <form role="form" action="{{ route('admin.deliveries.update', ['delivery' => $delivery->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Изменить зону доставки</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Наименование зоны</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Наименование зоны" value="{{ $delivery->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Стоимость доставки</label>
                                    <input type="text" name="price"
                                           class="form-control @error('price') is-invalid @enderror" id="price"
                                           placeholder="Стоимость доставки" value="{{ $delivery->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="min_amount">Минимальная сумма заказа</label>
                                    <input type="text" name="min_amount"
                                           class="form-control @error('min_amount') is-invalid @enderror" id="min_amount"
                                           placeholder="Минимальная сумма заказа" value="{{ $delivery->min_amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="free_delivery">Сумма бесплатной доставки</label>
                                    <input type="text" name="free_delivery"
                                           class="form-control @error('free_delivery') is-invalid @enderror" id="free_delivery"
                                           placeholder="Сумма бесплатной доставки" value="{{ $delivery->free_delivery }}">
                                </div>
                                <div class="form-group">
                                    <label for="min_time">Мин. время доставки</label>
                                    <input type="text" name="min_time"
                                           class="form-control @error('min_time') is-invalid @enderror" id="min_time"
                                           placeholder="Мин. время доставки" value="{{ $delivery->min_time }}">
                                </div>
                                <div class="form-group">
                                    <label for="max_time">Макс. время доставки</label>
                                    <input type="text" name="max_time"
                                           class="form-control @error('max_time') is-invalid @enderror" id="max_time"
                                           placeholder="Макс. время доставки" value="{{ $delivery->max_time }}">
                                </div>
                                <div class="form-group">
                                    <label for="zone">Файл</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="zone" type="file" class="custom-file-input" id="zone">
                                            <label class="custom-file-label" for="zone">Добавить файл</label>
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
