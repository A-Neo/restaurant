@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование алгоритма</h1>
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
                            <h3 class="card-title">Редактирование - (Сумма товаров - sum, Расстояние от ресторана - dis)</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post" action="{{ route('admin.algoritms.update', ['algoritm' => $algoritm->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="y1">Расстояние (y1)</label>
                                            <input type="text" name="y1"
                                                   class="form-control @error('y1') is-invalid @enderror" id="y1"
                                                   placeholder="y1" value="{{ $algoritm->y1 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="y2">Расстояние (y2)</label>
                                            <input type="text" name="y2"
                                                   class="form-control @error('y2') is-invalid @enderror" id="y2"
                                                   placeholder="y2" value="{{ $algoritm->y2 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="y3">Расстояние (y3)</label>
                                            <input type="text" name="y3"
                                                   class="form-control @error('y3') is-invalid @enderror" id="y3"
                                                   placeholder="y3" value="{{ $algoritm->y3 }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="x1">Сумма в корзине (x1)</label>
                                            <input type="text" name="x1"
                                                   class="form-control @error('x1') is-invalid @enderror" id="x1"
                                                   placeholder="x1" value="{{ $algoritm->x1 }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="x2">Сумма в корзине (x2)</label>
                                            <input type="text" name="x2"
                                                   class="form-control @error('x2') is-invalid @enderror" id="x2"
                                                   placeholder="x2" value="{{ $algoritm->x2 }}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z1">1) Если: sum > x1  ||  dis < y1</label>
                                            <input type="text" name="z1"
                                                   class="form-control @error('z1') is-invalid @enderror" id="z1"
                                                   placeholder="z1" value="{{ $algoritm->z1 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z2">2) Если: sum < x1  ||  dis < y1</label>
                                            <input type="text" name="z2"
                                                   class="form-control @error('z2') is-invalid @enderror" id="z2"
                                                   placeholder="z2" value="{{ $algoritm->z2 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z3">3) Если: sum < x1  ||  dis < y2</label>
                                            <input type="text" name="z3"
                                                   class="form-control @error('z3') is-invalid @enderror" id="z3"
                                                   placeholder="z3" value="{{ $algoritm->z3 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z4">4) Если: x1 < sum < x2  ||  dis < y2</label>
                                            <input type="text" name="z4"
                                                   class="form-control @error('z4') is-invalid @enderror" id="z4"
                                                   placeholder="z4" value="{{ $algoritm->z4 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z5">5) Если: sum > x2  ||  dis < y2</label>
                                            <input type="text" name="z5"
                                                   class="form-control @error('z5') is-invalid @enderror" id="z5"
                                                   placeholder="z5" value="{{ $algoritm->z5 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z6">6) Если: sum < x1  ||  dis < y3</label>
                                            <input type="text" name="z6"
                                                   class="form-control @error('z6') is-invalid @enderror" id="z6"
                                                   placeholder="z6" value="{{ $algoritm->z6 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z7">7) Если: x1 < sum < x2  ||  dis < y3</label>
                                            <input type="text" name="z7"
                                                   class="form-control @error('z7') is-invalid @enderror" id="z7"
                                                   placeholder="z7" value="{{ $algoritm->z7 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z8">8) Если: sum > x2  ||  dis < y3</label>
                                            <input type="text" name="z8"
                                                   class="form-control @error('z8') is-invalid @enderror" id="z8"
                                                   placeholder="z8" value="{{ $algoritm->z8 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z9">9) Если: sum < x1  ||  dis > y3</label>
                                            <input type="text" name="z9"
                                                   class="form-control @error('z9') is-invalid @enderror" id="z9"
                                                   placeholder="z9" value="{{ $algoritm->z9 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z10">10) Если: x1 < sum < x2  ||  dis > y3</label>
                                            <input type="text" name="z10"
                                                   class="form-control @error('z10') is-invalid @enderror" id="z10"
                                                   placeholder="z10" value="{{ $algoritm->z10 }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="z11">11) Если: sum > x2  ||  dis > y3</label>
                                            <input type="text" name="z11"
                                                   class="form-control @error('z11') is-invalid @enderror" id="z11"
                                                   placeholder="z11" value="{{ $algoritm->z11 }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

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
