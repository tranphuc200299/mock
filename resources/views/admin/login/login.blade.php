<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/admin/login.css')}}">

</head>
<body>
<form class="jumbotron adminLoginForm" action="" method="post">
    @csrf
    <h1 class="display-4 titleAdminLoginForm" >Login form</h1>
        @if(Session::has('warningLoginFail') || Session::has('error'))
            <div class="container-fluid emailPasswordAdminError">
                <span>{{ Session::get('error') }}. {{ Session::get('warningLoginFail') }}</span>
            </div>
       @endif
    <div>
        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
        @if ($errors->any())
            <small class="checkFieldError">{{ $errors->first() }}</small>
        @endif
    </div>
    <div>
        <input type="password" class="form-control" placeholder="Password" name="password">
    </div>
    <div class="row rememberLoginCheckBox">
        <div class="col-lg-6 col-md-6 col-6">
            <input type="checkbox" id="AdminLoginRememberCheckbox" name="remember">
            <label for="AdminLoginRememberCheckbox">Remember me</label>
        </div>
        <div class="col-lg-6 col-md-6 col-6 adminLostPasswordText">
            <a href="{{ route('admin.forgotPassword') }}" ><u>Lost your password?</u></a>
        </div>
    </div>
    <button type="submit" class="btn btn-primary container-fluid" {{ Session::has('disableLoginButton') ? 'disabled' : ''}}>LOGIN</button>
</form>

</body>
</html>
