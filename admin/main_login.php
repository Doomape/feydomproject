<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="description" content="slick Login">
    <link rel="stylesheet" type="text/css" href="login_files/style.css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="http://www.modernizr.com/downloads/modernizr-latest.js"></script>
    <script type="text/javascript" src="login_files/placeholder.js"></script>
</head>
<body>
    <form id="slick-login" name="form1" method="post" action="checklogin.php">
        <label for="username"></label><input type="text" id="myusername" name="myusername" class="placeholder" placeholder="Корисничко име">
        <label for="password"></label><input type="password" id="mypassword" name="mypassword" class="placeholder" placeholder="Лозинка">
        <input type="submit" name="Submit" value="Логирај се">
    </form>
</body>
</html>