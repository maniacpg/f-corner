<div class="mainmenu pull-left">
    <ul class="nav navbar-nav collapse navbar-collapse">
        <li><a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ route('product.show') }}" class="{{ request()->is('product') ? 'active' : '' }}">Sản phẩm</a></li>
    </ul>
</div>
