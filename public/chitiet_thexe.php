<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/TheXe.php';

$model = new TheXe($pdo);

if (!isset($_GET['MaThe'])) {
    header('Location: quanly_thexe.php');
    exit();
}

$maThe = $_GET['MaThe'];
$thexe = $model->getById($maThe);
$sinhviens = $model->getSinhViens();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_thexe.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Thẻ Xe</h2>
    <form method="POST" action="">
        <input type="hidden" name="MaThe" value="<?php echo $thexe['MaThe']; ?>">
        <label>Sinh Viên:</label>
        <select name="MaSV" required class="form-control">
            <?php foreach ($sinhviens as $sinhvien) : ?>
                <option value="<?php echo $sinhvien['MaSV']; ?>" <?php if ($sinhvien['MaSV'] == $thexe['MaSV']) echo 'selected'; ?>><?php echo $sinhvien['HoTen']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Bắt Đầu:</label>
        <input class="form-control" type="date" name="NgayBatDau" value="<?php echo $thexe['NgayBatDau']; ?>" required><br>
        <label>Ngày Kết Thúc:</label>
        <input class="form-control" type="date" name="NgayKetThuc" value="<?php echo $thexe['NgayKetThuc']; ?>" required><br>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
</body>

</html>