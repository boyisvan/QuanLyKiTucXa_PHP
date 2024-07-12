<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/Phong.php';

$model = new Phong($pdo);

if (!isset($_GET['MaPhong'])) {
    header('Location: quanly_phong.php');
    exit();
}

$maPhong = $_GET['MaPhong'];
$phong = $model->getById($maPhong);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_phong.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Phòng</h2>
    <form method="POST" action="">
        <input type="hidden" name="MaPhong" value="<?php echo $phong['MaPhong']; ?>">
        <label for="">Tên phòng</label>
        <input class="form-control" type="text" name="TenPhong" placeholder="Tên Phòng" value="<?php echo $phong['TenPhong']; ?>" required>
        <label for="">Loại phòng</label>
        <input class="form-control" type="text" name="LoaiPhong" placeholder="Loại Phòng" value="<?php echo $phong['LoaiPhong']; ?>" required>
        <label for="">Số lượng người hiện tại</label>
        <input class="form-control" type="number" name="SoLuongNguoiHienTai" placeholder="Số Lượng Người Hiện Tại" value="<?php echo $phong['SoLuongNguoiHienTai']; ?>" required>
        <label for="">Tình trạng phòng</label>
        <input class="form-control" type="text" name="TinhTrang" placeholder="Tình Trạng" value="<?php echo $phong['TinhTrang']; ?>" required>
        <br>
        <button type="submit" class="btn btn-warning">Cập Nhật</button>
    </form>
</div>
</body>

</html>