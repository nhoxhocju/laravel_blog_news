<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel=”stylesheet” href=”https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css”> <link
        href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

</head>

<body style="background-color: #d6d1c3">
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home.index') }}">Blog News</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">{{ __('Home') }} <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <ul class="navbar-nav text-right">
                @if(Auth::check())
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('backend.post.index') }}">
                            {{ __('Admin') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-language" aria-hidden="true"></i>
                        {{ __('Language') }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach ($languages as $lang)
                        <a href="{{ route('localization.index', $lang->code_language) }}" class="dropdown-item">
                            <div class="media-body">
                                <div class="dropdown-item">
                                    {{ __($lang->language) }}
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </li>
            </ul>

        </div>
    </nav>
    <div class="new-intro-page intro-page">
        <div class="container-fluid">
            <div class="row">
                <div class="offset-lg-7"></div>
                <div class="new-group-title col-lg-5 col-12 wow fadeInRight"
                    style="visibility: visible; animation-name: fadeInRight;">
                    <div class="intro-form">
                        <form action="http://bizman.tesosoft.com/tim-kiem/tin-tuc" method="GET">
                            <input class="form-control input-bizman" type="text" name="search_data"
                                placeholder="Tìm kiếm bài viết">
                            <button type="submit" class="fa fa-search"></button>
                        </form>
                    </div>
                    <div class="group-title d-lg-block d-none intro-title-new">
                        <div class="intro-title ">Tin tức</div>
                    </div>
                    <div class="group-news">
                        <div class="group-news-title">Bài viết gần đây</div>
                        <div class="group-news-title-space"></div>
                        <div class="recent-news">
                            <a href="http://bizman.tesosoft.com/tin-tuc/nghien-cuu-suc-manh-cua-pano-quang-cao-trong-viec-ket-noi-nguoi-tieu-dung-ban-ron-ngay-nay"
                                class="recent-news-item text-uppercase">
                                [NGHIÊN CỨU] SỨC MẠNH CỦA PANO QUẢNG CÁO TRONG VIỆC KẾT NỐI NGƯỜI TIÊU DÙNG BẬN RỘN NGÀY
                                N...
                                <hr>
                            </a>
                            <a href="http://bizman.tesosoft.com/tin-tuc/bizman-dau-tu-cong-nghe-quang-cao-de-dan-dau"
                                class="recent-news-item text-uppercase">
                                Bizman đầu tư công nghệ quảng cáo để dẫn đầu
                                <hr>
                            </a>
                            <a href="http://bizman.tesosoft.com/tin-tuc/tu-van-bi-mat-bat-mi-ve-chi-phi-quang-cao-ngoai-troi-ban-khong-the-bo-qua"
                                class="recent-news-item text-uppercase">
                                [TƯ VẤN] BÍ MẬT BẬT MÍ VỀ CHI PHÍ QUẢNG CÁO NGOÀI TRỜI BẠN KHÔNG THỂ BỎ QUA.
                                <hr>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <section class="footer">
        <div class="over-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-12 mb-3 mt-5">
                        <div class="footer-title mb-3">Liên hệ&nbsp;</div>
                        <ul>
                            <li class="mb-2">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                Hà Nội: Tầng 8 - Tòa nhà HTP, 434 Trần Khát Chân, Hà Nội&nbsp;
                            </li>
                            <li class="mb-2">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                TP.HCM: 50A Đặng Dung, phường Tân Định, Quận 1, TP.HCM&nbsp;
                            </li>
                            <li class="mb-2">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                Hotline: 094 986 9898 - Tel: 028 3848 9565/6
                            </li>
                            <li class="mb-2">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                Email: info@bizman.com.vn
                            </li>
                        </ul>
                        <div class="group-image">
                            <ul class="pt-2">
                                <li><a href="https://www.facebook.com/Bizman.JSC/" target="_blank"><img
                                            src="http://bizman.tesosoft.com/img/footer/1.png" alt="logo"></a></li>
                                <li><a disabled=""><img src="http://bizman.tesosoft.com/img/footer/2.png"
                                            alt="logo"></a>
                                </li>
                                <li><a disabled=""><img src="http://bizman.tesosoft.com/img/footer/3.png"
                                            alt="logo"></a>
                                </li>
                                <li><a disabled=""><img src="http://bizman.tesosoft.com/img/footer/4.png"
                                            alt="logo"></a>
                                </li>
                                <li><a disabled=""><img src="http://bizman.tesosoft.com/img/footer/5.png"
                                            alt="logo"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 mb-3 mt-5">
                        <div class="footer-title mb-3 left">thông tin </div>
                        <ul>
                            <li class="mb-2">
                                <a href="http://bizman.tesosoft.com/gioi-thieu/chung-toi">Giới thiệu về Bizman</a>
                            </li>
                            <li class="mb-2">
                                <a href="http://bizman.tesosoft.com/linh-vuc">Lĩnh vực hoạt động</a>
                            </li>
                            <li class="mb-2">
                                <a href="http://bizman.tesosoft.com/tin-tuc">Tin tức &amp; Sự Kiện</a>
                            </li>
                            <li class="mb-2">
                                <a href="http://bizman.tesosoft.com#home-customer">Khách hàng</a>
                            </li>
                            <li class="mb-2">
                                <a href="http://bizman.tesosoft.com/lien-he">Tư vấn &amp; Hỗ trợ</a>
                            </li>
                            <li class="mb-2">
                                <a href="http://bizman.tesosoft.com/tuyen-dung">Cơ hội nghề nghiệp</a>
                            </li>
                            <li class="mb-2">
                                <a href="#">Điều khoản &amp; dịch vụ</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-12 footer-form">
                        <div class="logo mt-5 mb-5">
                            <img src="http://bizman.tesosoft.com/img/logoxanh.png" alt="logo" width="40%">
                        </div>
                        <div class="form-title mb-3 mt-5">
                            Đăng ký nhận thông tin
                        </div>
                        <p class="mb-3">
                            Xin vui lòng để lại địa chỉ email, chúng tôi sẽ cập nhật những tin tức quan trọng của Bizman
                            tới
                            quý khách
                        </p>
                        <form class="form-group" action="http://bizman.tesosoft.com/dang-ky-email" method="POST"
                            id="registerEmailForm">
                            <input type="hidden" name="_token" value="D429WrZ6Hx0kdRZA5HF4bQE0t79XzJ6n96u4T5ha">
                            <div class="form-group">
                                <input type="text" class="form-control input-bizman mb-3 mt-3" name="register_email"
                                    placeholder="Email" required=""
                                    oninvalid="this.setCustomValidity('Vui lòng nhập EMAIL vào đây!')"
                                    oninput="this.setCustomValidity('')">
                                <span class="color-red" id="registerEmailError"></span>
                            </div>
                            <button type="submit" class="btn-bizman" id="registerEmailButton">Gửi</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
