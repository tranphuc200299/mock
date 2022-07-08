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
    <h1 class="titleAdminLoginForm">Forgot password</h1>
    <div class="container text-center" style="margin: 20px 0px;">
        <span>Enter your login email and click the "Send mail" button to receive your password reset email.</span>
    </div>
    @if(Session::has('error'))
        <div class="container-fluid emailPasswordAdminError">
            <span>{{ Session::get('error') }}</span>
        </div>
    @endif
    @if(Session::has('success'))
        <div class="container-fluid successSession">
            <span>{{ Session::get('success') }}</span>
        </div>
    @endif
    <div>
        <input type="text" class="form-control" placeholder="Email" name="email">
        @if ($errors->any())
            <small class="checkFieldError">{{ $errors->first() }}</small>
        @endif
    </div>
    <div class="adminBackLoginText">
        <a href="{{ route('admin.login') }}"><u>Back to login screen?</u></a>
    </div>
    <button type="submit" class="btn btn-primary container-fluid">SEND EMAIL</button>
</form>

</body>
</html>
