
<?php
$host = 'localhost';
$db   = 'your_database';
$user = 'your_username';
$pass = 'your_password';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password'])) {
        echo "تم تسجيل الدخول بنجاح، مرحباً " . htmlspecialchars($user['username']);
        // يمكنك توجيه المستخدم إلى صفحة أخرى هنا باستخدام header("Location: home.php");
    } else {
        echo "كلمة المرور غير صحيحة.";
    }
} else {
    echo "لا يوجد مستخدم بهذا البريد.";
}

$stmt->close();
$conn->close();
?>
