<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/NhanVien.php';

$model = new NhanVien($pdo);
$nhanviens = $model->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'edit':
            $model->edit($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaNV']);
            break;
    }
    header('Location: quanly_nhanvien.php');
    exit();
}
?>

<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Nhân Viên</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add">
        <input class="form-control" type="text" name="HoTen" placeholder="Họ Tên" required><br>
        <input class="form-control" type="text" name="ChucVu" placeholder="Chức Vụ" required><br>
        <input class="form-control" type="text" name="SoDienThoai" placeholder="Số Điện Thoại" required><br>
        <input class="form-control" type="email" name="Email" placeholder="Email" required><br>
        <input class="form-control" type="file" name="AnhNhanVien" accept="image/*" required> <br>
        <button type="submit" class="btn btn-success">Thêm Nhân Viên</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã NV</th>
            <th>Họ Tên</th>
            <th>Chức Vụ</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Ảnh</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($nhanviens as $nhanvien) : ?>
            <tr>
                <td><?php echo $nhanvien['MaNV']; ?></td>
                <td><?php echo $nhanvien['HoTen']; ?></td>
                <td><?php echo $nhanvien['ChucVu']; ?></td>
                <td><?php echo $nhanvien['SoDienThoai']; ?></td>
                <td><?php echo $nhanvien['Email']; ?></td>
                <td>
                    <?php if ($nhanvien['AnhNhanVien']) : ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($nhanvien['AnhNhanVien']); ?>" alt="Ảnh nhân viên" width="100">
                    <?php else : ?>
                        Không có ảnh
                    <?php endif; ?>
                </td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaNV" value="<?php echo $nhanvien['MaNV']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_nhanvien.php" style="display:inline-block;">
                        <input type="hidden" name="MaNV" value="<?php echo $nhanvien['MaNV']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>

</html>