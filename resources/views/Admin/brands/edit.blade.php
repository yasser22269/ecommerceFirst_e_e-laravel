@extends('layouts.admin')
@section('title','brands Edit')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">brands</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Brand.index') }}">brands</a>
            </li>
            <li class="breadcrumb-item active">brands Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Brand.update',$Brand->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">Brand Info</h4>
                  <input type="hidden"  name="id" value="{{ $Brand->id }}">

                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Photo</label>
                          <input type="file" id="projectinput2" class="form-control" placeholder="Photo" name="photo" value="{{ $Brand->photo }}">
                          @error('photo')
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                        </div>
                      </div>
                    <div class="col-md-6">
                      {{-- <div class="form-group">
                        <label for="projectinput2">Name</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name" value="{{ $Brand->name }}">
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div> --}}
                    </div>
                  </div>
                  <div class="row">

                    @foreach($Brand->translations as $BrandName)


                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:{{  $BrandName->locale }}</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="{{  $BrandName->locale }}Name" name="{{  $BrandName->locale }}[name]" value="{{  $BrandName->name }}">
                        </div>
                          @error("$BrandName->locale.name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>


                    @endforeach

                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset( $Brand->photo) }}" alt="" width="150px">
                    </div>
                    <div class="col-md-6">
                            <label for="switcheryColor4"
                                   class="card-title ">Status </label>
                            <input type="checkbox" value="1"
                                   name="is_active"
                                    {{ $Brand->is_active == 1 ? 'checked': ""}}
                                   id="switcheryColor4"
                                   class="switchery" data-color="success"
                                   />

                            @error("is_active")
                            <span class="text-danger">{{$message }}</span>
                            @enderror
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
