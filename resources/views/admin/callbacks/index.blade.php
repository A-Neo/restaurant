@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Бронь</h1>
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
                            <h3 class="card-title">Все заявки</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($callbacks))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 80px">ID</th>
                                            <th>Имя</th>
                                            <th>Телефон</th>
                                            <th>Тип</th>
                                            <th>Статус</th>
                                            <th style="width: 120px">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($callbacks as $callback)
                                            <tr>
                                                <td>{{ $callback->id }}</td>
                                                <td>{{ $callback->name }}</td>
                                                <td>{{ $callback->phone }}</td>
                                                <td>@if($callback->type == 1) Бронь стола @elseif($callback->type == 2) Бронь банкета @endif</td>
                                                <td>@if($callback->status == 0) В процессе @else Готово @endif</td>
                                                <td>
                                                    <a href="{{ route('admin.callbacks.edit', ['callback' => $callback->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('admin.callbacks.destroy', ['callback' => $callback->id]) }}"
                                                        method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                            <i
                                                                class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Заявок пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $callbacks->links('pagination::bootstrap-4') }}
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

