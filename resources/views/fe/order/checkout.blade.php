@extends('fe.layout')
@section('title')
    Thanh toán đơn hàng
@endsection
@section('content')
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            @if (Cart::count() > 0)
                <form action="{{ route('fe.order.addOrder') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <h2 class="h3 mb-3 text-black">Thông tin hóa đơn</h2>
                            <input type="hidden" value="<?php if (auth()->user()) {
                                echo auth()->user()->id;
                            } ?>" id="userId" name="user_id">
                            <input type="hidden" value="{{ Cart::total() }}" name="total" id="inputCartTotal">
                            {{-- <input type="hidden" value="1" id="status" name="status"> --}}
                            <input type="hidden" value="{{ Cart::subTotal() }}" name="sub_total">
                            <input type="hidden" value="{{ Cart::tax() }}" name="tax">
                            <input type="hidden" value="" name="userVoucherId" id="inputUserVoucherId">
                            <div class="p-3 p-lg-5 border">
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_companyname" class="text-black">Họ và tên<span class="text-danger">*
                                        </label>
                                        <input type="text" class="form-control" id="full_name" name="name"
                                            placeholder="Họ và tên người nhận">
                                    </div>
                                    @error('name')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_companyname" class="text-black">Email<span class="text-danger">*
                                        </label>
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email nhận thông báo tình trạng đơn hàng">
                                    </div>
                                    @error('email')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_companyname" class="text-black">Điện thoại người nhận<span
                                                class="text-danger">*</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                            placeholder="Vui lòng nhập chính xác số điện thoại">
                                    </div>
                                    @error('phone')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_companyname" class="text-black">Số điện thoại 2<span
                                                class="text-danger">*
                                        </label>
                                        <input type="text" class="form-control" id="phone2" name="phone2"
                                            placeholder="Trường hợp SDT người nhận không thể liên lạc hoặc bị sai">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="province" class="text-black">Tỉnh/Thành Phố <span
                                            class="text-danger">*</span></label>
                                    <select id="province" class="form-control"
                                        data-url="{{ route('fe.order.filterDistrict') }}" name="province_id">
                                        <option value="">Vui lòng chọn</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach

                                    </select>
                                    @error('province_id')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group row mb-5">
                                    <div class="col-md-6">
                                        <label for="district" class="text-black" name="district">Quận/Huyện<span
                                                class="text-danger">*</span></label>
                                        <select id="district" class="form-control"
                                            data-url="{{ route('fe.order.filterWard') }}" name="district_id">
                                            <option value="">Vui lòng chọn </option>
                                        </select>
                                        @error('district_id')
                                            <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="ward" class="text-black" name="ward">Phường/Xã<span
                                                class="text-danger">*</span></label>
                                        <select name="ward_id" id="ward" class="form-control">
                                            <option value="">Vui lòng chọn</option>
                                        </select>
                                        @error('ward_id')
                                            <p style="color:red">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_address" class="text-black">Địa chỉ chi tiết <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Tên đường,xóm,số nhà">
                                    </div>
                                    @error('address')
                                        <p style="color:red">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="c_order_notes" class="text-black">Ghi chú</label>
                                    <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Ghi chú"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            @auth
                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <h2 class="h3 mb-3 text-black">Voucher giảm giá</h2>
                                        <div class="p-3 p-lg-5 border">

                                            <label for="c_code" class="text-black mb-3">Chọn:</label>
                                            <div class="input-group w-75">
                                                <select name="" id="userVoucherId"class="form-control">
                                                    <option value="0">Choose one</option>
                                                    @foreach ($userVoucher as $voucher)
                                                        <option value="{{ $voucher->id }}">
                                                            @switch($voucher->voucher->type)
                                                                @case(1)
                                                                    {{ $voucher->voucher->discount_amount }}%
                                                                    <span>({{ $voucher->quantity }})</span>
                                                                @break

                                                                @case(2)
                                                                    {{ $voucher->voucher->discount_amount }}Đ
                                                                @break

                                                                @default
                                                            @endswitch
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @php
                                                    $check = 0;
                                                @endphp
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary btn-sm" type="button" id="buttonApply"
                                                        data-url="{{ route('fe.order.applyVoucher', ['check' => $check]) }}">Apply</button>
                                                </div>
                                                <div class="input-group-append" id="buttonCancel"
                                                    data-url="{{ route('fe.order.cancelApplyVoucher') }}">

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            @endauth




                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <h2 class="h3 mb-3 text-black">Your Order</h2>
                                    <div class="p-3 p-lg-5 border">
                                        <table class="table site-block-order-table mb-5">
                                            <thead>
                                                <th>Product</th>
                                                <th>Total</th>
                                            </thead>
                                            <tbody>
                                                @foreach (Cart::content() as $product)
                                                    <tr>
                                                        <td>{{ $product->name }} <strong
                                                                class="mx-2">x</strong>{{ $product->qty }}</td>
                                                        <td>{{ number_format($product->total, 0, ',', '.') }}Đ</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Tạm tính</strong></td>
                                                    <td id="subTotal"class="text-black font-weight-bold"
                                                        value="{{ Cart::subTotal() }}">
                                                        <strong>{{ number_format(Cart::subTotal(), 0, ',', '.') }}Đ</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Phí ship vận
                                                            chuyển</strong>
                                                    </td>
                                                    <td class="text-black font-weight-bold"><strong>0Đ</strong></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Giảm giá</strong>
                                                    </td>
                                                    <td class="text-black font-weight-bold" id="discount">
                                                        <strong>0Đ</strong>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Order Total</strong>
                                                    </td>
                                                    <td id="cartTotal" value="{{ Cart::total() }}"
                                                        class="text-black font-weight-bold">
                                                        <strong>{{ number_format(Cart::total(), 0, ',', '.') }}Đ</strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <fieldset>
                                            <legend><strong>Chọn phương thức thanh toán:</strong></legend>
                                            @foreach ($payments as $payment)
                                                <div>
                                                    <input type="radio" id="{{ $payment->name }}" name="payment_type"
                                                        value="{{ $payment->id }}" checked />
                                                    <label for="{{ $payment->name }}">{{ $payment->name }}</label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-lg py-3 btn-block" id="buttonOrder">Đặt
                                                hàng</button>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            @else
                <div class="site-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                    fill="currentColor" class="bi bi-basket" viewBox="0 0 16 16">
                                    <path
                                        d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                                </svg>
                                <p class="lead mb-5">Bạn không có sản phẩm nào trong giỏ hàng</p>
                                <p><a href="{{ route('fe.home') }}" class="btn btn-sm btn-primary">Tiếp tục mua hàng</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- </form> -->
        </div>
    </div>
