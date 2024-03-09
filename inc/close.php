<?php
mysqli_close($conn);
$stmt->close();
mysqli_free_result($result);
?>