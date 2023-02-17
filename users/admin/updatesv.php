<?php
include 'connection.php';

session_start();
if($_POST){

    $svname=$_POST['svname'];
    $svid=$_POST['svid'];
    $studentid=$_POST['id'];

    $sql="UPDATE student SET svname='$svname', svid='$svid' WHERE userid='$studentid'";
    $result=$pdo->prepare($sql);
    $result->execute();
    $_SESSION["id"]=$studentid;
    header('Location: student-view.php');


}else{
    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Error!</label>';

}

?>