<?php
session_start();

// Kết nối đến cơ sở dữ liệu
include 'db_connect.php';

// Xử lý khi người dùng bấm nút "Đăng nhập"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Truy vấn kiểm tra thông tin người dùng
    $sql = "SELECT * FROM Users WHERE username = ? AND password = ? AND role = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra kết quả truy vấn
    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        $_SESSION["username"] = $username;
        $_SESSION["role"] = $role;
        header("Location: main.php"); // Chuyển hướng đến trang main.php
        exit();
    } else {
        // Sai thông tin đăng nhập
        $error = "Tên đăng nhập, mật khẩu hoặc quyền không chính xác.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assest/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <form method="POST" action="">
            <div class="input-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="username" name="username" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" required>
                <i class="fa fa-lock"></i>
            </div>
            <div class="input-group">
                <label for="role">Vai trò</label>
                <select id="role" name="role" required>
                    <option value="manager">Quản lý phòng</option>
                    <option value="student_manager">Quản lý sinh viên</option>
                    <option value="accountant">Kế toán</option>
                </select>
            </div>
            <button type="submit" class="btn">Đăng Nhập</button>
            <?php
            // Hiển thị thông báo lỗi nếu có
            if (isset($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>
        </form>
        <div class="links">
            <a href="reset_password.php">Đổi mật khẩu?</a>
            <a href="register.php">Đăng ký</a>
        </div>
    </div>
</body>
</html>