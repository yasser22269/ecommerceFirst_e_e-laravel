@extends('layouts.admin')
@section('title','Slider Images Create')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Slider Images</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Slider.index') }}">Slider Images</a>
            </li>
            <li class="breadcrumb-item active">Slider Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Slider.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">Slider Info</h4>


                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Photo</label>
                          <input type="file" id="projectinput2" class="form-control" placeholder="Photo" name="photo">
                          @error('photo')
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
                      </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Discount</label>
                        <input type="number" id="projectinput2" class="form-control" placeholder="Discount" name="Discount">
                        @error('Discount')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                 
                    <div class="row">

                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput2">Title:{{  $localeCode }}</label>
                            <textarea  name="{{  $localeCode }}[title]" id="title"
                            class="form-control"
                            placeholder="{{  $localeCode }}:title"
                             >{{old('title')}}</textarea>
                              @error("$localeCode.title")
                              <span class="text-danger"> {{$message}}</span>
                              @enderror
                            </div>
                          </div>

                        @endforeach

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="projectinput1"> اختر القسم
                            </label>
                            <select name="category_id" class=" form-control" >
                                    @if($categories && $categories -> count() > 0)
                                        @foreach($categories as $category)
                                            <option
                                            {{-- @foreach($Products->category as $Productcategory)
                                            {{ ($category->id == $Productcategory->id) ? "selected" : ''}}
                                             @endforeach --}}
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

@endsection
