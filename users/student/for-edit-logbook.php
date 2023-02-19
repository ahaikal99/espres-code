<?php

include 'connection.php';

session_start();

    if(isset($_SESSION["userid"])){
        if(($_SESSION["userid"])=="" or $_SESSION['usertype']!='student'){
            header("location: ../login.php");
        }else{
            $userid=$_SESSION["userid"];
            $_SESSION['id']='';
        }

    }else{
        header("location: ../login.php");
    }

    

if($_POST){

    $id = $_POST['id'];

    $file = $_POST['file'];
    $date = $_POST['date'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $activity = $_POST['activity'];
    $discuss = $_POST['discuss'];
    $method = $_POST['method'];

    $sql_stmnt = $pdo->prepare("SELECT * FROM logbook WHERE id = '$id'");
    $sql_stmnt->execute();
    $user_db = $sql_stmnt -> fetch(PDO::FETCH_ASSOC);

    $current_date_time_sec = strtotime($startTime);
    $future_date_time_sec = strtotime($endTime);
    $difference = $future_date_time_sec-$current_date_time_sec;
    $hours = ($difference / 3600);
    $minutes = ($difference / 60 % 60); 
    $hours = ($hours % 24);
    $total  =    sprintf("%02d",$hours).":".sprintf("%02d",$minutes);


    
    if(!is_dir('file')){
        mkdir('file');
    }
    
    $file_path=$user_db['doc'];
    $char_file = $_FILES['file'];
    if($char_file && $char_file['tmp_name'])
    {
        if($user_db['doc']){
            unlink($user_db['doc']);
        }


        $file_path = 'file/' . randomString(9) .'/' . $char_file['name'];
        mkdir(dirname($file_path));
        move_uploaded_file($char_file['tmp_name'], $file_path);

    }

    $sql="UPDATE logbook SET date='$date', starttime='$startTime', endtime='$endTime', activity='$activity', method='$method', discuss='$discuss', doc='$file_path', totaltime='$total' WHERE id ='$id'";
    $result= $pdo->prepare($sql);
    $result->execute();
    $_SESSION["user"]=$userid;
    $_SESSION["id"]=$id;

    header('Location: view-history.php');

}else{
    $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Error!</label>';

}
function randomString($n) {

    $character = '1234567890qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM';
    $str = '';

for($i = 0; $i < $n; $i++){

    $index = rand(0, strlen($character) -1);
    $str .= $character[$index];

}

return $str;

}

?>