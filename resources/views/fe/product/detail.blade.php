@extends('fe.layout')
@section('title')
    {{ $product->meta_title }}
@endsection
@section('meta_keyword')
    {{ $product->meta_keyword }}
@endsection
@section('meta_description')
    {{ $product->meta_description }}
@endsection

@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="{{ route('fe.home') }}">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $product->name }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class = "product-imgs">
                        <div class = "img-display">
                            <div class = "img-showcase">
                                @foreach ($product->images as $image)
                                    <img src = "{{ asset($image->path) }}" alt = "shoe image">
                                @endforeach
                            </div>
                        </div>
                        @php
                            $id = 0;
                        @endphp
                        <div class = "img-select">
                            @foreach ($product->images as $image)
                                <div class = "img-item">
                                    <a href = "#" data-id = "{{ ++$id }}">
                                        <img src = "{{ asset($image->path) }}" alt = "shoe image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>


                </div>

                <div class="col-md-6">

                    <div class="px-4 text-white "
                        style="background-color:black;border-radius:26px;width:145px;margin-bottom:5px">
                        Free Shipping
                    </div>

                    <h2 class="text-black">{{ $product->name }}</h2>
                    <ul style="list-style:square">
                        <li><strong style="color:black;">Brand</strong> :
                            @if ($product->brand)
                                {{ $product->brand->name }}
                            @else
                                No brand
                            @endif
                        </li>
                        <li><strong style="color:black">Kiểu dáng</strong> : {{ $product->type->name }}</li>
                        <li><strong style="color:black">Thể loại</strong> : {{ $product->category->name }}</li>
                    </ul>
                    <p><span style="font-size: 20px">Đánh giá:</span>{{ number_format($avgStar, 2, ',', ' ') }}/5 <svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" color="orange"
                            fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path
                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                        </svg></p>
                    <p>{{ $product->short_description }}</p>
                    <p class="mb-4" style="font-family:sans-serif;color:grey">{{ $product->content }}</p>
                    <p><strong class="text-primary h4">
                            @if ($product->discount_amount)
                                @switch($product->discount_type)
                                    @case(1)
                                        <span class="text-primary font-weight-bold">
                                            {{ number_format(($product->price * (100 - $product->discount_amount)) / 100, 0, '.', '.') }}Đ</span>
                                        <span class="text-sm" style="text-decoration-line:line-through">
                                            <small>{{ number_format($product->price, 0, '.', '.') }}Đ</small></span>
                                    @break

                                    @case(2)
                                        <span class="text-primary font-weight-bold">
                                            {{ number_format($product->price - $product->discount_amount, 0, '.', '.') }}Đ</span>
                                        <span class="text-sm" style="text-decoration-line:line-through">
                                            <small>{{ number_format($product->price, 0, '.', '.') }}Đ</small></span>
                                    @break
                                @endswitch
                            @else
                                <p class="text-primary font-weight-bold">
                                    {{ number_format($product->price, 0, '.', '.') }}Đ</p>
                            @endif
                        </strong></p>

                    <div class="flex flex-column">
                        {{-- chọn size --}}
                        <section class="flex items-center" style="margin-bottom: 24px; align-items: baseline;">
                            <h3 class="">Size :</h3>
                            <div class="flex items-center bR6mEk">
                                <div id="sizeTable"class="btn-group me-2" role="group" aria-label="First group">
                                    @foreach ($sizes as $size)
                                        <button type="button" name="size" id="buttonSize{{ $size->id }}"
                                            class="buttonSize btn btn-outline-secondary "
                                            value="{{ $size->id }}">{{ $size->size }}</button>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                        {{-- chọn màu --}}

                        <section class="flex items-center" style="margin-bottom: 24px; align-items: baseline;">
                            <h3 class="">Color :</h3>
                            <div class="flex items-center bR6mEk" id="colorTable">
                                Vui lòng chọn size

                            </div>

                        </section>
                    </div>


                    <div class="mb-5">
                        <h3>Số lượng :</h3>
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" id="quantity" class="form-control text-center" value="1"
                                placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>

                    </div>
                    <p><button data-url="{{ route('fe.cart.doAdd', $product->id) }}" type="button" id="buttonAddToCart"
                            class="buy-now btn btn-sm btn-primary" style="margin-right:50px">Add
                            To Cart</button>
                        <button data-url="{{ route('fe.cart.doAdd', $product->id) }}" type="button" id="buttonBuy"
                            class="buy-now btn btn-sm btn-primary">Mua Ngay
                        </button>

                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($relevantProducts != [])
        <div class="site-section block-3 site-blocks-2 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7 site-section-heading text-center pt-4">
                        <h2>Bạn có thể thích</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="nonloop-block-3 owl-carousel">
                            @foreach ($relevantProducts as $item)
                                <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">
                                            <a href="{{ route('fe.product.detail', $item->slug) }}"><img
                                                    src="{{ asset($item->preview->path) }}" alt="{{ $item->name }}"
                                                    class="img-fluid"></a>

                                            <div class="card-meta"
                                                style="border:1px solid #fff;height:75px;position:relative">
                                                @if ($item->discount_type == 1)
                                                    @if ($item->discount_amount)
                                                        <div class="coupon"
                                                            style="width:50px;height:50px;background:red;color:white;position:absolute;left:0px ">
                                                            {{ $item->discount_amount }}% <br>Off</div>
                                                    @endif
                                                @else
                                                    @if ($item->discount_amount)
                                                        <div class="coupon"
                                                            style="width:50px;height:50px;background:red;color:white">
                                                            {{ number_format($item->discount_amount, 0, ',', '.') }}Đ
                                                            <br>Off
                                                        </div>
                                                    @endif
                                                @endif
                                                <p style="margin-top:20px">
                                                    @if ($item->brand)
                                                        {{ $item->brand->name }}
                                                    @else
                                                        No brand
                                                    @endif
                                                </p>
                                            </div>

                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a
                                                    href="{{ route('fe.product.detail', $item->slug) }}">{{ $item->name }}</a>
                                            </h3>
                                            <p class="mb-0"></p>
                                            @if ($item->discount_amount)
                                                @switch($item->discount_type)
                                                    @case(1)
                                                        <span class="text-primary font-weight-bold">
                                                            {{ number_format(($item->price * (100 - $item->discount_amount)) / 100, 0, '.', '.') }}Đ</span>
                                                        <span class="" style="text-decoration-line:line-through">
                                                            <small>{{ number_format($item->price, 0, '.', '.') }}Đ</small></span>
                                                    @break

                                                    @case(2)
                                                        <span class="text-primary font-weight-bold">
                                                            {{ number_format($item->price - $item->discount_amount, 0, '.', '.') }}Đ</span>
                                                        <span class="" style="text-decoration-line:line-through">
                                                            <small>{{ number_format($item->price, 0, '.', '.') }}Đ</small></span>
                                                    @break
                                                @endswitch
                                            @else
                                                <p class="text-primary font-weight-bold">
                                                    {{ number_format($item->price, 0, '.', '.') }}Đ</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div>
        <div class="" style="display:flex;justify-content:space-evenly;height:1000px">
            <div style="width:50%">
                <h1 style="color:black">Khách hàng đánh giá</h1>
                @foreach ($comments as $comment)
                    <div class="card">
                        <div class="card-body">
                            <img src="" alt="">
                            <span>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $comment->rate)
                                        <i class="fa fa-star checked"></i>
                                    @else
                                        <i class="star fa fa-star"></i>
                                    @endif
                                @endfor
                            </span>
                            <h5 class="card-title">
                                <div style="display:flex">
                                    @if (isset($comment->user->path))
                                        <img src="{{ asset($comment->user->path) }}"
                                            alt=""style="width:40px;height:40px;border-radius:100%">
                                        <span style="color:black;font-size:25px">{{ $comment->user->name }}</span>
                                    @else
                                        <span style="color:black;font-size:25px">{{ $comment->user->name }}(<small>Khách
                                                vãng
                                                lai</small>)</span>
                                    @endif



                                </div>
                                <small style="font-size: small">on
                                    {{ $comment->created_at->diffForHumans() }}</small>
                            </h5>
                            <p class="card-text" style="color: black">{{ $comment->content }}</p>
                        </div>
                    </div>
                @endforeach
                {{ $comments->links() }}

            </div>
            <div style="border:width:50%;" id="commentTable">
                <form action="" class="review-form" method="post">
                    @csrf
                    <div class="star-container" style="margin-top:170px;margin-right:100px">
                        <p style="font-size: 20px;margin-left:190px;">Đánh giá sản phẩm:</p>
                        <div class="rating-wrap">
                            <fieldset class="rating" id="tableStar">
                                <input type="radio" id="star5" name="rate" value="5" /><label
                                    for="star5" class="full" title="Awesome"></label>
                                <input type="radio" id="star4" name="rate" value="4" /><label
                                    for="star4" class="full"></label>
                                <input type="radio" id="star3" name="rate" value="3" /><label
                                    for="star3" class="full"></label>
                                <input type="radio" id="star2" name="rate" value="2" /><label
                                    for="star2" class="full"></label>
                                <input type="radio" id="star1" name="rate" value="1" /><label
                                    for="star1" class="full"></label>
                            </fieldset>
                        </div>
                    </div>
                    <div class="" style="margin-left:190px;margin-top:29px;">
                        <h4 class="text-uppercase">Write Your Review:</h4>
                        <div class="form-group">

                            <textarea class="input" id="" cols="60" rows="5" placeholder="Your Review" name="content"
                                id="contentText"></textarea>
                        </div>
                        @auth
                            <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" id="user_id">
                            <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
                        @endauth
                        @guest
                            <h5>Thông tin cá nhân của bạn(thông tin sẽ được bảo mật)</h5>
                            <input type="hidden" name="role_id" value="2" id="roleId">
                            <div class="form-group">
                                <input type="hidden" value="{{ $product->id }}" name="product_id" id="product_id">
                                <input type="text" class="input" placeholder="Your Name" style="width:450px"
                                    name="name" id="name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="input" placeholder="Your Phone" style="width:225px"
                                    name="phone" id="phone">
                                <input type="email" class="input" placeholder="Email Address" style="width:225px"
                                    name="email" id="email">
                            </div>
                        @endguest
                        <button type="button" data-url="{{ route('fe.comment.doAdd') }}"
                            class="buttonRate btn btn-dark">Gửi nhận xét</button>
                    </div>
                </form>

            </div>


        </div>
    @endsection
    @section('link')
        <link rel="stylesheet" href="{{ asset('fe/detailProduct/style.css') }}">
    @endsection
    @section('script')
        <script src="{{ asset('fe/detailProduct/script.js') }}"></script>
        <script>
            let star = document.querySelectorAll('input');
            let showValue = document.querySelector('#rating-value');

            for (let i = 0; i < star.length; i++) {
                star[i].addEventListener('click', function() {
                    i = this.value;
                });
            }
        </script>
        <script>
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                ////thêm sản phẩm vào giỏ hàng
                $('#buttonAddToCart').click(function() {
                    let url = $(this).attr('data-url');
                    let quantity = $('#quantity').val();
                    let sizeId = $('#sizeTable').find('.active').val();
                    let colorId = $('#colorTable').find('.active').val();
                    if (sizeId == null) {
                        alert('Bạn cần chọn Size')
                        return false;
                    }
                    if (colorId == null) {
                        alert('Bạn cần chọn màu');
                        return false;
                    }
                    // alert(colorId);
                    // alert(colorId);
                    // alert(url);
                    // alert(quantity);
                    data = {
                        'sizeId': sizeId,
                        'quantity': quantity,
                        'colorId': colorId
                    };
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        success: function(data) {
                            // window.location.href = "/cart/list";
                            let cartCount = data.cartCount;
                            // console.log(cartCount);
                            alert("Thêm giỏ hàng thành công");
                            // console.log(data.imagePath);
                            // console.log(data.product);
                            // console.log(data.test);
                            $("#count").text(cartCount);


                        }
                    });
                });


                ///////Mua ngay
                $('#buttonBuy').click(function() {
                    let url = $(this).attr('data-url');
                    let quantity = $('#quantity').val();
                    let sizeId = $('#sizeTable').find('.active').val();
                    let colorId = $('#colorTable').find('.active').val();

                    if (sizeId == null) {
                        alert('Bạn cần chọn Size')
                        return false;
                    }
                    if (colorId == null) {
                        alert('Bạn cần chọn màu');
                        return false;
                    }
                    // alert(colorId);
                    // alert(colorId);
                    // alert(url);
                    // alert(quantity);
                    data = {
                        'sizeId': sizeId,
                        'quantity': quantity,
                        'colorId': colorId
                    };
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        success: function(data) {
                            window.location.href = "/cart/list";

                        }
                    });
                });
                $(document).on('click', '.buttonSize', function() {
                    $(this).parent().find('.active').removeClass('active');
                    $(this).addClass('active');
                    let sizeId = $(this).val();
                    let data = {
                        'sizeId': sizeId,
                    };
                    // alert(sizeId);
                    $.ajax({
                        type: 'get',
                        url: "{{ route('fe.product.filterCurrentColor', $product->id) }}",
                        data: data,
                        success: function(data) {
                            // console.log(data);
                            let colors = data.currentColors;
                            ////lấy ra các màu
                            let html = '';
                            if (colors.length > 0) {
                                for (let i = 0; i < colors.length; i++) {

                                    html +=
                                        '<button type ="button" value="' + colors[i]['id'] +
                                        '" id="buttonColor"class="buttonColor text-gray-800 font-semibold btn btn-outline-secondary"  style="margin-right:3px">' +
                                        colors[i]['name'] + '</button>';
                                }
                            }
                            $("#colorTable").html(html);
                            $("#colorTable button").click(function() {
                                $(this).parent().find('.active').removeClass('active');
                                $(this).addClass('active');
                            });



                        }

                    });
                });


                $(".buttonRate").click(function() {
                    let product_id = $("#product_id").val();
                    let content = $("textarea").val();
                    let user_id = $("#user_id").val();
                    let rate = $("input:radio[name='rate']:checked").val();
                    let url = $(this).attr('data-url');

                    if (rate == null) {
                        alert("bạn cần phải đánh giá sản phẩm");
                        return false;
                    }

                    let data = {
                        'product_id': product_id,
                        'user_id': user_id,
                        'content': content,
                        'rate': rate,
                    };
                    console.log(data);
                    if (user_id == undefined) {
                        let role_id = $("#roleId").val();
                        let name = $("#name").val();
                        let phone = $("#phone").val();
                        let email = $("#email").val();
                        data = {
                            'product_id': product_id,
                            'content': content,
                            'role_id': role_id,
                            'name': name,
                            'email': email,
                            'phone': phone,
                            'rate': rate
                        }
                        if (name == '' || email == '' || phone == '') {
                            alert("bạn cần phải điền đầy đủ thông tin");
                            return false;
                        }
                    }
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        success: function(data) {
                            $("#commentTable").html("<h1>Cảm ơn bạn đã đánh giá sản phẩm</h1>")
                        }
                    });



                });








            })
        </script>
    @endsection
    @section('style')
        <style>
            @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css);

            .checked {
                color: orange;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html,
            body {
                width: 100%;
                height: 100%;
            }


            .star-container {
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100%;
            }

            .rating-wrap {
                max-width: 480px;
                padding: 15px;
                margin-bottom: 7px;
                text-align: center;

            }

            .center {
                width: 162px;
                margin: auto;
            }


            #rating-value {
                width: 110px;
                margin: 40px auto 0;
                padding: 10px 5px;
                text-align: center;
                box-shadow: inset 0 0 2px 1px rgba(46, 204, 113, .2);
            }

            /*styling star rating*/
            .rating {
                border: none;
                float: left;
            }

            .rating>input {
                display: none;
            }

            .rating>label:before {
                content: '\f005';
                font-family: FontAwesome;
                margin: 5px;
                font-size: 1.5rem;
                display: inline-block;
                cursor: pointer;
            }

            .rating>.half:before {
                content: '\f089';
                position: absolute;
                cursor: pointer;
            }


            .rating>label {
                color: #ddd;
                float: right;
                cursor: pointer;
            }

            .rating>input:checked~label,
            .rating:not(:checked)>label:hover,
            .rating:not(:checked)>label:hover~label {
                color: orange;
            }

            .rating>input:checked+label:hover,
            .rating>input:checked~label:hover,
            .rating>label:hover~input:checked~label,
            .rating>input:checked~label:hover~label {
                color: orange;
            }
        </style>
    @endsection
