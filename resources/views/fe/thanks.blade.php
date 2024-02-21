@extends('fe.layout')
@section('content')
<div class="site-wrap">
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="{{route('fe.home')}}">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Contact</strong></div>
        </div>
      </div>
    </div>
    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Đặt hàng thành công</h2>
            <p class="lead mb-5">Vui lòng check email của bạn để xác nhận đơn hàng.</p>
            <p><a href="http://gmail.com" class="btn btn-sm btn-primary" target="_blank">Email của bạn</a></p>
          </div>
        </div>
      </div>
    </div>


  </div>

@endsection
