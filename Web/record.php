<?php
$connect = mysqli_connect("localhost","root",null,"zero_hunger");
$n = "SELECT school FROM login WHERE username=" . "'" .$_GET['u'] . "'";
$school = mysqli_query($connect,$n);


 function update_reserved($name,$amnt)
 {
     $ins = "UPDATE school_data SET reserved_amnt=".$amnt." WHERE School_Name="."'".$name."'";
     $s = mysqli_query(mysqli_connect("localhost","root",null,"zero_hunger"),$ins);

     echo "success";
//        var_dump($ins);


 }
//var_dump(mysqli_error($connect));
 /*var_dump($school);

 var_dump($n);

var_dump(mysqli_error($connect));

 var_dump(mysqli_fetch_array($school));*/

while ($row = mysqli_fetch_array($school)) {
    update_reserved($row['school'],$_GET['amnt']);
}









?>
