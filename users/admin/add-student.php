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

    require 'vendor\autoload.php';

        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
    if (isset($_POST['submit'])) {
        

        // Get the uploaded file
        $file = $_FILES['file']['tmp_name'];

        // Read the data from the Excel file
        $objPHPExcel = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $objPHPExcel->setActiveSheetIndex(0);
        $rows = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

        // Insert the data into the database
        foreach ($rows as $row) {
            $stmt = $pdo->prepare("INSERT INTO student (uname, userid, email, pcode, phone, address, password, title) VALUES (:column1, :column2, :column3, :column4, :column5, :column6, :column7, :column8)");
            $stmt->bindValue(':column1', $row['A']);
            $stmt->bindValue(':column2', $row['B']);
            $stmt->bindValue(':column3', $row['C']);
            $stmt->bindValue(':column4', $row['D']);
            $stmt->bindValue(':column5', $row['E']);
            $stmt->bindValue(':column6', $row['F']);
            $stmt->bindValue(':column7', $row['G']);
            $stmt->bindValue(':column8', $row['H']);
            $stmt->execute();

            $stmt2 = $pdo->prepare("INSERT INTO users (userid, email, usertype) VALUES (:column2, :column3, :column0)");
            $stmt2->bindValue(':column2', $row['B']);
            $stmt2->bindValue(':column3', $row['C']);
            $stmt2->bindValue(':column0', 'student');
            $stmt2->execute();
        }

        header('Location: student-profile.php');
    }


?>