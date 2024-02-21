@extends('fe.layout')
@section('title')
    Giỏ hàng
@endsection
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong
                        class="text-black">Cart</strong></div>
            </div>
        </div>
    </div>
    @if ($cartCount > 0)
        <div class="site-section">
            <div class="container">
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-infor">Infor</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity" style="width:150px">Quantity</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $row)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset($row->options->image_path) }}" alt="Image"
                                                    class="img-fluid">
                                            </td>
                                            <td>
                                                <h2 class="h5 text-black">{{ $row->name }}</h2>
                                            </td>
                                            <td>
                                                <ul style="list-style: none" class="">
                                                    <li>Màu:{{ $row->options->color }}</li>
                                                    <hr>
                                                    <li>Size:{{ $row->options->size }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ number_format($row->price, 0, ',', '.') }}Đ</td>
                                            <td>
                                                <div class="input-group mb-3" style="max-width: 120px;">
                                                    <div class="input-group-prepend">
                                                        <button
                                                            data-url="{{ route('fe.cart.update', $row->rowId) }}"class="buttonMinus btn btn-outline-primary js-btn-minus"
                                                            type="button">&minus;</button>
                                                    </div>
                                                    <input type="text" class="input form-control text-center"
                                                        value="{{ $row->qty }}" placeholder=""
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1">
                                                    <div class="input-group-append">
                                                        <button data-url="{{ route('fe.cart.update', $row->rowId) }}"
                                                            class="buttonPlus btn btn-outline-primary js-btn-plus"
                                                            type="button">&plus;</button>
                                                    </div>
                                                </div>

                                            </td>
                                            <td class="total{{ $row->rowId }}">
                                                {{ number_format($row->total, 0, ',', '.') }}Đ
                                            </td>
                                            <td><button type="button"data-url="{{ route('fe.cart.delete', $row->rowId) }}"
                                                    class="buttonRemove btn btn-primary btn-sm">X</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <a href="{{ route('fe.cart.destroy') }}"class="buttonDestroy btn btn-primary btn-sm btn-block"
                                    style="color:white">Xóa toàn bộ giỏ hàng</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('fe.home') }}"class="btn btn-outline-primary btn-sm btn-block">Continue
                                    Shopping</a>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">

                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Thành tiền</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong
                                            id="total"class="text-black">{{ number_format(Cart::total(), 0, ',', '.') }}Đ</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('fe.order.checkout') }}"class="btn btn-primary"
                                            style="color: white">THANH TOÁN </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="site-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="currentColor"
                            class="bi bi-basket" viewBox="0 0 16 16">
                            <path
                                d="M5.757 1.071a.5.5 0 0 1 .172.686L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1v4.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 13.5V9a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h1.217L5.07 1.243a.5.5 0 0 1 .686-.172zM2 9v4.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V9H2zM1 7v1h14V7H1zm3 3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 4 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 6 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3A.5.5 0 0 1 8 10zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5zm2 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5z" />
                        </svg>
                        <p class="lead mb-5">Bạn không có sản phẩm nào trong giỏ hàng</p>
                        <p><a href="{{ route('fe.home') }}" class="btn btn-sm btn-primary">Tiếp tục mua hàng</a></p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('script')
    <script>
        ///// định dạng lại số tiền
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

        function formatNumber2(number) {
            let num2 = number + "";
            let ans = "";
            for (let i = 0; i < num2.length - 3; i++) {
                ans += num2[i];
            }
            return ans;
        }

        //////
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".buttonRemove").click(function() {
                let url = $(this).attr("data-url");
                let thisClick = $(this);
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(data) {
                        thisClick.closest('tr').remove();
                        let cartTotal = formatNumber(formatNumber2(data.cartTotal));
                        let count = data.count;
                        $("#total").text(cartTotal + "Đ");
                        $("#count").text(count);
                    }
                });
            });

            $(".buttonMinus").click(function() {
                let currentRow = $(this).closest("tr");
                let qty = currentRow.find("td:eq(4) input").val();
                let url = $(this).attr('data-url');
                let data = {
                    'qty': qty
                };
                if (qty == 0) {
                    alert("Bạn có chắc chắn muốn xóa sản phẩm không");
                    window.location.reload();
                    $(this).closest("tr").remove();
                }
                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        // console.log(data.currentCart);
                        let price = data.currentCart["price"];
                        let cartTotal = formatNumber(formatNumber2(data.cartTotal));
                        let count = data.count;
                        let qty = data.currentCart["qty"];
                        let total = formatNumber(price * qty);
                        console.log(total);
                        currentRow.find("td:eq(5)").text(total + "Đ");
                        $("#total").text(cartTotal + "Đ");
                        $("#count").text(count);





                    }
                });


            });


            $(".buttonPlus").click(function() {
                let currentRow = $(this).closest("tr");
                let qty = currentRow.find("td:eq(4) input").val();
                let url = $(this).attr('data-url');
                let data = {
                    'qty': qty
                };

                $.ajax({
                    type: 'post',
                    url: url,
                    data: data,
                    success: function(data) {
                        console.log(data.currentCart);
                        let cartTotal = formatNumber(formatNumber2(data.cartTotal));
                        let count = data.count;
                        let price = data.currentCart["price"];
                        let qty = data.currentCart["qty"];
                        let total = formatNumber(price * qty);
                        // console.log(total);
                        // console.log(cartTotal);
                        console.log(count);
                        currentRow.find("td:eq(5)").text(total + "Đ");
                        $("#total").text(cartTotal + "Đ");
                        $("#count").text(count);



                    }
                });


            });




        })
    </script>
@endsection
