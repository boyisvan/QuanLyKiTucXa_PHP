<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/DangKyDichVu.php';

$model = new DangKyDichVu($pdo);

if (!isset($_GET['MaDK'])) {
    header('Location: dangkidichvu.php');
    exit();
}

$maDK = $_GET['MaDK'];
$dangkidichvu = $model->getById($maDK);
$sinhviens = $model->getSinhViens();
$dichvus = $model->getDichVus();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: dangkidichvu.php');
    exit();
}
?>


<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Đăng Ký Dịch Vụ</h2>
    <form method="POST" action="">
        <input type="hidden" name="MaDK" value="<?php echo $dangkidichvu['MaDK']; ?>">
        <label>Sinh Viên:</label>
        <select name="MaSV" required class="form-control">
            <?php foreach ($sinhviens as $sinhvien) : ?>
                <option value="<?php echo $sinhvien['MaSV']; ?>" <?php if ($sinhvien['MaSV'] == $dangkidichvu['MaSV']) echo 'selected'; ?>><?php echo $sinhvien['HoTen']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Dịch Vụ:</label>
        <select name="MaDV" required class="form-control">
            <?php foreach ($dichvus as $dichvu) : ?>
                <option value="<?php echo $dichvu['MaDV']; ?>" <?php if ($dichvu['MaDV'] == $dangkidichvu['MaDV']) echo 'selected'; ?>><?php echo $dichvu['TenDV']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Bắt Đầu:</label>
        <input type="date" name="NgayBatDau" value="<?php echo $dangkidichvu['NgayBatDau']; ?>" required class="form-control"><br>
        <label>Ngày Kết Thúc:</label>
        <input type="date" name="NgayKetThuc" value="<?php echo $dangkidichvu['NgayKetThuc']; ?>" required class="form-control"><br>
        <button type="submit" class="btn btn-success">Cập Nhật</button>
    </form>
</div>
</body>

</html>