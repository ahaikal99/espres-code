<?php
include("connection.php");

session_start();

if(isset($_SESSION["userid"])){
    if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='admin'){
        header("location: ../login.php");
    }else{
        $userid=$_SESSION["userid"];
    }

}else{
    header("location: ../login.php");
}

$delete = $_POST['id'];

if(!$delete){
    header('Location: supervisor-profile.php');
    exit;
}

$sql= $pdo->prepare("delete from supervisor where userid='$delete';");
$sql->execute();
$sql= $pdo->prepare("delete from users where userid='$delete';");
$sql->execute();
header('Location: supervisor-profile.php');


?>