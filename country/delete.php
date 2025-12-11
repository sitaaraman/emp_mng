<?php
include '../config/db.php';
$id = $_GET['id'] ?? 0;
mysqli_query($conn, "DELETE FROM country WHERE id=$id");
header('Location: index.php');
?>