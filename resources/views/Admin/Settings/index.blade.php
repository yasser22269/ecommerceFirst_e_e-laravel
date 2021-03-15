@extends('layouts.admin')
@section('title','Setting index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Setting index
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


     <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('update.shippings.methods',$shippingMethod->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">shipping Method Info</h4>
                  <input type="hidden"  name="id" value="{{ $shippingMethod->id }}">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">{{ $shippingMethod->key }}</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="value" name="value" value="{{ $shippingMethod->value }}">
                        @error('value')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">plain_value</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="plain_value" name="plain_value" value="{{ $shippingMethod->plain_value }}">
                        @error('plain_value')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
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

 




