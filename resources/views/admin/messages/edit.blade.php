@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Просмотр сообщения</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.messages.update', ['message' => $message->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Сообщение от - "{{ $message->name }}"</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Имя</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                                   placeholder="Имя" value="{{ $message->name }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="phone">Телефон</label>
                                            <input type="text" name="phone"
                                                   class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                   placeholder="Телефон" value="{{ $message->phone }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="text" name="email"
                                                   class="form-control @error('email') is-invalid @enderror" id="email"
                                                   placeholder="E-mail" value="{{ $message->email }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="theme">Тема</label>
                                            <input type="text" name="theme"
                                                   class="form-control @error('theme') is-invalid @enderror" id="theme"
                                                   placeholder="Тема" value="{{ $message->theme }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="message">Сообщение</label>
                                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" rows="5" id="message" placeholder="Сообщение">{{ $message->message }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="status">Статус</label>
                                            <select name="status" id="status" class="form-control" data-placeholder="Статус" style="width: 100%;">
                                                <option value="0" @if($message->status == 0) selected @endif>Новое</option>
                                                <option value="1" @if($message->status == 1) selected @endif>Просмотрено</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="created_at">Дата сообщения</label>
                                            <input type="text" name="created_at"
                                                   class="form-control @error('created_at') is-invalid @enderror" id="created_at"
                                                   placeholder="Дата заявки" value="{{ date('d-m-Y', strtotime($message->created_at)) }}" readonly>
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
