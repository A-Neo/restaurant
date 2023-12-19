@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Просмотр заявки</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.callbacks.update', ['callback' => $callback->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Заявка от - "{{ $callback->name }}"</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Имя</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                                   placeholder="Имя" value="{{ $callback->name }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="phone">Телефон</label>
                                            <input type="text" name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                   placeholder="Телефон" value="{{ $callback->phone }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="text" name="email"
                                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                                   placeholder="E-mail" value="{{ $callback->email }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="human">Количество человек</label>
                                            <input type="text" name="human"
                                                   class="form-control @error('human') is-invalid @enderror" id="human"
                                                   placeholder="Количество человек" value="{{ $callback->human }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="date">Дата визита</label>
                                            <input type="text" name="date"
                                                   class="form-control @error('date') is-invalid @enderror" id="date"
                                                   placeholder="Дата визита" value="{{ $callback->date }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="time">Время визита</label>
                                            <input type="text" name="time"
                                                   class="form-control @error('time') is-invalid @enderror" id="time"
                                                   placeholder="Время визита" value="{{ $callback->time }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="type">Тип брони</label>
                                            <select name="type" id="type" class="form-control" data-placeholder="Тип брони" style="width: 100%;">
                                                    <option value="1" @if($callback->type == 1) selected @endif>Бронь стола</option>
                                                    <option value="2" @if($callback->type == 2) selected @endif>Бронь банкета</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Статус</label>
                                            <select name="status" id="status" class="form-control" data-placeholder="Статус" style="width: 100%;">
                                                <option value="0" @if($callback->status == 0) selected @endif>В процессе</option>
                                                <option value="1" @if($callback->status == 1) selected @endif>Готово</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="created_at">Дата заявки</label>
                                            <input type="text" name="created_at"
                                                   class="form-control @error('created_at') is-invalid @enderror" id="created_at"
                                                   placeholder="Дата заявки" value="{{ date('d-m-Y', strtotime($callback->created_at)) }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="link">Ссылка откуда пришла заявка</label>
                                            <input type="text" name="link"
                                                   class="form-control @error('link') is-invalid @enderror" id="link"
                                                   placeholder="Ссылка" value="{{ $callback->link }}" readonly>
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
