@extends('layouts.app')
@section('title','product show')

@section('content')



<div class="cart-overlay"></div>






<div class="product-section section mt-60 mb-20">
    <div class="container">

        <div class="row mb-90">

            <div class="col-lg-6 col-12 mb-50">

                <!-- Image -->
                <div class="">

                    <div class="image">
                        @if($product->images->Count() >0 )

                        <h1 class="title">Images</h1>

                        <div class="row">
                            @foreach ($product->images as $image)

                            <div class="col-md-12">
                                    <img width="100%"src=" {{ $image->photo ?? asset('front/assets/images/product/product-1.png') }}" style="margin-bottom: 11px;"
                                    alt="Product Image" height="230px !important">
                            </div>

                            @endforeach
                        </div>
                        @else
                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                        id="type-error">لا يوجد صور
                           </button>

                        @endif


                    </div>

                </div>
                <!-- Image -->


            </div>

            <div class="col-lg-6 col-12 mb-50">

                <!-- Content -->
                <div class="single-product-content">

                    <!-- Category & Title -->
                    <div class="head-content">

                        <div class="category-title">

                            <h5 class="title">{{  $product->name  ?? '--'}}</h5>
                        </div>


                        <h5 class="price">
                            @if (   $product->special_price )
                                <span class="old">${{ round(  $product->price,2) }}</span>
                            @endif
                            ${{ $product->special_price !=0 ? round($product->special_price,2) :  round($product->price,2) }}

                        </h5>

                    </div>

                    <div class="single-product-description">

                        <div class="ratting">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                        </div>

                        <div class="desc">
                            <p>
                                    @if($product->description)
                                         {{ $product->description}}
                                    @elseif ($product->description ==null && $product->short_description != null )
                                  {{  $product->short_description}}
                                    @else
                                        ''
                                    @endif

                            </p>
                        </div>
                        <hr>
                        <h5>
                            viewed: <span>{{ $product->viewed }}</span>
                        </h5>

                        <h5 >
                            In Stock :
                            @if(  $product->in_stock == 1  )
                                 <span>Availability</span>
                                @if(  $product->manage_stock == 1  )

                            <h5 >Is available : <span>{{ $product->qty }}</span></h5>

                                 @endif

                            @else
                               <span  >Not Availability</span>

                            @endif
                        </h5>

                        <hr>

                        <div class="quantity-colors">


                            @if(isset($product_attributes) && count($product_attributes) > 0 )
                            @foreach($product_attributes as $attribute)
                            <div class="colors">
                                <h5>{{$attribute->name}}</h5>
                                @if(isset($attribute->option) && count($attribute->option) > 0 )
                                    <select class="nice-select" name="{{$attribute->name}}">
                                        @foreach($attribute->option as $option)
                                          <option value="{{$option->id}}"> {{$option->name}}</option>
                                          @endforeach
                                    </select>
                                    @endif

                                </div>
                            @endforeach
                        @endif
                        </div>

                        <div class="quantity-colors">
                            <div class="quantity">
                                <h5>Quantity</h5>
                                <div class="pro-qty"><span class="dec "></span><input type="text" value="1"><span class="inc "></span></div>
                                {{-- qtybtn --}}
                            </div>
                        </div>

                        <div class="actions">

                            <a href="#" class="add-to-cart"><i class="ti-shopping-cart"></i><span>ADD TO CART</span></a>

                            <div class="wishlist-compare">
                                {{-- <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a> --}}
                                <a href="#" class="addToWishlist @if(auth('web')->user()->wishlistHas($product->id)) added @endif" data-tooltip="Wishlist" data-product-id="{{$product->id}}"><i class="ti-heart"></i></a>
                            </div>

                        </div>

                        <div class="tags">

                            <h5>Tags:</h5>
                            @foreach ($product->tags as $tag)

                            <a href="#">{{  $tag->name}}</a>

                            @endforeach

                        </div>

                        <div class="tags">

                            <h5>Brand:</h5>

                            <a href="#">{{  $product->Brand->name ?? '-'}}</a>


                        </div>

                        <div class="share">

                            <h5>Share: </h5>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-10 col-12 ml-auto mr-auto">

                <ul class="single-product-tab-list nav">
                    {{-- <li><a href="#product-description" class="active" data-toggle="tab">description</a></li>
                    <li><a href="#product-specifications" data-toggle="tab">specifications</a></li> --}}
                    <li><a href="#product-reviews" data-toggle="tab">reviews</a></li>
                </ul>

                <div class="single-product-tab-content tab-content">
                    {{-- <div class="tab-pane fade show active" id="product-description">

                        <div class="row">
                            <div class="single-product-description-content col-lg-8 col-12">
                                <h4>Introducing Flex 3310</h4>
                                <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora in</p>
                                <h4>Stylish Design</h4>
                                <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli</p>
                                <h4>Digital Camera, FM Radio &amp; many more...</h4>
                                <p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli</p>
                            </div>
                            <div class="single-product-description-image col-lg-4 col-12">
                                <img src="{{asset('/')}}front/assets/images/single-product/description.png" alt="description">
                            </div>
                        </div>

                    </div> --}}
                    {{-- <div class="tab-pane fade" id="product-specifications">
                        <div class="single-product-specification">
                            <ul>
                                <li>Full HD Camcorder</li>
                                <li>Dual Video Recording</li>
                                <li>X type battery operation</li>
                                <li>Full HD Camcorder</li>
                                <li>Dual Video Recording</li>
                                <li>X type battery operation</li>
                            </ul>
                        </div>
                    </div> --}}
                    <div class="tab-pane fade show active" id="product-reviews">

                        <div class="product-ratting-wrap">
							<div class="pro-avg-ratting">
								<h4>4.5 <span>(Overall)</span></h4>
								<span>Based on 9 Comments</span>
							</div>
							<div class="ratting-list">
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<span>(5)</span>
								</div>
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<span>(3)</span>
								</div>
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<span>(1)</span>
								</div>
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<span>(0)</span>
								</div>
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<span>(0)</span>
								</div>
							</div>
							<div class="rattings-wrapper">

								<div class="sin-rattings">
									<div class="ratting-author">
										<h3>Cristopher Lee</h3>
                                        <div class="ratting-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span>(5)</span>
                                        </div>
									</div>
									<p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli</p>
								</div>

								<div class="sin-rattings">
									<div class="ratting-author">
										<h3>Nirob Khan</h3>
                                        <div class="ratting-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span>(5)</span>
                                        </div>
									</div>
									<p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli</p>
								</div>

								<div class="sin-rattings">
									<div class="ratting-author">
										<h3>MD.ZENAUL ISLAM</h3>
                                        <div class="ratting-star">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span>(5)</span>
                                        </div>
									</div>
									<p>enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia res eos qui ratione voluptatem sequi Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci veli</p>
								</div>

							</div>
							<div class="ratting-form-wrapper fix">
								<h3>Add your Comments</h3>
								<form action="#">
								    <div class="ratting-form row">
										<div class="col-12 mb-15">
											<h5>Rating:</h5>
											<div class="ratting-star fix">
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
												<i class="fa fa-star-o"></i>
											</div>
										</div>
										<div class="col-md-6 col-12 mb-15">
                                            <label for="name">Name:</label>
                                            <input id="name" placeholder="Name" type="text">
										</div>
										<div class="col-md-6 col-12 mb-15">
                                            <label for="email">Email:</label>
                                            <input id="email" placeholder="Email" type="text">
										</div>
										<div class="col-12 mb-15">
											<label for="your-review">Your Review:</label>
											<textarea name="review" id="your-review" placeholder="Write a review"></textarea>
										</div>
										<div class="col-12">
											<input value="add review" type="submit">
										</div>
								    </div>
								</form>
							</div>
						</div>

                    </div>
                </div>

            </div>

        </div>

    </div>
</div>


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
                   {{-- $( ".addToWishlist" ).closest(".ee-product-list").remove();
                   css( "display", "none" ) --}}
                }
            }
        });
    });
</script>

@endsection
