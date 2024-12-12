@if(session('warning'))
    <div id="warning-message" class="alert alert-warning">
        {{ session('warning') }}
    </div>
    <style>
        .alert {
            opacity: 1;
            transition: opacity 1s ease-out;
            text-align: center;
            color: red;
            font-weight: bold;
        }
    </style>
    <script>
        setTimeout(function() {
            var warningMessage = document.getElementById('warning-message');
            if (warningMessage) {
                warningMessage.style.transition = 'opacity 1s';
                warningMessage.style.opacity = 0;
                setTimeout(function() {
                    warningMessage.style.display = 'none';
                }, 1000); // Chờ 1 giây để hoàn thành hiệu ứng mờ dần
            }
        }, 3000); // 3000ms = 3 giây
    </script>
@endif

<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> {{ getConfigValueSettingtable('phone') }} </a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> {{ getConfigValueSettingtable('Email') }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="/eshopper/images/logo.png" alt=""/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ route('cart.show') }}">
                                    <i class="fa fa-shopping-cart"></i> Cart
                                    <span id="cart-count" class="badge" style="background-color: red; color: white; border-radius: 50%; padding: 2px 6px; font-size: 12px;">

        </span>
                                </a>
                            </li>
                            @if(Auth::check())
                                <li><a href="#"><i class="fa fa-user"></i>Hello! {{ Auth::user()->name }}</a></li>
                                <li><a href="{{ route('orders.index') }}"><i class="fa fa-list"></i> Đơn hàng của tôi</a></li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa fa-lock"></i> Logout
                                    </a>
                                </li>
                            @else
                                <li><a href="{{ route('user.login') }}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    @include('components.main-menu')
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{ route('products.search') }}" method="GET" style="display: flex;">
                            <input type="text" name="query" placeholder="Search" required style="flex: 1; border-radius: 5px 0 0 5px; border: 1px solid #ccc;" />
                            <button type="submit" style="border-radius: 0 5px 5px 0; border: 1px solid #ccc; background-color: #B2B2B2; color: white;">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->
