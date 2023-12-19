<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dedi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
    <link rel="icon" href="{{ $setting->getImageLogo() }}" type="image/x-icon">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}" role="button">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ url('/') }}" target="_blank" class="brand-link">
            <img src="{{ asset('assets/admin/img/AdminLTELogo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">На сайт</span>
        </a>
        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="align-items: center">
                <div class="image">
                    <img src="{{ asset('assets/admin/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                         alt="User Image">
                </div>
                <div class="info">
                    <span class="d-block text-uppercase" style="color: #fff;line-height: 100%;"><b>Family Name</b></span>
                    <span class="d-block" style="color: #fff;line-height: 100%;"><small>e-mail@mail.ru</small></span>
                </div>
            </div>
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-solar-panel"></i>
                            <p>Панель управления</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-hamburger"></i>
                            <p>
                                Еда
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.foods.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Основные пункты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.type', ['type' => 0]) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Категории</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cocktail"></i>
                            <p>
                                Напитки
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.beverages.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Основные пункты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.categories.type', ['type' => 1]) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Категории</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-birthday-cake"></i>
                            <p>
                                Позиции
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.products.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Основные пункты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.product.only') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Архив</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Главная страница
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.banners.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Баннер</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.abouts.edit', ['about' => 1]) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Блок - О нас</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.additions.edit', ['addition' => 1]) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Блок - Лояльность</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.reservations.edit', ['reservation' => 1]) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Блок - Бронь стола</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.chefs.edit', ['chef' => 1]) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Блок - Шэф-повар</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.reviews.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Отзывы</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.rubrics.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-bookmark"></i>
                            <p>Рубрики</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-newspaper"></i>
                            <p>
                                Статьи
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.articles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Основные пункты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.article.only') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Архив</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.orders.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>Заказы</p>
                        </a>
                    </li>


                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-scroll"></i>
                            <p>
                                Страницы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.pages.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Основные пункты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.page.only') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Архив</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-birthday-cake"></i>
                            <p>
                                Мероприятие
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                            <li class="nav-item">
                                <a href="{{ route('admin.banquets.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Основные пункты</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.banquet.only') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Архив</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item">
                        <a href="{{ route('admin.callbacks.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>Бронь</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.messages.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>Сообщения</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.settings.edit', ['setting' => 1]) }}" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Настройки</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Доступ
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.algoritms.edit', ['algoritm' => 1]) }}" class="nav-link">
                            <i class="nav-icon fas fa-square-root-alt"></i>
                            <p>Алгоритм</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.deliveries.index') }}" class="nav-link">
                            <i class="nav-icon"></i>
                            <p>Зоны доставки</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">

        <div class="content-header">
            @if ($errors->any())
                <div class="alert alert-danger mt-2 mb-2">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success mt-2 mb-2">
                    {{ session('success') }}
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger mt-2 mb-2">
                    {{ session('error') }}
                </div>
            @endif
        </div>

        @yield('content')
    </div>

    <footer class="main-footer">
        <strong>Copyright &copy; {{ date("Y") }} | {{ request()->getHost() }}</strong>
    </footer>
</div>

<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
<script>
    $('.nav-sidebar a').each(function () {
        let location = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if (link == location) {
            $(this).addClass('active');
            $(this).closest('.has-treeview').addClass('menu-open');
        }
    });
</script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
<script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/admin/ckfinder/ckfinder.js') }}"></script>
<script src="{{ asset('assets/admin/AjexFileManager/ajex.js') }}"></script>

@stack('scripts')
@stack('style')
</body>
</html>
