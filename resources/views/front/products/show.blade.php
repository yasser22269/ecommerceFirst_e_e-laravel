@extends('layouts.app')
@section('title','product show')
@section('css')
<style>
    .rating {
        float:left;
        margin-top: -5px;
      }
      .rating:not(:checked) > input {
          position:absolute;
          clip:rect(0,0,0,0);
      }

      .rating:not(:checked) > label {
          float:right;
          width:1em;
          /* padding:0 .1em; */
          overflow:hidden;
          white-space:nowrap;
          cursor:pointer;
          font-size: 26px;
          /* line-height:1.2; */
          color:#ddd;
      }

      .rating:not(:checked) > label:before {
          content: '★ ';
      }

      .rating > input:checked ~ label {
          color: dodgerblue;

      }

      .rating:not(:checked) > label:hover,
      .rating:not(:checked) > label:hover ~ label {
          color: dodgerblue;

      }

      .rating > input:checked + label:hover,
      .rating > input:checked + label:hover ~ label,
      .rating > input:checked ~ label:hover,
      .rating > input:checked ~ label:hover ~ label,
      .rating > label:hover ~ input:checked ~ label {
          color: dodgerblue;

      }

      .rating > label:active {
          position:relative;
          top:2px;
          left:2px;
      }


      .single-product-content .single-product-description .actions .add-to-cart {
        position: relative;
        background-color: #f5d730;
        color: #202020;
        border-radius: 50px;
        border: none;
        display: block;
        width: 170px;
        padding: 10px 22px 10px 54px;
        -webkit-transition: all 0.7s cubic-bezier(0.77, -1.5, 0.12, 3) 0s;
        -o-transition: all 0.7s cubic-bezier(0.77, -1.5, 0.12, 3) 0s;
        transition: all 0.7s cubic-bezier(0.77, -1.5, 0.12, 3) 0s;
        float: left;
        margin-right: 15px;
    }
