
<?php
$host = 'localhost';
$db   = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $password);

if ($stmt->execute()) {
    echo "تم التسجيل بنجاح!";
} else {
    echo "حدث خطأ: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
