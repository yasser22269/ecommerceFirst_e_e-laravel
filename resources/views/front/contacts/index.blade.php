@extends('layouts.app')
@section('title','Contact Us')

@section('content')


<div class="page-banner-section section">
    <div class="page-banner-wrap row row-0 d-flex align-items-center ">

        <!-- Page Banner -->
        <div class="col-lg-12 col-12 order-lg-2 d-flex align-items-center justify-content-center">
            <div class="page-banner">
                <div class="page-banner">
                    <h1>CONTACT Us</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ route('home') }}">HOME</a></li>
                            <li><a href="{{ route('Contacts') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>


<div class="contact-section section mt-10 mb-10">
    <div class="container">
        <div class="row">

            <!-- Contact Page Title -->
            <div class="contact-page-title col mb-10">
                <h1>Hi, Howdy <br>Let’s Connect us</h1>
            </div>
        </div>
        <div class="row">

            <!-- Contact Tab List -->
            <div class="col-lg-4 col-12 mb-50">
                <ul class="contact-tab-list nav">
                    <li><a class="" data-toggle="tab" href="#contact-address">Contact us</a></li>
                    <li><a data-toggle="tab" href="#contact-form-tab" class="active">Leave us a message</a></li>
                    <li><a data-toggle="tab" href="#store-location" class="">All Store location</a></li>
                </ul>
            </div>

            <!-- Contact Tab Content -->
            <div class="col-lg-8 col-12">
                <div class="tab-content">

                    <!-- Contact Address Tab -->
                    <div class="tab-pane fade row d-flex" id="contact-address">

                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Address</h4>
                                <p>You address will be here Lorem Ipsum text</p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Phone</h4>
                                <p><a href="tel:01234567890">01234 567 890</a><a href="tel:01234567891">01234 567 891</a></p>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mb-50">
                            <div class="contact-information">
                                <h4>Web</h4>
                                <p><a href="mailto:info@example.com">info@example.com</a><a href="#">www.example.com</a></p>
                            </div>
                        </div>

                    </div>

                    <!-- Contact Form Tab -->
                    <div class="tab-pane fade row d-flex active show" id="contact-form-tab">
                        <div class="col">

                            <form id="contact-form" method="POST" action="{{ route('UpdatepContacts') }}" class="contact-form mb-50">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="first_name">Name*</label>
                                        <input type="text" class="form-control"name="Name" value="{{ $user->Name ?? old('Name') }}"  autocomplete="name" autofocus required>
                                        @error('Name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                         @enderror
                                    </div>
                                    <div class="col-md-6 col-12 mb-25">
                                        <label for="phone_number">Phone</label>
                                        <input type="tel" class="form-control" name="phone" value="{{ $user->phone ?? old('phone') }}"  autocomplete="phone" autofocus required>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                         @enderror
                                    </div>
                                    <div class="col-md-12 col-12 mb-25">
                                        <label for="email_address">Email*</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email ?? old('email') }}"  autocomplete="email" autofocus required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                         @enderror
                                    </div>

                                    <div class="col-12 mb-25">
                                        <label for="message">Message*</label>
                                        <textarea id="message" name="massage">{{old('massage')  }}</textarea>
                                        @error('massage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                         @enderror
                                    </div>
                                    <div class="col-12">
                                        <input type="submit" value="SEND NOW">
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>

                        </div>
                    </div>

                    <!-- Contact Stores Tab -->
                    <div class="tab-pane fade row d-flex" id="store-location">

                        <div class="col-md-6 col-12 mb-50">
                            <div class="single-store">
                                <h3>E&amp;E Australia</h3>
                                <p>You address will be here Lorem Ipsum is simply dummy text.</p>
                                <p><a href="tel:01234567890">01234 567 890</a> / <a href="tel:01234567891">01234 567 891</a></p>
                                <p><a href="mailto:info@example.com">info@example.com</a> / <a href="#">www.example.com</a></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-50">
                            <div class="single-store">
                                <h3>E&amp;E England</h3>
                                <p>You address will be here Lorem Ipsum is simply dummy text.</p>
                                <p><a href="tel:01234567890">01234 567 890</a> / <a href="tel:01234567891">01234 567 891</a></p>
                                <p><a href="mailto:info@example.com">info@example.com</a> / <a href="#">www.example.com</a></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-50">
                            <div class="single-store">
                                <h3>E&amp;E Germany</h3>
                                <p>You address will be here Lorem Ipsum is simply dummy text.</p>
                                <p><a href="tel:01234567890">01234 567 890</a> / <a href="tel:01234567891">01234 567 891</a></p>
                                <p><a href="mailto:info@example.com">info@example.com</a> / <a href="#">www.example.com</a></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-50">
                            <div class="single-store">
                                <h3>E&amp;E France</h3>
                                <p>You address will be here Lorem Ipsum is simply dummy text.</p>
                                <p><a href="tel:01234567890">01234 567 890</a> / <a href="tel:01234567891">01234 567 891</a></p>
                                <p><a href="mailto:info@example.com">info@example.com</a> / <a href="#">www.example.com</a></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-50">
                            <div class="single-store">
                                <h3>E&amp;E Canada</h3>
                                <p>You address will be here Lorem Ipsum is simply dummy text.</p>
                                <p><a href="tel:01234567890">01234 567 890</a> / <a href="tel:01234567891">01234 567 891</a></p>
                                <p><a href="mailto:info@example.com">info@example.com</a> / <a href="#">www.example.com</a></p>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-50">
                            <div class="single-store">
                                <h3>E&amp;E Denmark</h3>
                                <p>You address will be here Lorem Ipsum is simply dummy text.</p>
                                <p><a href="tel:01234567890">01234 567 890</a> / <a href="tel:01234567891">01234 567 891</a></p>
                                <p><a href="mailto:info@example.com">info@example.com</a> / <a href="#">www.example.com</a></p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
