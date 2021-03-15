@extends('layouts.app')
@section('title','Wishlists')

@section('content')


<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <div class="page-banner">
                    <h1>products</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">HOME</a></li>
                            <li><a href="{{ route('Wishlists.index') }}">All Wishlists</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
@if($products->Count() >0 )

<div class="product-section section mt-10 mb-10">
    <div class="container">
        <div class="row">

            @if($products->Count() >0)
            <div class="col-12">


                <!-- Shop Product Wrap Start -->
                <!-- Shop Product Wrap Start -->
                <div class="shop-product-wrap list row">
                    @foreach ($products as $product)

                    <div class="col-xl-3 col-lg-4 col-md-6 col-12 pb-30 pt-10">


                        <!-- Product List Start -->
                        <div class="ee-product-list">

                            <!-- Image -->
                            <div class="image">
                                @if (   $product->special_price )
                                <span class="label sale">sale</span>
                            @elseif( $product->special_price ==0 && $product->viewed <10 )
                                <span class="label new">new</span>
                            @endif
                                <a href="{{ route('product.show', $product->slug) }}" class="img"><img src="{{ $product->Images[0]->photo ?? asset('front/assets/images/product/product-1.png') }}" alt="Product Image" height="230px !important"></a>

                            </div>

                            <!-- Content -->
                            <div class="content">

                                <!-- Category & Title -->
                                <div class="head-content">

                                    <div class="category-title">
                                        {{-- <a href="#" class="cat">{{  $product->name  ?? '--'}}</a> --}}
                                        <h5 class="title"><a href="{{ route('product.show', $product->slug) }}"> {{  $product->name  ?? '--'}}</a></h5>
                                    </div>

                                    <h5 class="price">
                                        @if (   $product->special_price )
                                          <span class="old">${{ round(  $product->price,2) }}</span>
                                        @endif
                                        ${{ $product->special_price !=0 ? round($product->special_price,2) :  round($product->price,2) }}

                                    </h5>
                                </div>

                                <div class="left-content">

                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>

                                    <div class="desc">
                                        <p> {{  $product->short_description  ?? ' '}}</p>
                                    </div>

                                    <div class="actions">

                                        <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                                        <div class="wishlist-compare">
                                            <a href="#" class="addToWishlist @if(auth('web')->user()->wishlistHas($product->id)) added @endif" data-tooltip="Wishlist" data-product-id="{{$product->id}}"><i class="ti-heart"></i></a>
                                        </div>

                                    </div>

                                </div>

                                <div class="right-content">
                                    {{-- <div class="specification">
                                        <h5>Specifications</h5>
                                        <ul>
                                            <li>Intel Core i7 Processor</li>
                                            <li>Zeon Z 170 Pro Motherboad</li>
                                            <li>16 GB RAM</li>
                                        </ul>manage_stock
                                    </div> --}}
                                    <span class="availability">
                                        viewed: <span>{{ $product->viewed }}</span>
                                    </span>
                                    <br>
                                    <span class="availability">
                                        In Stock :
                                        @if(  $product->in_stock == 1  )
                                             <span>Availability</span>
                                    <br>

                                            @if(  $product->manage_stock == 1  )

                                        <span class="availability">Quantity: <span>{{ $product->qty }}</span></span>
                                    <br>

                                             @endif

                                        @else
                                           <span>Not Availability</span>

                                        @endif
                                    </span>
                                </div>

                            </div>

                        </div><!-- Product List End -->

                    </div>
                    @endforeach

                </div><!-- Shop Product Wrap End -->
                <div class="row mt-30">
                    <div class="col">

                        <ul class="pagination">
                        {{ $products->links()  }}

                            {{-- <li><a href="#"><i class="fa fa-angle-left"></i>Back</a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li> - - - - - </li>
                            <li><a href="#">18</a></li>
                            <li><a href="#">18</a></li>
                            <li><a href="#">20</a></li>
                            <li><a href="#">Next<i class="fa fa-angle-right"></i></a></li> --}}
                        </ul>

                    </div>
                </div>

            </div>
            @else
            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                        id="type-error">لا يوجد منتاجات
                           </button>
            @endif


        </div>
    </div>
</div>

@else
<button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
            id="type-error">لا يوجد منتاجات
               </button>
@endif

<button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2 Nullproduct"
            id="type-error" style="display: none">لا يوجد منتاجات
               </button>



@endsection



@section('js')
/*--
    Product View Mode
------------------------*/
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.addToWishlist', function (e) {
        e.preventDefault();


        $.ajax({
            type: 'post',
            url: "{{Route('Wishlists.store')}}",
            data: {
                'productId': $(this).attr('data-product-id'),
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                if(data.wished ){
                    $('#wishlistNumber').text(Number($('#wishlistNumber').text())+1);
                     $('.addToWishlist').addClass('active');
                  }
                else{
                    $('#wishlistNumber').text(Number($('#wishlistNumber').text()) -1);
                   $('.addToWishlist').removeClass('active');
                    if( Number($('#wishlistNumber').text())  == 0 ){
                        $('.product-section').remove();
                        $('.Nullproduct').css('display','block');
                    }

                }
            }
        });
    });
</script>

@endsection
