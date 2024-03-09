<?php
include 'connect.php';
$sql = 'SELECT * FROM product';
$result = mysqli_query($conn, $sql);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>