</style>
@endsection
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
                            @if (   $product->Offer->special_price  )
                            {{-- && $product->special_price_end > now() --}}
                                <span class="old">${{ round(  $product->price,2) }}</span>
                            @endif
                            ${{ ($product->Offer->special_price !=0 ) ? round($product->Offer->special_price,2) :  round($product->price,2) }}


                        </h5>

                    </div>

                    <div class="single-product-description">


                        <div class="ratting">
                            @for ( $i=0;  $i<5 ; $i++)
                            @if ($i< round($countnum))
                            <i class="fa fa-star"></i>
                            @else
                            <i class="fa fa-star-o"></i>
                            @endif
                        @endfor
                        </div>

                        <div class="desc">
                            <p>
                                    @if($product->description)
                                         {{ $product->description}}
                                    @elseif ($product->description ==null && $product->short_description != null )
                                  {{  $product->short_description}}
                                    @else

                                    @endif

                            </p>
                        </div>
                        <hr>
                        <h5>
                            viewed: <span>{{ $product->viewed }}</span>
                        </h5>

                        <h5 >
                            In Stock :
                            @if(  $product->ManageStock->in_stock == 1  )
                                 <span>Availability</span>
                                @if(  $product->ManageStock->manage_stock == 1  )

                            <h5 >Is available : <span>{{ $product->ManageStock->qty }}</span></h5>

                                 @endif

                            @else
                               <span  >Not Availability</span>

                            @endif
                        </h5>

                        <hr>
                        <form id="cartstore" action="{{ route('site.cart.store',$product->id) }}">
                        <div class="quantity-colors">


                            @if(isset($product_attributes) && count($product_attributes) > 0 )
                            @foreach($product_attributes as $attribute)
                            <div class="colors" style="width: 47%;margin: 0 8px 10px 0;">
                                <h5>{{$attribute->name}}</h5>
                                @if(isset($attribute->option) && count($attribute->option) > 0 )
                                    <select class="form-control" name="{{$attribute->name}}">
                                        @foreach($attribute->option as $option)
                                          <option value="{{$option->name}}"> {{$option->name}}</option>
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
                                <div class="pro-qty"><span class="dec "></span>
                                    <input id="QuantityNumber" type="text" value="1"><span class="inc "></span></div>
                                {{-- qtybtn --}}
                            </div>
                        </div>


                        <div class="actions" >


                            <div class="wishlist-compare">
                                {{-- <a href="#" data-tooltip="Compare"><i class="ti-control-shuffle"></i></a> --}}
                                <a href="#" class="addToWishlist
                                @if(auth('web')->user())
                                    @if(auth('web')->user()->wishlistHas($product->id))
                                    added
                                    @endif
                                @endif
                                  " data-tooltip="Wishlist" data-product-id="{{$product->id}}"><i class="ti-heart"></i></a>
                            </div>

                             {{-- <a href="#" data-cart-url="{{ route('site.cart.store',$product->id) }}" data-product-id="{{ $product->id }}" class="add-to-cart">
                                <i class="ti-shopping-cart">
                                </i><span>ADD TO CART</span>
                                </a> --}}
                                {{-- <button type="submit"  class="add-to-cart">
                                    <i class="ti-shopping-cart">
                                    </i><span>ADD TO CART</span>
                                </button> --}}

                                <div class="ratting-form" style="display: inline-block;margin-left: 21px;">
                                    <input type="submit" value="ADD TO CART" class="ratting-form">
                                </div>
                    </form>

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
								<h4>


                                    {{  round($countnum) }}


                                    <span>(Overall)</span></h4>
								<span>Based on {{   $Total_comments }}  Comments</span>
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
									<span>(4)</span>
								</div>
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<span>(3)</span>
								</div>
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<span>(2)</span>
								</div>
								<div class="sin-list float-left">
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<span>(1)</span>
								</div>
							</div>
							<div class="rattings-wrapper">
                            @if( $Total_comments !=0)

                                @foreach ($product->comment as $comment)
								<div class="sin-rattings">
									<div class="ratting-author">
										<h3>{{ $comment->name }}</h3>
                                        <div class="ratting-star">
                                            @for ( $i=0;  $i<5 ; $i++)
                                                @if ($i<$comment->rate)
                                                <i class="fa fa-star"></i>
                                                @else
                                                <i class="fa fa-star-o"></i>
                                                @endif
                                            @endfor

                                            <span>({{ $comment->rate }})</span>
                                        </div>
									</div>
									<p>{{ $comment->comment }}</p>
								</div>

                                @endforeach



                                @else
                                <div class="row mr-2 ml-2" >
                                        <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                                id="type-error">
                                                لا يوجد تعليقات
                                        </button>
                                </div>
                                @endif
							</div>



							<div class="ratting-form-wrapper fix">
                            <hr>

								<h3>Add your Comments</h3>
								<form action="{{ route('storeComment') }}" method="POST">
                                    @csrf
								    <div class="ratting-form row">

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="col-12 mb-15">
                                            <h5>Rating:</h5>
                                            <div class="rating">
                                              <input type="radio" id="star5" name="rate" value="5" />
                                              <label for="star5" title="Meh">5 stars</label>
                                              <input type="radio" id="star4" name="rate" value="4" />
                                              <label for="star4" title="Kinda bad">4 stars</label>
                                              <input type="radio" id="star3" name="rate" value="3" />
                                              <label for="star3" title="Kinda bad">3 stars</label>
                                              <input type="radio" id="star2" name="rate" value="2" />
                                              <label for="star2" title="Sucks big tim">2 stars</label>
                                              <input type="radio" id="star1" name="rate" value="1" />
                                              <label for="star1" title="Sucks big time">1 star</label>

                                            </div>
                                            @error('rate')
                                            <span class="text-danger"> {{$message}}</span>
                                           @enderror
                                        </div>


                                        <div class="col-md-6 col-12 mb-15">
                                            <label for="email">Email:</label>
                                            <input id="name" placeholder="Name" name='name' type="text">
                                            @error('name')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
										</div>
										<div class="col-md-6 col-12 mb-15">
                                            <label for="email">Email:</label>
                                            <input id="email" placeholder="Email" name='email' type="email">
                                            @error('email')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
										</div>
										<div class="col-12 mb-15">
											<label for="your-review">Your Review:</label>
											<textarea name="comment" id="your-review" placeholder="Write a review"></textarea>
                                            @error('comment')
                                            <span class="text-danger"> {{$message}}</span>
                                            @enderror
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
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{-- <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.pro-remove', function (e) {
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
                   css( "display", "none" )
                }
                if(data.error){
                    swal(data.error, "You clicked the button!", "error");
                }
            }
        });
    });
</script> --}}
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
                }

                if(data.error){
                    swal(data.error, "You clicked the button!", "error");
                }
            }
        });
    });
$(".slider").not('.slick-initialized').slick();
</script>




<script>
    {{-- $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); --}}
    $('#cartstore').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: {
               'options': $( this ).serialize(),
                "_token": "{{ csrf_token() }}",
                "QuantityNumber": $("#QuantityNumber").val(),
            },
            dataType: 'json',
            cache:false,
           success: function (data) {
                if(data.wished ){
                    $('#CartNumber').html(Number($('#CartNumber').text())+1);
                    $( ".data-cart-url").addClass(" added");
                  }

                if(data.success){
                    swal(data.success, "You clicked the button!", "success");
                }
            }
        });
    });

</script>



{{-- start rating --}}


{{-- End rating --}}
@endsection
