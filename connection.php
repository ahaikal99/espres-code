<?php
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "espres";

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=espres', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//     // set the PDO error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }
?>