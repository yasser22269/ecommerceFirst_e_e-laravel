@extends('layouts.admin')
@section('title','Options  Edit')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">


   <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/'. getFolder() .'/plugins/file-uploaders/dropzone.css')}}">


@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Options </h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Options.index') }}">Options </a>
            </li>
            <li class="breadcrumb-item active">Options  Edit
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
            <form class="form" method="POST" action="{{ route('Options.update',$Options->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">General Option Info</h4>
                  <input type="hidden"  name="id" value="{{ $Options->id }}">
                  <div class="row">

                    @foreach($Options->translations as $OptionName)


                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:{{  $OptionName->locale }}</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="{{  $OptionName->locale }}Name" name="{{  $OptionName->locale }}[name]" value="{{  $OptionName->name }}">
                        </div>
                          @error("$OptionName->locale.name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>


                    @endforeach

                  </div>
                  <div class="row">


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> سعر  الاوبشن
                            </label>
                            <input type="number" id="price"
                                   class="form-control"
                                   placeholder="price"
                                   value="{{ $Options->price }}"
                                   name="price">
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                  </div>



                <div class="row">


                </div>

                <div class="row" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> اختر المنتج
                            </label>
                            <select name="product_id" class="form-control" >
                                <optgroup label="من فضلك أختر القسم ">

                                    @if($products && $products -> count() > 0)
                                        @foreach($products as $product)
                                            <option
                                            {{ ($Options->product_id == $product->id) ? "selected" : ''}}
                                                value="{{$product->id }}">{{$product->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('product_id')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> اختر الصفة
                            </label>
                            <select name="attribute_id" class="form-control" >
                                <optgroup label=" اختر ألعلامات الدلالية ">

                                    @if($attrubutes && $attrubutes -> count() > 0)
                                        @foreach($attrubutes as $attribute)
                                            <option
                                            {{ ($Options->attribute_id == $attribute->id) ? "selected" : ''}}

                                                value="{{$attribute->id }}">{{$attribute->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('attribute_id')
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
