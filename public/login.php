<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tenDangNhap = $_POST['tenDangNhap'];
    $matKhau = $_POST['matKhau'];

    $sql = "SELECT * FROM TaiKhoan WHERE TenDangNhap = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$tenDangNhap]);
    $user = $stmt->fetch();

    if ($user && $matKhau) {
        $_SESSION['user_id'] = $user['MaTK'];
        header('Location: index.php');
        exit();
    } else {
        $error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Đăng Nhập</title>
    <link rel="shortcut icon" href="https://bookvexe.vn/wp-content/uploads/2023/04/kham-pha-25-mau-logo-dia-chi-doc-dao-va-sang-tao_1.jpg" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="assets/login.css">
</head>

<body>
    <div class="container1">
        <div class="left">

        </div>
        <div class="right">
            <h2>Đăng Nhập Hệ Thống</h2>
            <?php if (isset($error)) : ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <label for="tenDangNhap">Tên đăng nhập:</label>
                <input type="text" name="tenDangNhap" class="form-control" placeholder="Nhập tên đăng nhập" required><br>
                <label for="matKhau">Mật khẩu:</label>
                <input type="password" name="matKhau" class="form-control" required><br>
                <button type="submit" class="btn btn-success">Đăng Nhập</button>
            </form>
            <div class="designby">
                The website is designed by @CaiCuc
            </div>
        </div>

    </div>


    <?
    require_once 'footer.php'
    ?>