<?php
include 'connection.php';

if($_POST){
    $id = $_POST['id'];

    $sql = "UPDATE logbook SET status = 'Verified' WHERE id = '$id'";
    $submit = $pdo->prepare($sql);
    $submit->execute();

    header('Location: logbook.php');
}