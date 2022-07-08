<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <link href="{{asset('css/bootstrap@5.0.2.min.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/client/header.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/footer.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset('css/client/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/owl.theme.default.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/css/owl.theme.default.min.css')}}">
    @stack('styles')
</head>
<body>
@include('client.layouts.header')
@yield('content')
<!-- Back to Top -->
<div class="button-up-top" id="myBtn">
    <i class="fa fa-angle-up" aria-hidden="true"></i>
</div>
@include('client.layouts.footer')
<script src="{{ URL::asset('js/jquery.min.js')}}"></script>
<script src="{{asset("js/bootstrap@5.0.2.bundle.min.js")}}"></script>
<script src="{{ URL::asset('js/toastr.min.js')}}"></script>
<script src="{{asset("js/popper@2.9.2.min.js")}}"></script>
{{--<script src="{{asset("js/bootstrap@5.0.2.min.js")}}"></script>--}}
<script src="{{asset('js/client/owl.carousel.js')}}"></script>
<script src="{{asset('js/client/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/client/main-client.js')}}"></script>
<script src="{{ URL::asset('js/wow.min.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script>
    $('.open-menu').on('click', function () {
        $('#menu-header').css('left', '0')
        $('.over_lay').css('display', 'block')
    })
    $('.close-menu').on('click',function () {
        $('#menu-header').css('left', '-100%')
        $('.over_lay').css('display', 'none')
    })
    $('.over_lay').on('click',function () {
        $('#menu-header').css('left', '-100%')
        $('.over_lay').css('display', 'none')
    })

    const URL_TOP_PAGE_FILTER = '{{ route('multiple.filter') }}';
</script>
@stack('scripts')
</body>
</html>
