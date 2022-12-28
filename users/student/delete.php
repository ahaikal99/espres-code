<?php
include("connection.php");

session_start();

if(isset($_SESSION["userid"])){
    if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='student'){
        header("location: ../login.php");
    }else{
        $userid=$_SESSION["userid"];
    }

}else{
    header("location: ../login.php");
}

$delete = $_POST['id'];

if(!$delete){
    header('Location: history.php');
    exit;
}

$sql= $pdo->prepare("delete from logbook where id='$delete';");
$sql->execute();
header('Location: history.php');

?>