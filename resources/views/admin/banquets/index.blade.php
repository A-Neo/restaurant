@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Мероприятия</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список мероприятий</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.banquets.create') }}" class="btn btn-primary mb-3">Добавить
                                запись</a>
                            @if (count($banquets))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 80px">ID</th>
                                            <th>Наименование страницы (RU)</th>
                                            <th>Наименование страницы (EN)</th>
                                            <th style="width: 160px">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($banquets as $banquet)
                                            <tr>
                                                <td>{{ $banquet->id }}</td>
                                                <td>{{ $banquet->title_ru }}</td>
                                                <td>{{ $banquet->title_en }}</td>
                                                <td>
                                                    <a href="{{ route('admin.banquets.edit', ['banquet' => $banquet->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form
                                                            action="{{ route('admin.banquets.destroy', ['banquet' => $banquet->id]) }}"
                                                            method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                                onclick="return confirm('Подтвердите архивирование')">
                                                            <i class="fas fa-file-archive"></i>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.banquet.full.delete', ['id' => $banquet->id]) }}"
                                                        method="post" class="float-left" style="margin-left: 3px">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Записей пока нет ...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $banquets->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

