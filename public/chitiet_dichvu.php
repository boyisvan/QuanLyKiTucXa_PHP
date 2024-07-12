<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/DichVu.php';

$model = new DichVu($pdo);

if (!isset($_GET['MaDV'])) {
    header('Location: quanly_dichvu.php');
    exit();
}

$maDV = $_GET['MaDV'];
$dichvu = $model->getById($maDV);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $model->edit($_POST);
    header('Location: quanly_dichvu.php');
    exit();
}
?>

<div class="containerchitiet">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Chi Tiết Dịch Vụ</h2>
    <form method="POST" action="">
        <input type="hidden" name="MaDV" value="<?php echo $dichvu['MaDV']; ?>">
        <label for="">Tên dịch vụ</label>
        <input class="form-control" type="text" name="TenDV" placeholder="Tên Dịch Vụ" value="<?php echo $dichvu['TenDV']; ?>" required>
        <br>
        <button type="submit" class="btn btn-primary">Cập Nhật</button>
    </form>
</div>
</body>

</html>