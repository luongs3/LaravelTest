<?php
    session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ route('users.post-login') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="email" name="email" placeholder="{{ trans('label.email') }}"><br>
        <input type="password" name="password" placeholder="{{ trans('label.password') }}"><br>
        <br><br>
        <input type="submit" value="{{ trans('label.submit') }}">
    </form>

    @if (isset($_SESSION['user']))
        <br><br>
        <a href="{{ route('users.logout') }}">{{ trans('label.logout') }}</a>
    @endif
</body>
</html>