@php
    use App\Models\UserCart;
    use App\Models\Notification;
    use App\Models\User;
    $cartCount = 0;
    if (Auth::check()) {
        $cartCount = UserCart::where('user_id', Auth::user()->id)->sum('quantity');
        $user = User::where('id', Auth::user()->id)->first();
        $coin = $user->coin;
    } else {
        $cartCount = Cart::count();
    }
    if (Auth::check()) {
        $notification = Notification::where('user_id', Auth::user()->id)
            ->where('status', 0)
            ->count();
    }

@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="description" content="@yield('meta_description')">
    <meta name="author" content="Nguyễn Trung">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700">
    <link rel="stylesheet" href="{{ asset('fe/fonts/icomoon/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('fe/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('fe/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/owl.theme.default.min.css') }}">
    @yield('link')
    <link rel="stylesheet" href="{{ asset('fe/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('fe/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            <div class="site-navbar-top">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
                            <form action="{{ route('fe.home.search') }}" class="site-block-top-search">
                                <span class="icon icon-search2"></span>
                                <input type="text" class="form-control border-0" placeholder="Search" name="search">
                            </form>
                        </div>

                        <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
                            <div class="site-logo">
                                <a href="{{ route('fe.home') }}" class="js-logo-clone">BamBo Shop</a>
                            </div>
                        </div>

                        <div class="col-6 col-md-4 order-3 order-md-3 text-right">
                            <div class="site-top-icons">
                                <ul>

                                    @auth
                                        @if (asset(auth()->user()->path))
                                            <li><a href="{{ route('fe.user.profile') }}"><img
                                                        src="{{ asset(auth()->user()->path) }}" alt=""
                                                        style="width:30px;height:30px;border-radius:100%"></a></li>
                                        @else
                                            <li><a href="{{ route('fe.user.profile') }}"><img
                                                        src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                        alt=""
                                                        style="width:30px;height:30px;border-radius:100%"></a></li>
                                        @endif
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                                            in</a>
                                        <a href="{{ route('register') }}"
                                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                                    @endauth
                                    @auth
                                        <li>
                                            <span style="border:1px solid black;padding:2px;border-radius:10px">
                                                Xu: {{ number_format($coin, 0, ',', '.') }}<svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="green" class="bi bi-currency-exchange" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 5a5.002 5.002 0 0 0 4.027 4.905 6.46 6.46 0 0 1 .544-2.073C3.695 7.536 3.132 6.864 3 5.91h-.5v-.426h.466V5.05c0-.046 0-.093.004-.135H2.5v-.427h.511C3.236 3.24 4.213 2.5 5.681 2.5c.316 0 .59.031.819.085v.733a3.46 3.46 0 0 0-.815-.082c-.919 0-1.538.466-1.734 1.252h1.917v.427h-1.98c-.003.046-.003.097-.003.147v.422h1.983v.427H3.93c.118.602.468 1.03 1.005 1.229a6.5 6.5 0 0 1 4.97-3.113A5.002 5.002 0 0 0 0 5m16 5.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0m-7.75 1.322c.069.835.746 1.485 1.964 1.562V14h.54v-.62c1.259-.086 1.996-.74 1.996-1.69 0-.865-.563-1.31-1.57-1.54l-.426-.1V8.374c.54.06.884.347.966.745h.948c-.07-.804-.779-1.433-1.914-1.502V7h-.54v.629c-1.076.103-1.808.732-1.808 1.622 0 .787.544 1.288 1.45 1.493l.358.085v1.78c-.554-.08-.92-.376-1.003-.787zm1.96-1.895c-.532-.12-.82-.364-.82-.732 0-.41.311-.719.824-.809v1.54h-.005zm.622 1.044c.645.145.943.38.943.796 0 .474-.37.8-1.02.86v-1.674z" />
                                                </svg>


                                        </li>



                                    @endauth


                                    <li>
                                        <a href="{{ route('fe.cart.list') }}" class="site-cart">
                                            <span class="icon icon-shopping_cart"></span>
                                            <span id="count"class="count">{{ $cartCount }}</span>
                                        </a>
                                    </li>
                                    @auth
                                        <li>
                                            <a class="site-cart" id="bell"
                                                data-url="{{ route('fe.notification.list') }}"
                                                data-url2="{{ route('fe.notification.changeStatus') }}">
                                                <span class="icon icon-bell" id="ringBell"></span>
                                                @if ($notification > 0)
                                                    <span id="notiCount"class="count">{{ $notification }}</span>
                                                @endif
                                                <div class="list-group text-left" id="listNotification">

                                                </div>
                                            </a>
                                        </li>

                                    @endauth

                                    <li class="d-inline-block d-md-none ml-md-0"><a href="#"
                                            class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a>
                                    </li>
                                    @auth
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-dropdown-link>
                                            </form>
                                        </li>
                                    @endauth

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('fe.commons.nav')
        </header>

        <div class="col-lg-12" id="alert">
            @if (Session::has('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
        @yield('content')


        @include('fe.commons.footer')
    </div>
    <script src="{{ asset('fe/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('fe/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('fe/js/popper.min.js') }}"></script>
    <script src="{{ asset('fe/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fe/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('fe/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('fe/js/aos.js') }}"></script>
    <script src="{{ asset('fe/js/moment.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#alert").delay(3000).slideUp();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // xử lý phần thông báo
            $("#bell").click(function() {
                let ringBell = $("#ringBell");
                if (ringBell.hasClass('mauxanh')) {
                    $("#ringBell").removeClass("mauxanh");
                    $("#listNotification").removeClass("hienthi");
                    let url = $(this).attr("data-url2");
                    $.ajax({
                        type: 'get',
                        url: url,
                        success: function(data) {
                            // alert("thành công rồi");
                            $("#notiCount").removeClass("count");
                            $("#notiCount").text("");

                        }

                    })

                } else {
                    $("#ringBell").addClass("mauxanh");
                    $("#listNotification").addClass("hienthi");

                    let url = $(this).attr("data-url");
                    // alert(url);
                    $.ajax({
                        type: 'get',
                        url: url,
                        success: function(data) {
                            moment.locale("vi");
                            let html = "";
                            let list = $("#listNotification").html();
                            console.log(data);
                            console.log(data.lists.length == 0);
                            if (data.lists.length != 0) {
                                let noti = data.lists;
                                for (let i = 0; i < noti.length; i++) {
                                    html +=
                                        '<a href="/user/detailUserOrder/' + noti[i][
                                            "order_id"
                                        ] +
                                        '" class="list-group-item list-group-item-action" style="background:#dfdede;color:black;font-family:serif">' +
                                        noti[i]["content"] +
                                        '<span style="color:blue;font-size: 13px;font-family: sans-serif;"><br>' +
                                        moment(noti[i][
                                            "created_at"
                                        ]).fromNow(); +
                                    '</span>' + '</a>'

                                }
                            }
                            if (data.listOne.length != 0) {
                                let noti = data.listOne;
                                for (let i = 0; i < noti.length; i++) {
                                    html +=
                                        '<a href="/user/detailUserOrder/' + noti[i][
                                            "order_id"
                                        ] +
                                        ' " class="list-group-item list-group-item-action" style="color:black;font-family:serif">' +
                                        noti[i]["content"] +
                                        '<span style="color:blue;font-size: 13px;font-family: sans-serif;"><br>' +
                                        moment(noti[i][
                                            "created_at"
                                        ]).fromNow(); +
                                    '</span>' + '</a>'

                                }

                            }
                            // console.log(moment(noti[2]["created_at"]).fromNow());
                            if (list == "" && html == "") {
                                html =
                                    '<a href="#" class="list-group-item list-group-item-action">' +
                                    "Bạn không có thông báo nào" + '</a>';
                                $("#listNotification").html(html);
                            } else {
                                $("#listNotification").html(html);
                            }





                        }

                    })

                }


            })
        })
    </script>


    <script src="{{ asset('fe/js/main.js') }}"></script>

    @yield('script')

</body>
<style>
    #bell {
        position: relative;
        cursor: pointer;
    }

    #listNotification {
        position: absolute;
        left: -210px;
        width: 330px;
        top: 34px;
        opacity: 0;
        visibility: hidden;
        height: 300px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    ::-webkit-scrollbar {
        width: 6px;
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }

    ::-webkit-scrollbar-thumb {
        background-color: grey;
    }

    .mauxanh {
        color: #39d3a3;
    }


    .hienthi {
        opacity: 1 !important;
        visibility: visible !important;

    }
</style>
@yield('style')

</html>
