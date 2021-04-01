@extends('layouts.admin')
@section('title','coupon  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">coupon </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('coupon.index') }}">coupon </a>
            </li>
            <li class="breadcrumb-item active">coupon  Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <div class="card-content">
    <div class="card-body">

      <div class="tab-content px-1 pt-1">
        <div role="tabpanel" class="tab-pane active" id="tab11" aria-expanded="true" aria-labelledby="base-tab11">
            <form class="form" method="POST" action="{{ route('coupon.update',$coupon->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General coupon Info</h4>
                  <input type="hidden"  name="id" value="{{ $coupon->id }}">
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> value
                            </label>
                            <input type="text" id="value"
                                   class="form-control"
                                   placeholder="value"
                                   value="{{ $coupon->value }}"
                                   name="value">
                            @error("value")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> code
                            </label>
                            <input type="text" id="code"
                                   class="form-control"
                                   placeholder="code"
                                   value="{{ $coupon->code }}"
                                   name="code">
                            @error("code")
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
                            {{ $coupon->status == 1 ? 'checked': ""}}
                           id="switcheryColor4"
                           class="switchery" data-color="success"
                           />

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

      </div>
    </div>
  </div>


      {{-- <div class="card">
          <div class="container">
            </div>
         </div> --}}


         @endsection

@section('js')


@endsection
