@extends('layouts.admin')
@section('title','Contact US index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">ContactUS create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Contact US index
            </li>
          </ol>
        </div>
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
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Massage</th>
                  <th>Show</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                  @foreach ($ContactUS as $index => $Contact)

                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $Contact->Name }}</td>
                  <td>{{ $Contact->phone ?? "--" }}</td>
                  <td>{{ $Contact->email ?? "--" }}</td>
                  <td>{{ Str::limit($Contact->massage,30)  ?? "--" }}</td>
                  <td>  <a href="{{ route('Contact.show',$Contact->id) }}">
                    <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Show </button>
                        </a>
                </td>
                  <td>

                     <form class="form" method="POST" action="{{ route('Contact.destroy',$Contact->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  ContactUS  --}}
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
      {{ $ContactUS->links() }}
    </div>
  </div>
@endsection
