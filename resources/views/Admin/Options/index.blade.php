@extends('layouts.admin')
@section('title','Options index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Options create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Options index
            </li>
          </ol>
        </div>
      </div>
    </div>
    <div class="content-header-right col-md-6 col-12">
      <div class="btn-group float-md-right" >
        <a href="{{ route('Options.create') }}">
            <button class="btn btn-info round  box-shadow-2 px-2"type="button" > Add Option</button>
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
                  <th>Product Name</th>
                  <th>attribute Name</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($Options as $index => $Option)


                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $Option->product->name ?? "--" }}</td>
                  <td>{{ $Option->attribute->name ?? "--" }}</td>
                  <td>{{ $Option->name ?? "--" }}</td>
                  <td>{{ $Option->price ?? '--' }}</td>
                  <td>
                  <a href="{{ route('Options.edit',$Option->id) }}">
                        <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Edit </button>
                   </a>
                  </td>
                  <td>

                     <form class="form" method="POST" action="{{ route('Options.destroy',$Option->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  Options  --}}
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
      {{ $Options->links() }}
    </div>
  </div>
@endsection


