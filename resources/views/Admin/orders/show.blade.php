@extends('layouts.admin')
@section('title','order show')
@section('content')
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
      <h3 class="content-header-title">order create</h3>
      <div class="row breadcrumbs-top">
        <div class="breadcrumb-wrapper col-12">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('Admin') }}">Admin</a>
            </li>
           <li class="breadcrumb-item"><a href="{{ route('OrderAdmin.index') }}">orders</a>
            </li>
            <li class="breadcrumb-item active">order
            </li>
          </ol>
        </div>
      </div>
    </div>

  </div>

<div class="row" id="header-styling">
    <div class="col-12">
      <div class="card">
        <div class="card-content">
            <div class="card-body">

        <h5> <b> Name :</b> {{ $order->f_name }}  {{ $order->e_name }}</h5> <br>
        <h5><b>Phone :</b> {{ $order->phone }}</h5><br>
        <h5><b>Email :</b>{{ $order->email }}</h5><br>
        <h5><b>total Cost :</b> {{ $order->total }}$ </h5><br>


        <h5><b>city :</b> {{ $order->city }} </h5><br>
        <h5><b>zip_code :</b> {{ $order->zip_code }} </h5><br>
        <h5><b>address :</b> {{ $order->address }} </h5><br>
        <h5><b>user :</b> {{ $order->user->name }} -- {{ $order->user->email }}  </h5><br>
        <h5><b>payment gateway :</b> {{ $order->payment_gateway }} </h5><br>
        <h5>
            @if ($order->status ==0)
            <button type="button" class="btn btn-sm btn-outline-danger round">لم ترى</button>
            @elseif ($order->status ==1)
                    <button type="button" class="btn btn-sm btn-outline-warning round">قيد التنفيذ</button>
            @elseif ($order->status ==2)
            <button type="button" class="btn btn-sm btn-outline-info round">فى الطريق اليه</button>
            @elseif ($order->status ==3)
                    <button type="button" class="btn btn-sm btn-outline-success round">تمت بنجاح</button>
            @endif
        </h5><br>

        <h5><b>Orders :</b></h5>
        <div class="row">

            @foreach ($order->product as $index => $product)
            <div class="col-md-4">
            <div class="card" style="height: 503px;">
                <div class="card-header">
                  <h4 class="card-title">{{ $product->name }}</h4>
                </div>
                <div class="card-content">
                  <img class="img-fluid" src="{{ $product->Images->first()->photo }}" alt="Card image cap">
                  <div class="card-body">
                    <p class="card-text">{{ $product->short_description }}</p>
                    <a href="{{ route('product.show',$product->slug) }}" target="_blank"  class="card-link">Card link</a>
                  </div>
                </div>
                <div class="card-footer border-top-blue-grey border-top-lighten-5 text-muted">
                  <span class="float-left">quantity: {{ $product->pivot->quantity }}</span>
                  <span class="float-right">options: {{ $product->pivot->options ?? '--' }}
                  </span>
                </div>
              </div>
            </div>
            @endforeach
        </div>

        <form class="form" method="POST" action="{{ route('OrderAdmin.update',$order->id) }}">
            @csrf
            @method('PUT')

                <input type="hidden" name="status" value="1">
                <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" > قيد التنفيذ </button>

        </form>
        <br>
        <form class="form" method="POST" action="{{ route('OrderAdmin.update',$order->id) }}">
            @csrf
            @method('PUT')


                <input type="hidden" name="status" value="2">
                <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" > فى الطريق اليه</button>

        </form><br>
        <form class="form" method="POST" action="{{ route('OrderAdmin.update',$order->id) }}">
            @csrf
            @method('PUT')


                <input type="hidden" name="status" value="3">
                <button class="btn btn-danger btn-sm  round  box-shadow-2 px-1"type="submit" >تمت بنجاح </button>

        </form>

        </div>
        </div>
    </div>
  </div>
</div>
@endsection
