@extends('fe.layout')
@section('title')
@endsection
@section('content')
    <h1>My Voucher</h1>
    <form class="col-md-12" method="post" action="{{ route('fe.voucher.redeemVoucher') }}">
        @csrf
        <div class="bg-light py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-0">
                        <a href="{{ route('fe.home') }}">Home</a> <span class="mx-2 mb-0">/</span>
                        <strong class="text-black">Voucher</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="site-blocks-table">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Chọn</th>
                                    <th class="product-name">Mã giảm giá</th>
                                    <th class="product-price">Coin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vouchers as $voucher)
                                    <tr>
                                        <td class="#">
                                            <input type="checkbox" name="listId[]" id=""
                                                value="{{ $voucher->id }}">
                                        </td>
                                        <td class="product-name">
                                            @switch($voucher->type)
                                                @case(1)
                                                    <h2 class="h5 text-black">{{ $voucher->discount_amount }}%</h2>
                                                @break

                                                @case(2)
                                                    <h2 class="h5 text-black">{{ $voucher->discount_amount }}đồng</h2>
                                                @break

                                                @default
                                            @endswitch
                                        </td>
                                        <td>{{ number_format($voucher->coin, 0, ',', '.') }}<svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="green" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 5a5.002 5.002 0 0 0 4.027 4.905 6.46 6.46 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05c0-.046 0-.093.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.46 3.46 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98c-.003.046-.003.097-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5m16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0m-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674z" />
                                            </svg></td>

                                    </tr>
                                @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <button class="btn btn-primary btn-sm btn-block" type="submit">Đổi</button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('fe.home') }}"class="btn btn-outline-primary btn-sm btn-block">Continue
                                    Shopping</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('fe.user.userVoucher') }}"class="btn btn-outline-primary btn-sm btn-block">My
                            Voucher</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
