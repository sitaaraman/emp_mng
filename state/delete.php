<?php
include '../config/db.php';
$id = $_GET['id'] ?? 0;
mysqli_query($con, "DELETE FROM state WHERE id=$id");
header('Location: index.php');
?>