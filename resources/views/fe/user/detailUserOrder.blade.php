@extends('fe.layout')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="{{ route('fe.user.profile') }}">Your Profile</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">Chi tiết đơn hàng</strong>
                    <a href="{{ route('fe.user.userOrder') }}" class="float-right">Quay lại</a>
                </div>
            </div>
        </div>
    </div>
    <br>

    <section class="content" style="padding:0px 200px 0px 200px">
        <div class="container-fluid" style="border:1px solid black">
            <div class="row">
                <div class="invoice p-3 m-auto" style="width:90%">

                    {{-- <div class="row">
                        <div class="col-12">
                            <h4>
                                <i class="fas fa-globe"></i> AdminLTE, Inc.
                            </h4>
                        </div>

                    </div> --}}

                    <div class="row invoice-info">


                        <div class="col-sm-4 invoice-col">
                            <p style="font-size: 30px">Receiver Info:</p>
                            <address>
                                -Họ và tên:<strong>{{ $order->name }}</strong><br>
                                -Địa chỉ : {{ $order->address }}<br>
                                -{{ $order->ward->name }},{{ $order->district->name }},Tỉnh
                                {{ $order->province->name }}.<br>
                                -Phone: {{ $order->phone }}<br>
                                -Phone(dự phòng):@if ($order->phone2)
                                    {{ $order->phone2 }}
                                @else
                                    <p>Không có</p>
                                @endif <br>
                                -Email: {{ $order->email }}<br>
                                -Note: {{ $order->note }}
                            </address>
                        </div>

                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #{{ $order->id }}</b><br>
                            <br>
                            <b>Trạng thái: @switch($order->status)
                                    @case(0)
                                        <span class="badge badge-dark">Waiting For Confirm</span>
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
                            </b> <br>
                            <b>Date:</b>{{ $order->created_at }}<br>
                            {{-- <b>Account:</b> 968-34567 --}}
                        </div>

                    </div>

                    <p style="font-size: 30px">Order Info:</p>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Image</th>
                                        <th>Size</th>
                                        <th>Màu</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Tổng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderProducts as $orderProduct)
                                        <tr>
                                            <td>{{ $orderProduct->product->name }}</td>
                                            <td><img src="{{ asset($orderProduct->product->preview->path) }}"
                                                    alt="" style="width:40px;height:40px">
                                            </td>
                                            <td>{{ $orderProduct->size }}</td>
                                            <td>{{ $orderProduct->color }}</td>
                                            <td>{{ number_format($orderProduct->price, 0, ',', '.') }}Đ</td>
                                            <td>{{ $orderProduct->quantity }}</td>
                                            <td>{{ number_format($orderProduct->total, 0, ',', '.') }}Đ</td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="row">

                        {{-- <div class="col-6">
                            <p class="lead">Payment Methods:</p>
                            <img src="../../dist/img/credit/visa.png" alt="Visa">
                            <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                            <img src="../../dist/img/credit/american-express.png" alt="American Express">
                            <img src="../../dist/img/credit/paypal2.png" alt="Paypal">
                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya
                                handango imeem
                                plugg
                                dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                            </p>
                        </div> --}}

                        <div class="col-6">
                            <p class="lead"><span data-lemma="amount" data-pos="NOUN" data-genre="WyJHRU5FUkFMIl0="
                                    data-clicked="true" data-track="d7e48233-7f34-41b8-86a0-1a0ec50add89"
                                    class="elia_highlightedItem active activated" data-hover="Click to learn"
                                    style="      --elia-color:rgb(33, 37, 41);      --elia-color-back:rgba(33,37,41,0.1);      --elia-color-back-hover:rgba(33,37,41,0.15);    ">Amount
                                    <div class="highlightCircle"></div>
                                    <div class="elia-bg-highlight"></div>
                                    <div class="elia-hoverAction">
                                        <div class="elia-actions">
                                            <span class="elia-iknow" data-text="I know this"></span>
                                            <span class="elia-actionStart" data-text="Learn"></span>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td>{{ number_format($order->sub_total, 0, ',', '.') }}Đ</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax :</th>
                                                    <td>{{ number_format($order->tax, 0, ',', '.') }}Đ</td>
                                                </tr>
                                                <tr>
                                                    <th>Discount :</th>
                                                    <td>{{ number_format($order->sub_total - $order->total, 0, ',', '.') }}Đ
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>{{ number_format($order->total, 0, ',', '.') }}Đ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                        </div>

                    </div>
                    <div class="card-footer clearfix">


                        {{-- <div class="row no-print">
                        <div class="col-12">
                            <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                    class="fas fa-print"></i> Print</a>
                            <button type="button"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right"><i
                                    class="far fa-credit-card"></i> Submit
                                Payment
                            </button>
                            <button type="button"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right"
                                style="margin-right: 5px;">
                                <i class="fas fa-download"></i> Generate PDF
                            </button>
                        </div>
                    </div> --}}
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