@endsection
@section('script')
    <script>
        //định dạng tiền
        function formatNumber(number) {
            let num2 = number + "";
            let dem = 0;
            let tmp = "";
            let ans = "";
            for (let i = num2.length - 1; i >= 0; i--) {
                tmp += num2[i];
                dem++;
                if (dem % 3 == 0) {
                    tmp += ".";
                }
            }
            for (let i = tmp.length - 1; i >= 0; i--) {
                ans += tmp[i];
            }
            if (ans[0] == '.') {
                ans = ans.replace('.', '');
            }
            return ans;
        }



        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#buttonApply").click(function() {
                let userVoucherId = $("#userVoucherId").val();
                let url = $(this).attr("data-url");
                let data = {
                    'userVoucherId': userVoucherId,
                };
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        alert(data.message);
                        let discount = formatNumber(data.discount);
                        let cartTotal = formatNumber(data.total);
                        $('#discount').text(discount + "Đ");
                        $('#cartTotal').text(cartTotal + "Đ");
                        $('#inputCartTotal').val(data.total);
                        $('#inputUserVoucherId').val(data.userVoucherId);
                        console.log(data);
                        let html =
                            '<button class="btn btn-danger btn-sm" type="button" >Cancle apply</button>'
                        $("#buttonCancel").html(html);
                    }
                })
                // alert(userVoucherId);
            });
            // xử lý nút hủy áp dụng voucher
            $("#buttonCancel").click(function() {
                let url = $(this).attr("data-url");
                $.ajax({
                    type: 'post',
                    url: url,
                    success: function(data) {
                        alert(data.message);
                        let discount = "0Đ";
                        let cartTotal = formatNumber(data.total);
                        $('#discount').text(discount + "Đ");
                        $('#cartTotal').text(cartTotal + "Đ");
                        $('#inputCartTotal').val(data.total);
                        $('#inputUserVoucherId').val(null);
                        $("#buttonCancel").html("");
                    }
                })


            });
            $("#province").change(function() {
                let provinceId = $(this).val();
                let url = $(this).attr("data-url");
                let data = {
                    'provinceId': provinceId,
                };

                $.ajax({
                    type: 'get',
                    url: url,
                    data: data,
                    success: function(data) {
                        let districts = data.districts;
                        let html = '<option value="">Vui lòng chọn</option>';
                        if (districts.length > 0) {
                            for (let i = 0; i < districts.length; i++) {
                                html +=
                                    '<option value="' + districts[i]["id"] + '">' + districts[i]
                                    ["name"] + '</option>'
                            }
                        }
                        $("#district").html(html);
                    }
                });
            });
            $("#district").change(function() {
                let districtId = $(this).val();
                let url = $(this).attr("data-url");
                let data = {
                    'districtId': districtId
                };
                $.ajax({
                    type: 'get',
                    url: url,
                    data: data,
                    success: function(data) {
                        let wards = data.wards;
                        let html = '<option value="">Vui lòng chọn</option>';
                        if (wards.length > 0) {
                            for (let i = 0; i < wards.length; i++) {
                                html +=
                                    '<option value="' + wards[i]["id"] + '">' + wards[i][
                                        "name"
                                    ] + '</option>'
                            }
                        }
                        $("#ward").html(html);
                    }
                });
            });


        })
    </script>
@endsection
