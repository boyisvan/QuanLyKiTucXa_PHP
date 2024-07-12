<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/DangKyDichVu.php';

$model = new DangKyDichVu($pdo);
$dangkidichvus = $model->getAll();
$sinhviens = $model->getSinhViens();
$dichvus = $model->getDichVus();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'edit':
            $model->edit($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaDKDV']);
            break;
    }
    header('Location: dangkidichvu.php');
    exit();
}
?>



<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Đăng Ký Dịch Vụ</h2>
    <form method="POST" action="">
        <input type="hidden" name="action" value="add">
        <label>Sinh Viên:</label>
        <select name="MaSV" required class="form-control">
            <?php foreach ($sinhviens as $sinhvien) : ?>
                <option value="<?php echo $sinhvien['MaSV']; ?>"><?php echo $sinhvien['HoTen']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Dịch Vụ:</label>
        <select name="MaDV" required class="form-control">
            <?php foreach ($dichvus as $dichvu) : ?>
                <option value="<?php echo $dichvu['MaDV']; ?>"><?php echo $dichvu['TenDV']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Bắt Đầu:</label>
        <input type="date" name="NgayBatDau" required class="form-control"><br>
        <label>Ngày Kết Thúc:</label>
        <input type="date" name="NgayKetThuc" required class="form-control"><br>
        <button type="submit" class="btn btn-success">Đăng Ký Dịch Vụ</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã ĐK</th>
            <th>Sinh Viên</th>
            <th>Dịch Vụ</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($dangkidichvus as $dangkidichvu) : ?>
            <tr>
                <td><?php echo $dangkidichvu['MaDK']; ?></td>
                <td><?php echo $dangkidichvu['TenSinhVien']; ?></td>
                <td><?php echo $dangkidichvu['TenDichVu']; ?></td>
                <td><?php echo $dangkidichvu['NgayBatDau']; ?></td>
                <td><?php echo $dangkidichvu['NgayKetThuc']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaDK" value="<?php echo $dangkidichvu['MaDK']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_dangkidichvu.php" style="display:inline-block;">
                        <input type="hidden" name="MaDK" value="<?php echo $dangkidichvu['MaDK']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php include 'footer.php'; ?>
</body>

</html>