@extends('fe.layout')
@section('title')
    {{ $category->meta_title }}
@endsection
@section('meta_keyword')
    {{ $category->meta_keyword }}
@endsection
@section('meta_description')
    {{ $category->meta_description }}
@endsection
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0">
                    <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
                    <strong class="text-black">{{ $category->name }}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container ">
            <div class="row mb-5  justify-content-center">
                <div class="col-md-9 order-2">

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            @include('fe.commons.filter')
                        </div>
                    </div>
                    <div class="row mb-5  ">
                        @forelse ($lists as $item)
                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <div class="block-4 text-center border">
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
                                                    <p>No brand</p>
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
                            @empty
                                No available product
                            @endforelse
                        </div>
                        {{ $lists->links() }}

                        <div class="row" data-aos="fade-up">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    @endsection
