<?php
$conn = mysqli_connect('localhost', 'root', '', 'alharmyn');
if (!$conn) {
    die('error: ' . mysqli_error($conn));
}
?>