<!-- Normalize CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/normalize.css')}}">
<!-- Main CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/main.css')}}">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/bootstrap.min.css')}}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/animate.min.css')}}">
<!-- Font-awesome CSS-->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/font-awesome.min.css')}}">
<!-- Owl Caousel CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/vendor/OwlCarousel/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('Assets/Frontend/vendor/OwlCarousel/owl.theme.default.min.css')}}">
<!-- Main Menu CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/meanmenu.min.css')}}">
<!-- nivo slider CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/vendor/slider/css/nivo-slider.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('Assets/Frontend/vendor/slider/css/preview.css')}}" type="text/css" media="screen" />
<!-- Datetime Picker Style CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/jquery.datetimepicker.css')}}">
<!-- Select2 CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/select2.min.css')}}">
<!-- Magic popup CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/magnific-popup.css')}}">
<!-- Switch Style CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/hover-min.css')}}">
<!-- ReImageGrid CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/css/reImageGrid.css')}}">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{asset('Assets/Frontend/style.css')}}">
<!-- Modernizr Js -->
<script src="{{asset('Assets/Frontend/js/modernizr-2.8.3.min.js')}}"></script>

<!-- OrgChart CSS -->
<link href="{{ asset('orgchart/jquery.orgchart.css') }}" rel="stylesheet">
<style>
    #chart-container {
        width: 100%;
        height: calc(100vh - 150px);
        border: 2px solid #aaa;
        text-align: center;
        overflow: auto;
    }

    .orgchart {
        background: #fff;
        font-family: 'Arial', sans-serif;
    }

    .orgchart td.left, .orgchart td.right, .orgchart td.top {
        border-color: #ccc;
    }

    .orgchart .title {
        background-color: #1a73e8;
        color: white;
        font-weight: bold;
        padding: 5px;
        font-size: 1.1rem;
    }

    .orgchart .content {
        border-color: #1a73e8;
        font-size: 0.9rem;
    }

    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    @media screen and (max-width: 768px) {
        .orgchart .title {
            font-size: 1rem;
        }
        .orgchart .content {
            font-size: 0.8rem;
        }
    }
</style>

