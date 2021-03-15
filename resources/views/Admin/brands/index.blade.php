@extends('layouts.admin')
@section('title','brands index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">brands create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">brands index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Brand.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add brand</button>
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
                  <th> photo</th>
                  <th>Name</th>
                  <th>Active</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($brands as $index => $brand)
                      
               
                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td> <img src="{{ asset( $brand->photo) }}" alt="" width="150px"> </td>
                  <td>{{ $brand->name ?? "--" }}</td>
                  <td>{{ $brand->getactive() }}</td>
                  <td>
                  <a href="{{ route('Brand.edit',$brand->id) }}">  
                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Edit </button>
                   </a>  
                  </td>
                  <td>
                    
                     <form class="form" method="POST" action="{{ route('Brand.destroy',$brand->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  brand  --}}
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
      {{ $brands->links() }}
    </div>
  </div>
@endsection