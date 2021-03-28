@extends('layouts.app')
@section('title','CHECKOUT')

@section('content')

<div class="cart-overlay"></div>
<div class="page-section section mt-90 mb-30">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <!-- Checkout Form s-->
                <form action="{{ route('Order.store') }}" class="checkout-form" method="post">
                    @csrf


                    @foreach ($errors->all() as $error)
                        <div class="row mr-2 ml-2" >
                            <button type="text" class="btn btn-lg btn-block btn-outline-danger mb-2"
                                    id="type-error">{{ $error }}
                            </button>
                         </div>
                    @endforeach

                   <div class="row row-40">

                       <div class="col-lg-7 mb-20">

                           <!-- Billing Address -->
                           <div id="billing-form" class="mb-40">
                               <h4 class="checkout-title">Billing Address</h4>

                                <input type="hidden" value="{{  Auth::user('web')->id }}" name="user_id">
                               <div class="row">

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>First Name*</label>
                                       <input type="text" placeholder="First Name"value="{{  Auth::user('web')->name }}" name="f_name">
                                       @error('f_name')
                                       <span class="text-danger"> {{$message}}</span>
                                       @enderror
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Last Name*</label>
                                       <input type="text" placeholder="Last Name"value="{{ old('e_name')}}" name="e_name">
                                       @error('e_name')
                                       <span class="text-danger"> {{$message}}</span>
                                       @enderror
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Email Address*</label>
                                       <input type="email" placeholder="Email Address"value="{{  Auth::user('web')->email }}" name="email">
                                       @error('email')
                                       <span class="text-danger"> {{$message}}</span>
                                       @enderror
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Phone</label>
                                       <input type="tel" placeholder="Phone number" value="{{ old('phone')}}" name="phone">
                                       @error('phone')
                                       <span class="text-danger"> {{$message}}</span>
                                       @enderror
                                   </div>

                                   <div class="col-12 mb-20">
                                       <label>Address*</label>
                                       <input type="text" placeholder="Address line"  value="{{ old('address')}}" name="address">
                                       @error('address')
                                       <span class="text-danger"> {{$message}}</span>
                                       @enderror
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Country*</label>
                                       <select class="form-control" name="Country_id">
                                          <option value="1">Egypt</option>
                                          <option value="2">China</option>
                                          <option value="3">Japan</option>
                                          </select>
                                          @error('Country_id')
                                          <span class="text-danger"> {{$message}}</span>
                                          @enderror
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Town/City*</label>
                                       <input type="text" placeholder="Town/City" value="{{ old('city')}}" name="city">
                                       @error('city')
                                       <span class="text-danger"> {{$message}}</span>
                                       @enderror
                                   </div>

                                   <div class="col-md-6 col-12 mb-20">
                                       <label>Zip Code*</label>
                                       <input type="text" placeholder="Zip Code"  value="{{ old('zip_code')}}" name="zip_code">
                                       @error('zip_code')
                                       <span class="text-danger"> {{$message}}</span>
                                       @enderror
                                   </div>



                               </div>
                           </div>


                           <h4 class="checkout-title">Payment Method</h4>

                           <div class="checkout-payment-method">

                               {{-- <div class="single-method">
                                   <input type="radio" id="payment_check" name="payment-method" value="check Payment">
                                   <label for="payment_check">Check Payment</label>
                               </div> --}}

                               <div class="single-method">
                                   <input type="radio" id="payment_bank" name="payment-method" value="Cash on Delivery">
                                   <label for="payment_bank">Cash on Delivery</label>
                               </div>

                               <div class="single-method">
                                   <input type="radio" id="payment_cash" name="payment-method" value="Paypal">
                                   <label for="payment_cash">Paypal</label>
                                   <p data-method="Paypal" style="">
                                       لم نقم بتشغيلها حتى الان</p>
                               </div>

                               @error('payment-method')
                               <span class="text-danger"> {{$message}}</span>
                               @enderror
                           </div>

                       </div>

                       <div class="col-lg-5">
                           <div class="row">

                               <!-- Cart Total -->
                               <div class="col-12 mb-10">

                                   <h4 class="checkout-title">Cart Total</h4>

                                   <div class="checkout-cart-total">

                                       <h4>Product <span>Total</span></h4>
                                       @foreach ($carts as $cart)
                                       <ul>
                                           <li>{{ $cart->name}} {{ $cart->options->options ??''}} <span>${{  $cart->price }}</span></li>
                                       </ul>
                                       @endforeach

                                       <p>Sub Total <span>${{Cart::subtotal()}}</span></p>
                                       <input type="hidden" name="subtotal" value="{{Cart::subtotal()}}">
                                       <p>Shipping Fee <span>$00.00</span></p>


                                       @if(Cart::subtotal() ==0)
                                       <p>Tax Cost <span>$00.00</span></p>
                                       <input type="hidden" name="tax" value="0">
                                       @else
                                       <p>Tax Cost <span>$13.00</span></p>
                                       <input type="hidden" name="tax" value="13">
                                       @endif


                                       <p>coupon Cost<span id="couponCost">${{ $coupon->value ?? 00}}.00</span></p>
                                        {{-- @isset($coupon) --}}
                                       <input type="hidden" name="discount" value="0">
                                       <input type="hidden" name="discount_code" value="">
                                       {{-- @endisset --}}





                                       @if(Cart::subtotal() ==0)
                                       <h4 >Grand Total <span>${{Cart::subtotal()}}</span></h4>
                                       <input type="hidden" name="total" value="{{Cart::subtotal()}}">
                                       {{-- @elseif ($coupon && Cart::subtotal() !=0)
                                       <h4>Grand Total <span>${{Cart::subtotal() +13}}</span></h4>
                                       <input type="hidden" name="total" value="{{Cart::subtotal() +13 - $coupon->value }}"> --}}
                                       @else
                                       <h4>Grand Total <span id="TotalCost">${{Cart::subtotal() +13}}</span></h4>
                                       <input type="hidden" name="total" value="{{Cart::subtotal() +13}}">
                                       @endif

                                   </div>
                                   <button class="place-order" type="submit">Place order</button>

                                </form>
                               </div>
                               <!-- Payment Method -->
                               <div class="col-12 mb-10">



                                       <!-- Discount Coupon -->
                                       <div class="discount-coupon">
                                            <h4>Discount Coupon Code</h4>
                                               <form id="couponorder" action="{{ route('couponorder') }}">
                                                {{-- @csrf --}}
                                                <div class="row">
                                                    <div class="col-md-7 col-12 mb-25">
                                                        <input type="text" placeholder="Coupon Code" name="code">
                                                    </div>
                                                    <div class="col-md-5 col-12 mb-25">
                                                        <button type="submit" class="place-order" style="margin-top: 4px;">Apply Code</button>
                                                    </div>
                                                </div>

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

@endsection
@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    $('#couponorder').on('submit',function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: $(this).attr('action'),
            data: {
               'code': $("#couponorder input").val(),
                "_token": "{{ csrf_token() }}",
            },
            dataType: 'json',
            cache:false,
           success: function (data) {
                if(data.status ){
                    $('#couponCost').html(data.Coupon_value + '$');
                    $('input[name="discount"]').val(data.Coupon_value);
                    $('input[name="discount_code"]').val(data.Coupon_code);
                    $('#TotalCost').html({{Cart::subtotal() +13}} - data.Coupon_value + '$');
                    $('input[name="total"]').val({{Cart::subtotal() +13}} - data.Coupon_value);
                  }

                if(data.success){
                    swal(data.success, "You clicked the button!", "success");
                }

                if(data.error){
                    swal(data.error, "You clicked the button!", "error");
                }
                console.log();
            }
        });
    });

</script>
@endsection
