<?php
include 'db.php';
$tabla = $_GET['tabla'];
$id = $_GET['id'];
$pk = $conn->query("SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'")->fetch_assoc()['Column_name'];
$conn->query("DELETE FROM $tabla WHERE $pk = $id");
header("Location: index.php");
?>
