@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
     <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 mb-3">
                    @if($s)
                        <div style="display:flex;align-items: center;flex-direction: row-reverse;justify-content: flex-end;"><h1>Поиск по наименованию - "{{ $s }}"</h1>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-danger btn-sm" style="margin-top: 3px;margin-right:10px">✕</a>
                        </div>
                    @else
                        <h1>Позиции</h1>
                    @endif
                </div>
                <div class="col-sm-12">
                    <form action="{{ route('admin.products.search') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="search" name="s" class="form-control form-control-lg" placeholder="Поиск по наименованию" @if($s) value="{{ $s }}" @endif>
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
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
                            <h3 class="card-title">Все позиции</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">Добавить
                                позицию</a>
                            @if (count($products))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 80px">ID</th>
                                            <th>Наименование (RU)</th>
                                            <th>Наименование (EN)</th>
                                            <th>Порядковый номер</th>
                                            <th style="width: 94px;">Доставка</th>
                                            <th style="width: 160px">Действие</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->title_ru }}</td>
                                                <td>{{ $product->title_en }}</td>
                                                <td>{{ $product->order }}</td>
                                                <td>
                                                    <input type="checkbox" @if($product->delivery == 1) checked @endif name="delivery" class="delivery" data-id="{{ $product->id }}" style="width: 15px;height: 15px;display: block;margin: 10px auto 0;">
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                                       class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"
                                                        method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-warning btn-sm"
                                                                onclick="return confirm('Подтвердите архивирование')">
                                                            <i class="fas fa-file-archive"></i>
                                                        </button>
                                                    </form>
                                                    <form
                                                        action="{{ route('admin.product.full.delete', ['id' => $product->id]) }}"
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
                                <p>Позиций пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $products->links('pagination::bootstrap-4') }}
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
@push('scripts')
    <script>
        $('.delivery').on('click', function (){
            let id = $(this).attr('data-id');
            let value = null;

            if(!$(this).prop('checked')) {
                $(this).prop('checked', false);
                value = 0;
            } else {
                $(this).prop('checked', true);
                value = 1;
            }

            $.ajax({
                url: "{{ route('admin.products.delivery') }}",
                data: {
                    id: id,
                    value: value
                },
                success: function(data) {
                    return data;
                }
            });
            //return false; //for good measure)
            return true;
        });
    </script>
@endpush
