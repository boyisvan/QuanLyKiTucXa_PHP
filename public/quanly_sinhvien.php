<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/SinhVien.php';

$model = new SinhVien($pdo);
$sinhviens = $model->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaSV']);
            break;
    }
    header('Location: quanly_sinhvien.php');
    exit();
}
?>

<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Sinh Viên</h2>
    <form method="POST" action="" enctype="multipart/form-data" class="form-add">
        <input type="hidden" class="form-control" name="action" value="add">
        <input type="text" class="form-control" name="HoTen" class="form-control" placeholder="Họ Tên" required>
        <input type="date" class="form-control" name="NgaySinh" placeholder="Ngày Sinh" required>
        <input type="text" class="form-control" name="GioiTinh" placeholder="Giới Tính" required>
        <input type="text" class="form-control" name="DiaChi" placeholder="Địa Chỉ" required>
        <input type="text" class="form-control" name="SoDienThoai" placeholder="Số Điện Thoại" required>
        <input type="email" class="form-control" name="Email" placeholder="Email" required>
        <input type="file" class="form-control btn1" name="AnhSinhVien" accept="image/*" required>
        <button type="submit" class="btn btn-success btnn">Thêm Sinh Viên</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã SV</th>
            <th>Họ Tên</th>
            <th>Ngày Sinh</th>
            <th>Giới Tính</th>
            <th>Địa Chỉ</th>
            <th>Số Điện Thoại</th>
            <th>Email</th>
            <th>Ảnh</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($sinhviens as $sinhvien) : ?>
            <tr>
                <td><?php echo $sinhvien['MaSV']; ?></td>
                <td><?php echo $sinhvien['HoTen']; ?></td>
                <td><?php echo $sinhvien['NgaySinh']; ?></td>
                <td><?php echo $sinhvien['GioiTinh']; ?></td>
                <td><?php echo $sinhvien['DiaChi']; ?></td>
                <td><?php echo $sinhvien['SoDienThoai']; ?></td>
                <td><?php echo $sinhvien['Email']; ?></td>
                <td>
                    <?php if ($sinhvien['AnhSinhVien']) : ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($sinhvien['AnhSinhVien']); ?>" alt="Ảnh sinh viên" width="100">
                    <?php else : ?>
                        Không có ảnh
                    <?php endif; ?>
                </td>
                <td>
                    <form method="GET" action="chitiet_sinhvien.php" style="display:inline-block;">
                        <input type="hidden" name="MaSV" value="<?php echo $sinhvien['MaSV']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaSV" value="<?php echo $sinhvien['MaSV']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?
require_once 'footer.php'
?>