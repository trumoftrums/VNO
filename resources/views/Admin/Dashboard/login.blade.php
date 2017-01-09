<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin dashboard | Login</title>

    <link href="../backend/css/bootstrap.min.css" rel="stylesheet">
    <link href="../backend/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="../backend/css/animate.css" rel="stylesheet">
    <link href="../backend/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">IN+</h1>

        </div>
        <h3>Welcome to VNO</h3>

        <form class="m-t" role="form" method="post" action="">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" required="required">
            </div>
            <button type="submit" name="password" class="btn btn-primary block full-width m-b">Login</button>

            <a href="#"><small>Forgot password?</small></a>
        </form>
        <p class="m-t"> <small>Vietnamoto.net &copy; 2017</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="../backend/js/jquery-2.1.1.js"></script>
<script src="../backend/js/bootstrap.min.js"></script>

</body>

</html>
