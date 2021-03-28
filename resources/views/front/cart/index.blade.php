@extends('layouts.app')
@section('title','Cart')

@section('content')

<div class="cart-overlay"></div>

<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <div class="page-banner">
                    <h1>Carts</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">HOME</a></li>
                            <li><a href="{{ route('site.cart.index') }}">Cart</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
<div class="cart-overlay"></div>

<div class="product-section  section pt-90 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#">
                    <!-- Cart Table -->
                    <div class="cart-table table-responsive mb-40">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="pro-thumbnail">Image</th>
                                    <th class="pro-title">Product</th>
                                    <th class="pro-title">Oprions</th>
                                    <th class="pro-price">Price</th>
                                    <th class="pro-quantity">Quantity</th>
                                    <th class="pro-subtotal">Total</th>
                                    <th class="pro-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($carts as $cart)

                                <tr class="cart-{{ $cart->rowId }}">
                                    <td class="pro-thumbnail"><a href="{{  route('product.show', $cart->options->slug) }} "><img src="{{ $cart->options->image }}" alt="Product"></a></td>
                                    <td class="pro-title"><a href="{{  route('product.show', $cart->options->slug) }}">{{ $cart->name }}</a> </td>
                                    <td>{{ ($cart->options->options)??'not options' }}</td>
                                    <td class="pro-price"><span>${{ $cart->price }}</span></td>
                                    <td class="pro-quantity">
                                            {{-- <div class="quantity">
                                                <div class="pro-qty"><span class="dec "></span><input type="text" value=""><span class="inc "></span></div>
                                            </div> --}}
                                           <b> {{  $cart->qty }}</b>
                                    </td>
                                    <td class="pro-subtotal"><span>${{ ($cart->price)*intval( $cart->qty) }}</span></td>
                                    <td ><a href="#" class="pro-remove" data-cart-id="{{ $cart->rowId }}" data-url-cart="{{ route('site.cart.delete',$cart->rowId) }}"><i class="fa fa-trash-o"></i></a></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </form>

                <div class="row">

                    <div class="col-lg-6 col-12 mb-15">

                        {{-- <!-- Discount Coupon -->
                        <div class="discount-coupon">
                            <h4>Discount Coupon Code</h4>
                            <form action="#">
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="text" placeholder="Coupon Code">
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <input type="submit" value="Apply Code">
                                    </div>
                                </div>
                            </form>
                        </div> --}}
                    </div>

                    <!-- Cart Summary -->
                    <div class="col-lg-6 col-12 mb-40 d-flex">
                        <div class="cart-summary">
                            <div class="cart-summary-wrap" style="margin-bottom: 0px;">
                                <h4>Cart Summary</h4>
                                <p>Sub Total <span>${{Cart::subtotal()}}</span></p>
                                <p>Tax  Cost <span>$13</span>
                                {{-- <p>Coupon  Cost <span>$00.00</span></p> --}}
                                <h2>Grand Total <span>${{Cart::subtotal() + 13}}</span></h2>
                            </div>
                            <div class="cart-summary-button" style="text-align: center;">
                              <a href="{{ route("Order.index") }}"><button class="checkout-btn">Checkout</button></a>
                               {{-- <a href="{{ route('site.cart.update') }}"><button class="update-btn">Update Cart</button></a> --}}
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

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.pro-remove', function (e) {
        e.preventDefault();


        $.ajax({
            type: 'get',
            url: $(this).attr('data-url-cart'),
            data: {
                'cartId': $(this).attr('data-cart-id'),
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                if(data.wished ){
                    $('#CartNumber').html(Number($('#CartNumber').text())-1);
                    $( ".cart-" + data.id).hide();
                  }

                if(data.success){
                    swal(data.success, "You clicked the button!", "success");
                }
            }
        });
    });
</script>
@endsection
