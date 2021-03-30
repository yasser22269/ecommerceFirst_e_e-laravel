@extends('layouts.admin')
@section('title','Attributes Edit')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Attributes</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Attributes.index') }}">Attributes</a>
            </li>
            <li class="breadcrumb-item active">Attributes Edit
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Attributes.update',$Attribute->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">Attribute Info</h4>
                  <input type="hidden"  name="id" value="{{ $Attribute->id }}">

                  {{-- <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Name</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name" value="{{ $Attribute->name }}">
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div> --}}

                  <div class="row">

                    @foreach($Attribute->translations as $AttributeName)


                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="projectinput2">Name:{{  $AttributeName->locale }}</label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="{{  $AttributeName->locale }}Name" name="{{  $AttributeName->locale }}[name]" value="{{  $AttributeName->name }}">
                        </div>
                          @error("$AttributeName->locale.name")
                          <span class="text-danger"> {{$message}}</span>
                          @enderror
                      </div>


                    @endforeach

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
    <script>


    </script>

@endsection
