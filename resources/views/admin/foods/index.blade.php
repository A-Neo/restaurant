@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Еда</h1>
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
                            <h3 class="card-title">Основные пункты меню</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.foods.create') }}" class="btn btn-primary mb-3">Добавить
                                пункт меню</a>
                            @if (count($foods))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 80px">ID</th>
                                            <th>Наименование (RU)</th>
                                            <th>Наименование (EN)</th>
                                            <th>Порядковый номер</th>
                                            <th style="width: 160px">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($foods as $food)
                                            <tr>
                                                <td>{{ $food->id }}</td>
                                                <td>{{ $food->title_ru }}</td>
                                                <td>{{ $food->title_en }}</td>
                                                <td>{{ $food->order }}</td>
                                                <td>
                                                    <a href="{{ route('admin.foods.edit', ['food' => $food->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('admin.foods.destroy', ['food' => $food->id]) }}"
                                                        method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                                onclick="return confirm('Подтвердите архивирование')">
                                                            <i class="fas fa-file-archive"></i>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.food.full.delete', ['id' => $food->id]) }}"
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
                                <p>Пунктов меню пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $foods->links('pagination::bootstrap-4') }}
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

