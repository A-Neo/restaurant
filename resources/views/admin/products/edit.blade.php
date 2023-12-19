@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование блюда</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form role="form" method="post" action="{{ route('admin.products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card card-primary card-outline card-tabs">
                            <div class="card-header">
                                <h3 class="card-title">Блюдо "{{ $product->title_ru }}"</h3>
                            </div>
                            <div class="card-header p-0 pt-1 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Русский</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">English</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-three-attr-tab" data-toggle="pill" href="#custom-tabs-three-attr" role="tab" aria-controls="custom-tabs-three-attr" aria-selected="true">Атрибуты</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                        <div class="form-group">
                                            <label for="title_ru">Название на русском</label>
                                            <input type="text" name="title_ru"
                                                   class="form-control @error('title_ru') is-invalid @enderror" id="title_ru"
                                                   value="{{ $product->title_ru }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="describe_ru">Краткое описание на русском</label>
                                            <textarea name="describe_ru" class="form-control @error('describe_ru') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="describe_ru">{{ $product->describe_ru }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_ru">Состав и аллергены на русском</label>
                                            <textarea name="description_ru" class="form-control @error('description_ru') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="description_ru">{{ $product->description_ru }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                        <div class="form-group" id="content_en_text">
                                            <label for="title_en">Название на английском</label>
                                            <input type="text" name="title_en"
                                                   class="form-control @error('title_en') is-invalid @enderror" id="title_en"
                                                   value="{{ $product->title_en }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="describe_en">Краткое описание на английском</label>
                                            <textarea name="describe_en" class="form-control @error('describe_en') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="describe_en">{{ $product->describe_en }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="description_en">Состав и аллергены на английском</label>
                                            <textarea name="description_en" class="form-control @error('description_en') is-invalid @enderror" rows="3" placeholder="Тескт ..." id="description_en">{{ $product->description_en }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-three-attr" role="tabpanel" aria-labelledby="custom-tabs-three-attr-tab">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="mb-0">Атрибуты</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            @foreach($attributes as $item)
                                                <div class="col-3">
                                                    <label for="meta-keywords">{{ $item->title_ru }}</label>
                                                    <input type="text" name="attribute[{{$item->id}}]"
                                                           class="form-control @error("attribute[{{$item->id}}]") is-invalid @enderror" id="attribute_{{$item->id}}"
                                                           placeholder="Атрибут - {{ $item->title_ru }}"
                                                           @foreach($product_attributes as $attr)
                                                           @if($attr->pivot->attribute_id == $item->id)
                                                           value="{{$attr->pivot->value}}"
                                                        @endif
                                                        @endforeach
                                                    >
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category">Категория</label>
                                    <select name="categories[]" id="category" class="select2" multiple="multiple" data-placeholder="Выберите категорию" style="width: 100%;">
                                        <optgroup label="Еда">
                                            @foreach($foods as $k => $v)
                                                <option value="{{ $v->id }}"
                                                    @if($v->id == $product->categories->contains($v->id))
                                                        selected
                                                    @endif
                                                >{{ $v->title_ru }}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="Напитки">
                                            @foreach($beverages as $k => $v)
                                                <option value="{{ $v->id }}"
                                                    @if($v->id == $product->categories->contains($v->id))
                                                        selected
                                                    @endif
                                                >{{ $v->title_ru }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Основное изображение</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="image" type="file" class="custom-file-input" id="image">
                                            <label class="custom-file-label" for="image">Добавить одно основное изображение</label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="d-flex mt-3" style="align-items: center;justify-content: space-between">
                                        @if($product->image)
                                            <p class="mb-0">
                                                <img style="width:50px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$product->image"))) }}" alt="{{$product->title}}">
                                                <span>{{ str_replace('\\', '/', asset(trim("uploads/$product->image"))) }}</span>
                                            </p>
                                        @else
                                            <p class="mb-0">Основное изображение - не заполнено</p>
                                        @endif
                                    </div>
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <label for="image">Дополнительные изображения</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input name="images[]" type="file" class="custom-file-input" id="images" multiple>
                                            <label class="custom-file-label" for="images">Добавить много дополнительных изображений</label>
                                        </div>
                                    </div>
                                    <hr>
                                    @foreach($product->images as $image)
                                        <div class="d-flex" style="align-items: center;justify-content: space-between">
                                            <p class="mb-0">
                                                <img style="width:50px;margin-right:10px;border: 2px solid #ddd;padding:2px;" src="{{ str_replace('\\', '/', asset(trim("uploads/$image->image"))) }}" alt="{{$product->title}}">
                                                <span>{{ str_replace('\\', '/', asset(trim("uploads/$image->image"))) }}</span>
                                            </p>
                                            <a class="btn btn-danger btn-sm" href="{{ route('admin.products.destroy.images', ['id' => $image->id]) }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="weight">Вес (в граммах)</label>
                                    <input type="text" name="weight"
                                           class="form-control @error('weight') is-invalid @enderror" id="weight"
                                           value="{{ $product->weight }}">
                                </div>
                                <div class="form-group">
                                    <label for="price">Цена</label>
                                    <input type="number" name="price"
                                           class="form-control @error('price') is-invalid @enderror" id="price"
                                           value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="order">Порядковый номер</label>
                                    <input type="number" name="order"
                                           class="form-control @error('order') is-invalid @enderror" id="order"
                                           value="{{ $product->order }}">
                                </div>
                                <div class="form-group">
                                    <label for="delivery">Доставка</label>
                                    <select name="delivery" id="delivery" class="form-control"style="width: 100%;">
                                        <option value="0" @if($product->delivery == 0) selected @endif>Нет</option>
                                        <option value="1" @if($product->delivery == 1) selected @endif>Да</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="meta_title">Мета-заголовок</label>
                                    <input type="text" name="meta_title"
                                           class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                                           value="{{ $product->meta_title }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Мета-описание</label>
                                    <input type="text" name="meta_description"
                                           class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                           value="{{ $product->meta_description }}">
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Мета-ключи <small>(через запятую)</small></label>
                                    <input type="text" name="meta_keywords"
                                           class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords"
                                           value="{{ $product->meta_keywords }}">
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
