@extends('fe.layout')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('fe.user.profile') }}">Your Profile</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">My voucher</strong>
                </div>
            </div>
        </div>
    </div>
    <br>


    @if (count($userVoucher) == 0)
        <div style="margin:0px auto;width:300px"> Bạn chưa có phiếu giảm giá nào</div>
    @else
        <div style="padding:0px 200px 0px 200px">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Mã giảm giá</th>
                        <th scope="col">Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userVoucher as $voucher)
                        <tr>
                            @switch($voucher->voucher->type)
                                @case(1)
                                    <th scope="row" style="margin:0px auto">{{ $voucher->voucher->discount_amount }}%</th>
                                @break

                                @case(2)
                                    <th scope="row" style="">{{ $voucher->voucher->discount_amount }}Đ</th>
                                @break

                                @default
                            @endswitch
                            <td>{{ $voucher->quantity }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    @endif
    <br>

    <div class="row">
        <div class="col-md-6" style="margin:0px auto">
            <div class="row mb-5">

                <div class="col-md-6">
                    <a href="{{ route('fe.home') }}"class="btn btn-outline-primary btn-sm btn-block">Continue
                        Shopping</a>
                </div>
                <div class="col-md-6 mb-3 mb-md-0">
                    <a href="{{ route('fe.voucher.index') }}"class="buttonDestroy btn btn-primary btn-sm btn-block"
                        style="color:white">Đổi Voucher</a>
                </div>
            </div>

        </div>

    </div>
@endsection
