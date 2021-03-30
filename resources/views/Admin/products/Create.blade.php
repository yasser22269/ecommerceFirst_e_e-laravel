@extends('layouts.admin')
@section('title','products Create')
@section('style')

<link rel="stylesheet" type="text/css" href="{{asset('/')}}app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">products</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Products.index') }}">products</a>
            </li>
            <li class="breadcrumb-item active">products Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
          <form class="form" method="POST" action="{{ route('Products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">Products Info</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="projectinput1">One Image
                                </label>
                                <input type="file"
                                       class="form-control"
                                       placeholder="  "
                                       value="{{old('photo')}}"
                                       name="photo">
                                @error("photo")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                  <div class="row">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:{{  $localeCode }}</label>
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
                            <label for="projectinput1">Slug
                            </label>
                            <input type="text"
                                   class="form-control"
                                   placeholder="  "
                                   value="{{old('slug')}}"
                                   name="slug">
                            @error("slug")
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>


                  <div class="row">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">description:{{  $localeCode }}</label>
                        <textarea  name="{{  $localeCode }}[description]" id="description"
                        class="form-control"
                        placeholder="{{  $localeCode }}:Description"
                         >{{old('description')}}</textarea>
                          @error("$localeCode.description")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
                      </div>

                    @endforeach

                  </div>
                  <div class="row">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">short description:{{  $localeCode }}</label>
                        <textarea  name="{{  $localeCode }}[short_description]" id="description"
                        class="form-control"
                        placeholder="{{  $localeCode }}:short Description"
                         >{{old('short_description')}}</textarea>
                          @error("$localeCode.short_description")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
                      </div>

                    @endforeach

                  </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="projectinput1"> Price
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

                </div>

                <div class="row" >
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="projectinput1"> اختر القسم
                            </label>
                            <select name="categories[]" class="select2 form-control" multiple>
                                <optgroup label="من فضلك أختر القسم ">

                                    @if($categories && $categories -> count() > 0)
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id }}">{{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('categories.0')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="projectinput1"> اختر ألعلامات الدلالية
                            </label>
                            <select name="tags[]" class="select2 form-control" multiple>
                                <optgroup label=" اختر ألعلامات الدلالية ">

                                    @if($tags && $tags -> count() > 0)
                                        @foreach($tags as $tag)
                                            <option
                                                value="{{$tag->id }}">{{$tag->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('tags')
                            <span class="text-danger"> {{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="projectinput1"> اختر ألماركة
                            </label>
                            <select name="brand_id" class="select2 form-control">
                                <optgroup label="من فضلك أختر الماركة ">

                                    @if($brands && $brands -> count() > 0)
                                        @foreach($brands as $brand)
                                            <option
                                                value="{{$brand->id }}">{{$brand->name}}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            </select>
                            @error('brand_id')
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
