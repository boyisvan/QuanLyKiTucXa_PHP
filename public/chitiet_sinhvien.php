<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/SinhVien.php';

$model = new SinhVien($pdo);

if (!isset($_GET['MaSV'])) {
    header('Location: quanly_sinhvien.php');
    exit();
}

$maSV = $_GET['MaSV'];
$sinhvien = $model->getById($maSV);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_sinhvien.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Sinh Viên</h2>
    <div class="chitiet">
        <div class="left">
            <div>
                <label>Ảnh Sinh Viên:</label><br>
                <?php if ($sinhvien['AnhSinhVien']) : ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($sinhvien['AnhSinhVien']); ?>" alt="Ảnh sinh viên" width="200">
                <?php else : ?>
                    Không có ảnh
                <?php endif; ?>
            </div>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" class="formdata">
            <input type="hidden" name="MaSV" value="<?php echo $sinhvien['MaSV']; ?>">
            <label for="HoTen">Họ tên sinh viên : </label>
            <input type="text" class="form-control" name="HoTen" placeholder="Họ Tên" value="<?php echo $sinhvien['HoTen']; ?>" required>
            <label for=""> Ngày sinh: </label>
            <input type="date" class="form-control" name="NgaySinh" placeholder="Ngày Sinh" value="<?php echo $sinhvien['NgaySinh']; ?>" required>
            <label for="">Giới tính : </label>
            <input type="text" class="form-control" name="GioiTinh" placeholder="Giới Tính" value="<?php echo $sinhvien['GioiTinh']; ?>" required>
            <label for="">Địa chỉ : </label>
            <input type="text" class="form-control" name="DiaChi" placeholder="Địa Chỉ" value="<?php echo $sinhvien['DiaChi']; ?>" required>
            <label for="">Số điện thoại : </label>
            <input type="text" class="form-control" name="SoDienThoai" placeholder="Số Điện Thoại" value="<?php echo $sinhvien['SoDienThoai']; ?>" required>
            <label for="">Email : </label>
            <input type="email" class="form-control" name="Email" placeholder="Email" value="<?php echo $sinhvien['Email']; ?>" required>
            <br> <input type="file" class="form-control" name="AnhSinhVien" accept="image/*"><br>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
        </form>
    </div>
</div>
</body>

</html>