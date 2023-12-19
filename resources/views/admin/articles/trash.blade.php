@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Архив</h1>
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
                            <h3 class="card-title">Архив</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if (count($items))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 80px">ID</th>
                                            <th>Наименование (RU)</th>
                                            <th>Порядковый номер</th>
                                            <th style="width: 120px">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>{{ $item->title_ru }}</td>
                                                <td>{{ $item->title_en }}</td>
                                                <td>
                                                    <form
                                                        action="{{ route('admin.article.restore', ['id' => $item->id]) }}"
                                                        method="post" class="float-left">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                                onclick="return confirm('Подтвердите восстановление')">
                                                            <i class="fas fa-trash-restore"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Архив пуст...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
{{--                        <div class="card-footer clearfix">--}}
{{--                            {{ $articles->links('pagination::bootstrap-4') }}--}}
{{--                        </div>--}}
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

