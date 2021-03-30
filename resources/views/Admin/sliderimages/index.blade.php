@extends('layouts.admin')
@section('title','SliderImages index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Slider Images create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Slider Images index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Slider.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add Slider</button>
        </a>

      </div>
    </div>
  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="card">

        <div class="card-content collapse show">
          <div class="table-responsive">
            <table class="table">
              <thead class="bg-success white">
                <tr>
                  <th> id</th>
                  <th>photo</th>
                  <th>Title</th>
                  <th>category Name</th>
                  <th>Discount</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($SliderImages as $index => $Slider)


                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td> <img src="{{  $Slider->photo  }}" alt="" width="150px"> </td>
                  <td>{{ $Slider->title ?? "--" }}</td>
                  <td>{{ $Slider->category->name  ?? "--"}}</td>
                  <td>{{ $Slider->Discount ?? "--" }}</td>

                  <td>
                  <a href="{{ route('Slider.edit',$Slider->id) }}">
                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Edit </button>
                   </a>
                  </td>
                  <td>

                     <form class="form" method="POST" action="{{ route('Slider.destroy',$Slider->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  Slider  --}}
                          <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" ><i class="la la-remove la-sm"></i> DELETE </button>

                      </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

      </div>
      {{ $SliderImages->links() }}
    </div>
  </div>
@endsection
