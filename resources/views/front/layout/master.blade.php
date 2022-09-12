<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','Video Cloud')</title>
    <link href="{{ asset('front/assets/css/register_form.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('front/assets/images/fav.jpg') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/fontawsom-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/style.css') }}" />
    <script src="{{ asset('http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}">
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js') }}"></script>

    <style>
        .comment-container {
            position: relative;
            margin-top: 10px;
            width: 700px;
        }
        strong {
            color: red;
        }

    </style>
</head>

<body>
    <!--####################### Header Starts Here ###################-->
    @include('front.layout.header')

    @yield('content')

    @include('front.layout.footer')
</body>
<script src="{{ asset('front/assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/assets/plugins/scroll-fixed/jquery-scrolltofixed-min.js') }}"></script>
<script src="{{ asset('front/assets/js/script.js') }}"></script>
<script
src="{{ asset('https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous') }}">

</script>
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js')}}"
integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('#update_comment').hide();
</script>


</html>
