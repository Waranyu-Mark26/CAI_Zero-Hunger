<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Zero HUNGER</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="bootstrap.min.css"/>
</head>
<body class="body">
    <h1>Project : Zero Hunger</h1>
    <br><br><br><br>
        <div id="login">
            <h2>Login</h2><br>
            <form action="login.php" method="POST">
            <input id="user" type="text" placeholder=" Username" name="user"><br><br>
            <input id="pass" type="password" placeholder=" Password" name="pass"><br><br>
            <button type="submit" class="btn btn-success btn-lg" id="login-btn">Login</button><br><br>
            <div id="status"><?php if(isset($_GET['s'])){
                switch ($_GET['s']) {
                    case 'null_input':
                        echo "ERROR : Username and Passowrd cannot be empty";
                        break;

                    case 'not_exist':
                        echo "ERROR : Username or Password is invalid";
                        break;
                }
            } ?></div>
        </form>
        </div>

</body>
</html>
