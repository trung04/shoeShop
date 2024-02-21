@extends('fe.layout')
@section('title')
    Bamboshop-Mua giày dép hàng hiệu chính hãng
@endsection
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">

        <div class="carousel-inner">
            @foreach ($sliders as $slider)
                <div class="carousel-item active">
                    <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            {{-- <h1>
                           <span style="color:black">{{$slider->title}}</span>
                        </h1> --}}
                            {{-- <p style="color:black">
                            {{$slider->description}}
                        </p> --}}
                            {{-- <div>
                            <a href="#" class="btn btn-slider">
                                Get Now
                            </a>
                        </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>







    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Sản phẩm mới nhất</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                        @foreach ($newestProducts as $item)
                            <div class="item">
                                <div class="block-4 text-center">
                                    <figure class="block-4-image">
                                        <a href="{{ route('fe.product.detail', $item->slug) }}"><img
                                                src="{{ asset($item->preview->path) }}" alt="{{ $item->name }}"
                                                class="img-fluid"></a>

                                        <div class="card-meta" style="border:1px solid #fff;height:75px;position:relative">
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
                                                        {{ number_format($item->discount_amount, 0, ',', '.') }}Đ <br>Off
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
                                        <h3><a href="{{ route('fe.product.detail', $item->slug) }}">{{ $item->name }}</a>
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

    <div class="site-section block-8">
        <div class="container">
            <div class="row justify-content-center  mb-5">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Big Sale!</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 mb-5">
                    <a href="#"><img src="{{ asset('/fe/images/blog_1.jpg') }}" alt="Image placeholder"
                            class="img-fluid rounded"></a>
                </div>
                <div class="col-md-12 col-lg-5 text-center pl-md-5">
                    <h2><a href="#">50% less in all items</a></h2>
                    <p class="post-meta mb-4">By <a href="#">Carl Smith</a> <span class="block-8-sep">&bullet;</span>
                        September 3, 2018</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quisquam iste dolor accusantium facere
                        corporis ipsum animi deleniti fugiat. Ex, veniam?</p>
                    <p><a href="#" class="btn btn-primary btn-sm">Shop Now</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('style')
    <style>
        .carousel-item .custom-carousel-content {
            width: 50%;
            transform: translate(0%, -10%);
        }

        .custom-carousel-content {
            text-align: start;
        }

        .custom-carousel-content h1 {
            font-size: 40px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 30px;
        }

        .custom-carousel-content h1 span {
            color: #fbff00;
        }

        .custom-carousel-content p {
            font-size: 18px;
            font-weight: 400;
            color: #fff;
            margin-bottom: 30px;
        }

        .custom-carousel-content .btn-slider {
            border: 1px solid #fff;
            border-radius: 0px;
            padding: 8px 26px;
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
    </style>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
