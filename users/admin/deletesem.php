<?php
include 'connection.php';

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

    if($_POST){
        $id = $_POST['id'];
        $sql_stmnt = $pdo->prepare("DELETE FROM sem WHERE id = '$id'");
        $sql_stmnt->execute();
        header('Location: profile.php');
    }
    
?>