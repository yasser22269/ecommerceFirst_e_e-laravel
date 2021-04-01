@extends('layouts.admin')
@section('title','Order index')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">Order create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
            {{--  <li class="breadcrumb-item"><a href="#">Tables</a>
            </li>  --}}
            <li class="breadcrumb-item active">Order index
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
                  <th>total Cost</th>
                  <th>Status</th>
                  <th>Show</th>
                  <th>Delete</th>

                </tr>
              </thead>
              <tbody>
                  @foreach ($Order as $index => $order)

                <tr>
                  <td>{{ ($index++)+1 }}</td>
                  <td>{{ $order->f_name }}  {{ $order->e_name }}</td>
                  <td>{{ $order->phone ?? "--" }}</td>
                  <td>{{ $order->email ?? "--" }}</td>
                  <td>{{ $order->total}}$</td>
                  <td>
                    @if ($order->status ==0)
                        <button type="button" class="btn btn-sm btn-outline-danger round">لم ترى</button>
                    @elseif ($order->status ==1)
                            <button type="button" class="btn btn-sm btn-outline-warning round">قيد التنفيذ</button>
                    @elseif ($order->status ==2)
                    <button type="button" class="btn btn-sm btn-outline-info round">فى الطريق اليه</button>
                     @elseif ($order->status ==3)
                            <button type="button" class="btn btn-sm btn-outline-success round">تمت بنجاح</button>
                    @endif



               </td>
                  <td>  <a href="{{ route('OrderAdmin.show',$order->id) }}">
                    <button class="btn btn-info btn-sm round  box-shadow-2 px-1"type="button" > <i class="la la-edit la-sm"></i> Show </button>
                        </a>
                </td>

                  <td>
                    @if ($order->status ==3)

                     <form class="form" method="POST" action="{{ route('OrderAdmin.destroy',$order->id) }}">
                      @csrf
                      @method('DELETE')
                  {{--  Order  --}}
                          <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" ><i class="la la-remove la-sm"></i> DELETE </button>

                      </form>
                @else
                لا يمكن حذف الاوردر
                    </td>
                @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>

      </div>
      {{ $Order->links() }}
    </div>
  </div>
@endsection
