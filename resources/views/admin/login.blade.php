<title>Admin | Login</title>
<link href="{{asset('front/assets/css/register_form.css')}}" rel="stylesheet">
<link rel="shortcut icon" href="{{asset('front/assets/images/fav.jpg')}}">
<link href="{{asset('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js')}}"></script>
<script src="{{asset('//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js')}}"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Icon -->
        <div class="fadeIn first">
            <br>
            <img src="{{asset('front/assets/images/background/key-2.png')}}" height="50" width="50" alt="Avatar" class="avatar">
        </div>
        <!-- Login Form -->
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <input type="text" id="email" class="fadeIn second @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Your Email Address">
            <input type="password" id="password" class="fadeIn third @error('password') is-invalid @enderror" name="password" placeholder="password">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>
    </div>
</div>