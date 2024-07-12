<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/HoaDon.php';

$model = new HoaDon($pdo);

if (!isset($_GET['MaHD'])) {
    header('Location: quanly_hoadon.php');
    exit();
}

$maHD = $_GET['MaHD'];
$hoadon = $model->getById($maHD);
$phongs = $model->getPhongs();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_hoadon.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Hóa Đơn</h2>
    <form method="POST" action="">
        <input type="hidden" name="MaHD" value="<?php echo $hoadon['MaHD']; ?>">
        <label>Phòng:</label>
        <select name="MaPhong" required class="form-control">
            <?php foreach ($phongs as $phong) : ?>
                <option value="<?php echo $phong['MaPhong']; ?>" <?php if ($phong['MaPhong'] == $hoadon['MaPhong']) echo 'selected'; ?>><?php echo $phong['TenPhong']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Tạo:</label>
        <input class="form-control" type="date" name="NgayTao" value="<?php echo $hoadon['NgayTao']; ?>" required><br>
        <label>Tổng Tiền:</label>
        <input class="form-control" type="number" name="TongTien" value="<?php echo $hoadon['TongTien']; ?>" required><br>
        <button type="submit" class="btn btn-warning">Cập Nhật</button>
    </form>
</div>
</body>

</html>