@extends('layouts.admin')
@section('title','Options Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Options</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Options.index') }}">Options</a>
            </li>
            <li class="breadcrumb-item active">Options Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('Options.store') }}">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">Options Info</h4>

                  <div class="row">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)



                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">اسم  الاوبشن:{{  $localeCode }}</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="{{  $localeCode }}Name" name="{{  $localeCode }}[name]">
                        </div>
                          @error("$localeCode.name")
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
                                   placeholder="  "
                                   value="{{ old('price') }}"
                                   name="price">
                            @error("price")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>


                <div class="row" >
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> اختر المنتج
                            </label>
                            <select name="product_id" class="form-control">
                                <optgroup label="من فضلك أختر القسم ">

                                    @if($products && $products -> count() > 0)
                                        @foreach($products as $product)
                                            <option
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
                                        @foreach($attrubutes as $attrubute)
                                            <option
                                                value="{{$attrubute->id }}">{{$attrubute->name}}</option>
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
