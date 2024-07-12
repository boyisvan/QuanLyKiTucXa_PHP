<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/TaiKhoan.php';

$model = new TaiKhoan($pdo);
$taikhoans = $model->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'edit':
            $model->edit($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaTK']);
            break;
    }
    header('Location: quanly_taikhoan.php');
    exit();
}
?>

<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Tài Khoản</h2>
    <form method="POST" action="">
        <input type="hidden" name="action" value="add">
        <input class="form-control" type="text" name="TenDangNhap" placeholder="Tên Đăng Nhập" required><br>
        <input class="form-control" type="password" name="MatKhau" placeholder="Mật Khẩu" required><br>
        <button type="submit" class="btn btn-success">Thêm Tài Khoản</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã TK</th>
            <th>Tên Đăng Nhập</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($taikhoans as $taikhoan) : ?>
            <tr>
                <td><?php echo $taikhoan['MaTK']; ?></td>
                <td><?php echo $taikhoan['TenDangNhap']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaTK" value="<?php echo $taikhoan['MaTK']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_taikhoan.php" style="display:inline-block;">
                        <input type="hidden" name="MaTK" value="<?php echo $taikhoan['MaTK']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>

</html>