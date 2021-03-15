<!-- Header Bottom Start -->
<div class="header-bottom header-bottom-one header-sticky">
    <div class="container">
        <div class="row align-items-center justify-content-between">

            <div class="col mt-15 mb-15">
                <!-- Logo Start -->
                <div class="header-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{asset('/front/')}}/assets/images/logo.png" alt="E&E - Electronics eCommerce Bootstrap4 HTML Template">
                        <img class="theme-dark" src="{{asset('/front/')}}/assets/images/logo-light.png" alt="E&E - Electronics eCommerce Bootstrap4 HTML Template">
                    </a>
                </div><!-- Logo End -->
            </div>

            <div class="col order-12 order-lg-2 order-xl-2 d-none d-lg-block">
                <!-- Main Menu Start -->
                <div class="main-menu">
                    <nav>
                        <ul>
                            <li class="active"><a href="{{ route('home') }}">HOME</a></li>
                            <li class="menu-item-has-children"><a href="{{ route('products.index','Allproducts')   }}">Shop</a>

                                <ul class="sub-menu">
                                    @foreach ($categories as $category1)

                                    <li class="menu-item-has-children"><a href="{{ route('products.index',$category1->slug)   }}">{{ $category1->name }}</a>
                                        @if($category1->childrens->Count() >0 )
                                        <ul class="sub-menu">
                                            @foreach ($category1->childrens as $category2)

                                            <li class="menu-item-has-children">
                                                <a href="{{ route('products.index',$category2->slug)   }}">{{ $category2->name }}</a>
                                                @if($category2->childrens->Count() >0 )
                                                <ul class="sub-menu">
                                                    @foreach ($category2->childrens as $category3)
                                                    <li class="menu-item-has-children">
                                                        <a href="{{ route('products.index',$category3->slug)   }}">{{ $category3->name }}</a>
                                                    </li>
                                                    @endforeach

                                                </ul>
                                                @endif
                                            </li>

                                              @endforeach


                                        </ul>
                                        @endif

                                    </li>
                                    @endforeach

                                </ul>

                            </li>
                            @auth('web')
                            <li><a href="{{ route('Wishlists.index') }}">Wishlists</a></li>
                            @endauth

                            <li><a href="{{ route('Contacts') }}">CONTACT Us</a></li>
                        </ul>
                    </nav>
                </div><!-- Main Menu End -->
            </div>

            <div class="col order-2 order-lg-12 order-xl-12">
                <!-- Header Shop Links Start -->
                <div class="header-shop-links">

                    <!-- Compare -->
                    {{-- <a href="compare.html" class="header-compare"><i class="ti-control-shuffle"></i></a> --}}
                    @auth('web')

                    <!-- Wishlist -->
                    <a href="{{ route('Wishlists.index') }}" class="header-wishlist"><i class="ti-heart"></i> <span class="number" id='wishlistNumber' value='{{ auth('web')->user()->wishlist->Count() }}'>{{ auth('web')->user()->wishlist->Count() }}</span></a>
                    {{-- {{ auth('web')->user()->wishlist()->Count() }} --}}
                    <!-- Cart -->
                    <a href="cart.html" class="header-cart"><i class="ti-shopping-cart"></i> <span class="number">3</span></a>
                    @endauth

                </div><!-- Header Shop Links End -->
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu order-12 d-block d-lg-none col"></div>

        </div>
    </div>
</div><!-- Header Bottom End -->

<!-- Header Category Start -->
<div class="header-category-section">
    <div class="container">
        <div class="row">
            <div class="col">

                <!-- Header Category -->
                <div class="header-category">

                    <!-- Category Toggle Wrap -->
                    <div class="category-toggle-wrap d-block d-lg-none">
                        <!-- Category Toggle -->
                        <button class="category-toggle">Categories <i class="ti-menu"></i></button>
                    </div>

                    <!-- Category Menu -->
                    <nav class="category-menu" style="float: right;">
                        <ul>
                            @foreach ($categories as $category)
                             <li><a href="{{ route('products.index',$category->slug)   }}">{{ $category->name }}</a></li>
                            @endforeach

                        </ul>
                    </nav>

                </div>

            </div>
        </div>
    </div>
</div><!-- Header Category End -->

</div><!-- Header Section End -->
