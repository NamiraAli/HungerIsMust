<?php
$con = mysqli_connect('localhost', 'root', '', 'contactdata', 3307);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$user = isset($_POST['user']) ? $_POST['user'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

$query = "INSERT INTO userdata (name, email, mobile, subject, message) VALUES ('$user', '$email', '$mobile', '$subject', '$message')";
if (mysqli_query($con, $query)) {
    echo "<script>
        alert('Submitted successfully');
        window.location.href = 'index.php';
    </script>";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
