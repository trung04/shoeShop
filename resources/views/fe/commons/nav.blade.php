@php
    $brands = App\Models\Brand::all();
@endphp
<nav class="site-navigation text-right text-md-center" role="navigation">
    <div class="container">
        <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class=" ">
                <a href="{{ route('fe.home') }}">Home</a>
            </li>

            @foreach ($categories as $category)
                <li><a href="{{ url('category/' . $category->slug) }}">{{ $category->name }}</a></li>
            @endforeach
            @auth
                <li class=" ">
                    <a href="{{ route('fe.voucher.index') }}">Voucher</a>
                </li>

            @endauth

        </ul>
    </div>
</nav>
