@extends('layouts.admin')
@section('title','coupons Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">coupons</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">coupons</a>
            </li>
            <li class="breadcrumb-item active">coupons Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('coupon.store') }}">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">coupon Info</h4>



                  <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> Code
                            </label>
                            <input type="text" id="Code"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{ old('code') }}"
                                   name="code">
                            @error("code")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> value
                            </label>
                            <input type="text" id="value"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{ old('value') }}"
                                   name="value">
                            @error("value")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="switcheryColor4"
                           class="card-title ">Status </label>
                    <input type="checkbox" value="1"
                           name="status"
                           id="switcheryColor4"
                           class="switchery" data-color="success"
                           checked/>

                    @error("status")
                    <span class="text-danger">{{$message }}</span>
                    @enderror
                </div>


                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">
                    <i class="la la-check-square-o"></i> Save
                  </button>
                </div>
              </form>

              </div>
         </div>


         @endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
{{-- <script src="{{asset('/')}}app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script> --}}
<script>
    $(document).ready(function() {
        $(".select2").select2();
        });
</script>
@endsection
