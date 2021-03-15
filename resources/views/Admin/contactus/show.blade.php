@extends('layouts.admin')
@section('title','Contact US show')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">ContactUS create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
           <li class="breadcrumb-item"><a href="{{ route('Contact.index') }}">Contacts</a>
            </li>
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

        <h5>Name : {{ $ContactUS->Name }}</h5>
        <h5>Phone : {{ $ContactUS->phone ?? "--" }}</h5>
        <h5>Email :{{ $ContactUS->email ?? "--" }}</h5>
        <h5>Massage : {{ $ContactUS->massage ?? "--" }}</h5>
        <p>

           <form class="form" method="POST" action="{{ route('Contact.destroy',$ContactUS->id) }}">
            @csrf
            @method('DELETE')
        {{--  ContactUS  --}}
                <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" ><i class="la la-remove la-sm"></i> DELETE </button>

            </form>
          </p>

        </div>
    </div>
  </div>
@endsection
