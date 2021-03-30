@extends('layouts.admin')
@section('title','tags Create')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">tags</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Tag.index') }}">tags</a>
            </li>
            <li class="breadcrumb-item active">tags Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Tag.store') }}">
                @csrf
                <div class="form-body">
                  <h4 class="form-section">Tag Info</h4>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Slug</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="slug" name="slug">
                        @error('slug')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      {{-- <div class="form-group">
                        <label for="projectinput2">Name</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name">
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div> --}}
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
                    <div class="col-md-12">
                            <label for="switcheryColor4"
                                   class="card-title ">Status </label>
                            <input type="checkbox" value="1"
                                   name="is_active"
                                   id="switcheryColor4"
                                   class="switchery" data-color="success"
                                   checked/>

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
