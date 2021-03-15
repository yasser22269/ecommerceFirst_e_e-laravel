@extends('layouts.admin')
@section('title','categories Edit')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">categories</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
             <li class="breadcrumb-item"><a href="{{ route('Category.index') }}">Categories</a>
            </li>
            <li class="breadcrumb-item active">categories Create
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>


      <div class="card">
          <div class="container">
            <form class="form" method="POST" action="{{ route('Category.update',$category->id) }}">
                @csrf
                @method('put')
                <div class="form-body">
                  <h4 class="form-section">category Info</h4>
                  <input type="hidden"  name="id" value="{{ $category->id }}">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Slug</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="slug" name="slug" value="{{ $category->slug }}">
                        @error('slug')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Name</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Name" name="name" value="{{ $category->name }}">
                        @error('name')
                        <span class="text-danger"> {{$message}}</span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                            <label for="switcheryColor4"
                                   class="card-title ">Status </label>
                            <input type="checkbox" value="1"
                                   name="is_active"
                                    {{ $category->is_active == 1 ? 'checked': ""}}
                                   id="switcheryColor4"
                                   class="switchery" data-color="success"
                                   />

                            @error("is_active")
                            <span class="text-danger">{{$message }}</span>
                            @enderror
                        </div>


                        <div class="col-md-3">
                            <div class="form-group mt-1">
                                <input type="radio"
                                       name="type"
                                       value="1"
                                       class="switchery" data-color="success"
                                      {{ $category->parent_id == null ? "checked" : ""}}
                                />

                                <label
                                    class="card-title ml-1">
                                    قسم رئيسى
                                </label>

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group mt-1">
                                <input type="radio"
                                       name="type"
                                       value="2"
                                       {{ $category->parent_id != null ? "checked" : ""}}
                                       class="switchery" data-color="success"
                                />

                                <label
                                    class="card-title ml-1">
                                    قسم فرعي
                                </label>

                            </div>
                        </div>
                  </div>
                  <div class="row parent-id" style="{{ $category->parent_id == null ? 'display: none' : ''}}">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="projectinput5"> parent - Name</label>
                        <select  name="parent_id" class="form-control">
                            @if($category->parent_id == null)
                            <option selected></option>
                            @endif
                          @if($categories && $categories -> count() > 0)
                            @foreach ($categories as  $categoryname)
                            <option value="{{ $categoryname->id }}"  {{  $categoryname->id == $category->parent_id ? 'selected': "" }} >{{ $categoryname->name }}</option>
                            @endforeach
                          @endif
                        </select>
                      </div>
                      @error('parent_id')
                      <span class="text-danger"> {{$message}}</span>
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
    <script>
        $('input:radio[name="type"]').change(
            function(){
                if(this.checked &&this.value =='2')
                    $('.parent-id').show();
                else
                    $('.parent-id').hide();
            }
        )


    </script>

@endsection
