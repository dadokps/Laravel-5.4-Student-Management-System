<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    {!! Html::style('css/bootstrap.min.css') !!}
    <!-- bootstrap theme -->
    {!! Html::style('css/bootstrap-theme.css') !!}
    <!--external css-->
    <!-- font icon -->
    {!! Html::style('css/elegant-icons-style.css') !!}
    {!! Html::style('css/font-awesome.css') !!}
    <!-- Custom styles -->
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/style-responsive.css') !!}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    {!! Html::style('js/html5shiv.js') !!}
    {!! Html::style('js/respond.min.js') !!}
    <![endif]-->
</head>

<body class="login-img3-body">

    <div class="container">

        <form class="login-form" action="index.html">
            <div class="login-wrap">
                <p class="login-img"><i class="icon_lock_alt"></i></p>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control" placeholder="Username" autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                    <span class="pull-right"> <a href="#"> Forgot Password?</a></span>
                </label>
                <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                <button class="btn btn-info btn-lg btn-block" type="submit">Signup</button>
            </div>
        </form>

    </div>

</body>
</html>
