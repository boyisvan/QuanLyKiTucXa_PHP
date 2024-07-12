<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/TaiKhoan.php';

$model = new TaiKhoan($pdo);

if (!isset($_GET['MaTK'])) {
    header('Location: quanly_taikhoan.php');
    exit();
}

$maTK = $_GET['MaTK'];
$taikhoan = $model->getById($maTK);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_taikhoan.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Tài Khoản</h2>
    <form method="POST" action="">
        <input type="hidden" name="MaTK" value="<?php echo $taikhoan['MaTK']; ?>">
        <label for="">Tên đăng nhập</label>
        <input type="text" class="form-control" name="TenDangNhap" placeholder="Tên Đăng Nhập" value="<?php echo $taikhoan['TenDangNhap']; ?>" required>
        <label for="">Mật khẩu hiện tại</label>
        <input type="password" name="MatKhau" class="form-control" placeholder="Mật Khẩu (Để trống nếu không thay đổi)">
        <br>
        <button type="submit" class="btn btn-primary">Thay đổi</button>
    </form>
</div>
</body>

</html>