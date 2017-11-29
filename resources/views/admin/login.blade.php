<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="{{asset('')}}">
    <title>login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/style_login.css">
    <script src="js/jquery-3.2.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
    <script src="Admin/dist/js/myjquery.js"></script>
</head>

<body>
     <div class="container">
        <div class="card card-container">
            @if ($errors->any())
                <div class="alert alert-danger login">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('error'))
                    <div class="alert alert-danger login">
                        <ul>
                            <li>{{Session::get('error')}}</li>
                        </ul>
                    </div>
                @endif
            <h3>Login</h3>
            <p id="profile-name" class="profile-name-card"></p>
            <form action="{{route('login')}}" method="post" class="form-signin">
                {{csrf_field()}}
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="name" name="txtname" autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="txtpass">
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Đăng nhập</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
</body>

</html>