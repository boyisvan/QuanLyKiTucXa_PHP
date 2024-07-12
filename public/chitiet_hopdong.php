<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/HopDong.php';

$model = new HopDong($pdo);

if (!isset($_GET['MaHD'])) {
    header('Location: quanly_hopdong.php');
    exit();
}

$maHD = $_GET['MaHD'];
$hopdong = $model->getById($maHD);
$sinhviens = $model->getSinhViens();
$phongs = $model->getPhongs();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_hopdong.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Hợp Đồng</h2>
    <form method="POST" action="">
        <input type="hidden" name="MaHD" value="<?php echo $hopdong['MaHD']; ?>">
        <label>Sinh Viên:</label>
        <select name="MaSV" required class="form-control">
            <?php foreach ($sinhviens as $sinhvien) : ?>
                <option value="<?php echo $sinhvien['MaSV']; ?>" <?php if ($sinhvien['MaSV'] == $hopdong['MaSV']) echo 'selected'; ?>><?php echo $sinhvien['HoTen']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Phòng:</label>
        <select name="MaPhong" required class="form-control">
            <?php foreach ($phongs as $phong) : ?>
                <option value="<?php echo $phong['MaPhong']; ?>" <?php if ($phong['MaPhong'] == $hopdong['MaPhong']) echo 'selected'; ?>><?php echo $phong['TenPhong']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Bắt Đầu:</label>
        <input class="form-control" type="date" name="NgayBatDau" value="<?php echo $hopdong['NgayBatDau']; ?>" required><br>
        <label>Ngày Kết Thúc:</label>
        <input class="form-control" type="date" name="NgayKetThuc" value="<?php echo $hopdong['NgayKetThuc']; ?>" required><br>
        <label>Đặt Cọc:</label>
        <input class="form-control" type="number" name="DatCoc" value="<?php echo $hopdong['DatCoc']; ?>" required><br>
        <label>Tình Trạng:</label>
        <input class="form-control" type="text" name="TinhTrang" value="<?php echo $hopdong['TinhTrang']; ?>" required><br>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
</body>

</html>