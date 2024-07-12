<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/HoaDon.php';

$model = new HoaDon($pdo);
$hoadons = $model->getAll();
$phongs = $model->getPhongs();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'edit':
            $model->edit($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaHD']);
            break;
    }
    header('Location: quanly_hoadon.php');
    exit();
}
?>

<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Hóa Đơn</h2>
    <form method="POST" action="">
        <input type="hidden" name="action" value="add">
        <label>Phòng:</label>
        <select name="MaPhong" required class="form-control">
            <?php foreach ($phongs as $phong) : ?>
                <option value="<?php echo $phong['MaPhong']; ?>"><?php echo $phong['TenPhong']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Tạo:</label>
        <input class="form-control" type="date" name="NgayTao" required><br>
        <label>Tổng Tiền:</label>
        <input class="form-control" type="number" name="TongTien" required><br>
        <button type="submit" class="btn btn-success">Thêm Hóa Đơn</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã HD</th>
            <th>Phòng</th>
            <th>Ngày Tạo</th>
            <th>Tổng Tiền</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($hoadons as $hoadon) : ?>
            <tr>
                <td><?php echo $hoadon['MaHD']; ?></td>
                <td><?php echo $hoadon['TenPhong']; ?></td>
                <td><?php echo $hoadon['NgayTao']; ?></td>
                <td><?php echo $hoadon['TongTien']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaHD" value="<?php echo $hoadon['MaHD']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_hoadon.php" style="display:inline-block;">
                        <input type="hidden" name="MaHD" value="<?php echo $hoadon['MaHD']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


</body>

</html>