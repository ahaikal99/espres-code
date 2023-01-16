<?php
include 'connection.php';

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
            $stmt = $pdo->prepare("INSERT INTO logbook (date, starttime, endtime, activity, userid, svid, svname) 
            VALUES (:column1, :column2, :column3, :column4, :column5, :column6, :column7)");
            $stmt->bindValue(':column1', $row['A']);
            $stmt->bindValue(':column2', $row['B']);
            $stmt->bindValue(':column3', $row['C']);
            $stmt->bindValue(':column4', $row['D']);
            $stmt->bindValue(':column5', $row['E']);
            $stmt->bindValue(':column6', $row['F']);
            $stmt->bindValue(':column7', $row['G']);
            $stmt->execute();

            $stmt = $pdo->prepare("INSERT INTO logbook (date, starttime, endtime, activity, userid, svid, svname) 
            VALUES (:column1, :column2, :column3, :column4, :column5, :column6, :column7)");
            $stmt->bindValue(':column1', $row['A']);
            $stmt->bindValue(':column2', $row['B']);
            $stmt->bindValue(':column3', $row['C']);
            $stmt->bindValue(':column4', $row['D']);
            $stmt->bindValue(':column5', $row['E']);
            $stmt->bindValue(':column6', $row['F']);
            $stmt->bindValue(':column7', $row['G']);
            $stmt->execute();
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
        <div class="input-group mb-3">
            <input type="file" class="form-control" name="file">
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" value="upload" class="btn btn-primary">Submit</button>
        </div>
    </form>
</body>
</html>