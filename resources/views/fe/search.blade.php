@extends('fe.layout')
@section('content')
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <p>Kết quả tìm kiếm cho {{ $q }}</p>
            </div>
        </div>
    </div>
    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12 order-2 ">
                    <div class="row mb-5">
                        @forelse ($products as $item)
                            <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                                <div class="block-4 text-center border">
                                    <figure class="block-4-image">
                                        <a href="{{ route('fe.product.detail', $item->slug) }}"><img
                                                src="{{ asset($item->preview->path) }}" alt="{{ $item->name }}"
                                                class="img-fluid"></a>
                                    </figure>
                                    <p class="card-meta">
                                        @if ($item->brand)
                                            {{ $item->brand->name }}
                                        @else
                                            No brand
                                        @endif
                                    </p>
                                    <div class="block-4-text p-4">
                                        <h3><a href="{{ route('fe.product.detail', $item->slug) }}">{{ $item->name }}</a>
                                        </h3>
                                        <p class="mb-0"></p>
                                        <p class="text-primary font-weight-bold">
                                            {{ number_format($item->price, 0, '.', '.') }}Đ</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            There are no result match for "{{ $q }}"
                        @endforelse
                    </div>
                    <div class="row" data-aos="fade-up">
                    </div>
                </div>

            </div>

        </div>

    </div>
    {{ $products->links() }}
@endsection
