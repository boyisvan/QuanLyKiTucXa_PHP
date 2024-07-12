<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/Phong.php';

$model = new Phong($pdo);
$phongs = $model->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'edit':
            $model->edit($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaPhong']);
            break;
    }
    header('Location: quanly_phong.php');
    exit();
}
?>
<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Phòng</h2>
    <form method="POST" action="" class="form-add1">
        <input type="hidden" class="form-control" name="action" value="add">
        <input type="text" class="form-control" name="TenPhong" placeholder="Tên Phòng" required>
        <input type="text" class="form-control" name="LoaiPhong" placeholder="Loại Phòng" required>
        <input type="number" class="form-control" name="SoLuongNguoiHienTai" placeholder="Số Lượng Người Hiện Tại" required>
        <input type="text" class="form-control" name="TinhTrang" placeholder="Tình Trạng" required>
        <button type="submit" class="btn btn-success btn_span2">Thêm Phòng</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã Phòng</th>
            <th>Tên Phòng</th>
            <th>Loại Phòng</th>
            <th>Số Lượng Người Hiện Tại</th>
            <th>Tình Trạng</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($phongs as $phong) : ?>
            <tr>
                <td><?php echo $phong['MaPhong']; ?></td>
                <td><?php echo $phong['TenPhong']; ?></td>
                <td><?php echo $phong['LoaiPhong']; ?></td>
                <td><?php echo $phong['SoLuongNguoiHienTai']; ?></td>
                <td><?php echo $phong['TinhTrang']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaPhong" value="<?php echo $phong['MaPhong']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn-danger btn">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_phong.php" style="display:inline-block;">
                        <input type="hidden" name="MaPhong" value="<?php echo $phong['MaPhong']; ?>">
                        <button type="submit" class="btn-warning btn">Chi Tiết</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>

</html>