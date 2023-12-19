@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование заказа</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.orders.update', ['order' => $order->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Заказ от "{{ $order->name }}"</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="name">Имя</label>
                                            <input type="text" name="name"
                                                   class="form-control @error('name') is-invalid @enderror" id="name"
                                                   value="{{ $category->name }}">
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
