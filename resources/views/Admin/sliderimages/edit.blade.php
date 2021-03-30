@extends('layouts.admin')
@section('title','Slider Images Edit')
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
            <li class="breadcrumb-item active">Slider Images Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Slider.update',$Slider->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">Slider Info</h4>
                  <input type="hidden"  name="id" value="{{ $Slider->id }}">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Photo</label>
                          <input type="file" id="projectinput2" class="form-control" placeholder="Photo" name="photo" value="{{ $Slider->photo }}">
                          @error('photo')
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
                      </div>
                    <div class="col-md-6">

                      <div class="form-group">
                        <label for="projectinput2">Discount</label>
                        <input type="number" id="projectinput2" class="form-control" placeholder="Discount" name="Discount" value="{{ $Slider->Discount }}">
                        @error('Discount')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>
                    <div class="row">

                        @foreach($Slider->translations as $SliderName)


                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="projectinput2">Title:{{  $SliderName->locale }}</label>

                              <textarea  name="{{  $SliderName->locale }}[title]" id="title"
                              class="form-control"
                              placeholder="Title"
                                  >{{  $SliderName->title }}</textarea>
                            </div>
                              @error("$SliderName->locale.title")
                              <span class="text-danger"> {{$message}}</span>
                              @enderror
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
                                            {{ ($category->id == $Slider->category_id) ? "selected" : ''}}
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


                  <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset( $Slider->photo) }}" alt="" width="150px">
                    </div>


                    <div class="col-md-6">

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
