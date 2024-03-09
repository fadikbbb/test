<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the email input is set and not empty
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        // Retrieve the value of the email input
        $email = $_POST['email'];
        
        // Check if the provided email matches the desired email
        if ($email === "fadikbb2004@gmail.com") {
            // Redirect to the dashboard page
            header("Location: dashboard/index.php");
            exit; // Ensure that no further code is executed after redirection
        } else {
            // Handle the case where the email doesn't match
            echo "Invalid email!";
        }
    } else {
        // Handle the case where the email input is empty
        echo "Email is required!";
    }
}
?>

<form action="" method="post">
    <input type="email" name="email" required>
    <input type="submit" value="تسجيل دخول">
</form>
