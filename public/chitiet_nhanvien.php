<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/NhanVien.php';

$model = new NhanVien($pdo);

if (!isset($_GET['MaNV'])) {
    header('Location: quanly_nhanvien.php');
    exit();
}

$maNV = $_GET['MaNV'];
$nhanvien = $model->getById($maNV);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_nhanvien.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Nhân Viên</h2>
    <div class="chitiet">
        <div class="left">
            <div>
                <label class="text-center">Ảnh Nhân Viên</label><br>
                <?php if ($nhanvien['AnhNhanVien']) : ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($nhanvien['AnhNhanVien']); ?>" alt="Ảnh nhân viên" width="200">
                <?php else : ?>
                    Không có ảnh
                <?php endif; ?>
            </div>
        </div>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="MaNV" value="<?php echo $nhanvien['MaNV']; ?>">
            <label for="">Họ tên nhân viên</label>
            <input type="text" class="form-control" name="HoTen" placeholder="Họ Tên" value="<?php echo $nhanvien['HoTen']; ?>" required>
            <label for="">Chức vụ</label>
            <input type="text" class="form-control" name="ChucVu" placeholder="Chức Vụ" value="<?php echo $nhanvien['ChucVu']; ?>" required>
            <label for="">Số điện thoại</label>
            <input type="text" class="form-control" name="SoDienThoai" placeholder="Số Điện Thoại" value="<?php echo $nhanvien['SoDienThoai']; ?>" required>
            <label for="">Email</label>
            <input type="email" class="form-control" name="Email" placeholder="Email" value="<?php echo $nhanvien['Email']; ?>" required>
            <br>
            <input type="file" name="AnhNhanVien" accept="image/*" class="form-control">
            <br>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>

    </div>
    </body>

    </html>