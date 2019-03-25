<?php
$connect = mysqli_connect("localhost","root",null,"zero_hunger");
$finduser = "SELECT username FROM login";
$getpass = "SELECT password FROM login WHERE username=";
$pass = false;
    if($connect->connect_error)
    {
        die("Connection Error : " . $connect->connect_error);
    }
    if($_POST['user'] == null || $_POST['pass'] == null)
    {
        header('location:index.php?s=null_input');
    }
        $result = mysqli_query($connect,$finduser);

        while ($row = mysqli_fetch_array($result)) {
            if($_POST['user'] == $row['username'])
            {
                $pass = true;
                break;
            }

        }
        if($pass)
        {
            $passres = mysqli_query($connect,$getpass . "'" . $_POST['user'] . "'");
            //var_dump($getpass . $_POST['user']);
            $rowpass = mysqli_fetch_array($passres);
            if ($_POST['pass'] == $rowpass['password']) {
                header('location:result.php?u='.$_POST['user'] . '&load=true');
            }
            else {
                header('location:index.php?s=not_exist');
            }
        }
        else {
            header('location:index.php?s=not_exist');
        }




?>
