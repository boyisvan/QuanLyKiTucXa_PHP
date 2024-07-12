<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/TheXe.php';

$model = new TheXe($pdo);
$thexes = $model->getAll();
$sinhviens = $model->getSinhViens();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'edit':
            $model->edit($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaThe']);
            break;
    }
    header('Location: quanly_thexe.php');
    exit();
}
?>

<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Thẻ Xe</h2>
    <form method="POST" action="">
        <input type="hidden" name="action" value="add">
        <label>Sinh Viên:</label>
        <select name="MaSV" required class="form-control">
            <?php foreach ($sinhviens as $sinhvien) : ?>
                <option value="<?php echo $sinhvien['MaSV']; ?>"><?php echo $sinhvien['HoTen']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Bắt Đầu:</label>
        <input class="form-control" type="date" name="NgayBatDau" required><br>
        <label>Ngày Kết Thúc:</label>
        <input class="form-control" type="date" name="NgayKetThuc" required><br>
        <button type="submit" class="btn btn-success">Thêm Thẻ Xe</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã Thẻ</th>
            <th>Sinh Viên</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($thexes as $thexe) : ?>
            <tr>
                <td><?php echo $thexe['MaThe']; ?></td>
                <td><?php echo $thexe['TenSinhVien']; ?></td>
                <td><?php echo $thexe['NgayBatDau']; ?></td>
                <td><?php echo $thexe['NgayKetThuc']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaThe" value="<?php echo $thexe['MaThe']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_thexe.php" style="display:inline-block;">
                        <input type="hidden" name="MaThe" value="<?php echo $thexe['MaThe']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>

</html>