<?php
use Carbon\Carbon;

?>
@extends('fe.layout')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('fe.user.profile') }}">Your Profile</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Your Order</strong>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div style="padding:0px 200px 0px 200px">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Giá trị</th>
                    <th scope="col">Hình thức thanh toán</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Đơn hàng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userOrder as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ Carbon::parse($order->created_at)->toDateString() }}</td>
                        <td>{{ number_format($order->total, 0, ',', '.') }}Đ </td>
                        <td>
                            @switch($order->payment_type)
                                @case(1)
                                    Thanh toán sau khi nhận hàng
                                @break

                                @case(2)
                                    Chuyển khoản sau khi nhận hàng
                                @break

                                @case(3)
                                    Thanh toán online qua ngân hàng
                                @break

                                @default
                            @endswitch
                        </td>
                        <td>
                            @switch($order->status)
                                @case(0)
                                    <span class="badge badge-dark">Waiting for confirm</span>
                                @break

                                @case(1)
                                    <span class="badge badge-warning">Pending</span>
                                @break

                                @case(2)
                                    <span class="badge badge-primary">Processing</span>
                                @break

                                @case(3)
                                    <span class="badge badge-success">Success</span>
                                @break

                                @case(4)
                                    <span class="badge badge-danger">Canceled</span>
                                @break
                            @endswitch

                        </td>
                        <td>
                            <a href="{{ route('fe.user.detailUserOrder', $order->id) }}" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $userOrder->links() }}

    </div>
@endsection
