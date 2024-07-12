<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/HopDong.php';

$model = new HopDong($pdo);
$hopdongs = $model->getAll();
$sinhviens = $model->getSinhViens();
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
        case 'renew':
            // Hiển thị form gia hạn hợp đồng
            $maHD = $_POST['MaHD'];
            $hopdong = $model->getById($maHD);
?>
            <div class="container">
                <h2>Gia Hạn Hợp Đồng</h2>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="update_end_date">
                    <input type="hidden" name="MaHD" value="<?php echo $maHD; ?>">
                    <label>Ngày Kết Thúc Mới:</label>
                    <input class="form-control" type="date" name="NgayKetThuc" value="<?php echo $hopdong['NgayKetThuc']; ?>" required><br>
                    <button type="submit" class="btn btn-success">Gia Hạn</button>
                </form>
            </div>
<?php
            break;
        case 'update_end_date':
            $model->edit([
                'MaSV' => $_POST['MaSV'],
                'MaPhong' => $_POST['MaPhong'],
                'NgayBatDau' => $_POST['NgayBatDau'],
                'NgayKetThuc' => $_POST['NgayKetThuc'],
                'DatCoc' => $_POST['DatCoc'],
                'TinhTrang' => $_POST['TinhTrang'],
                'MaHD' => $_POST['MaHD']
            ]);
            break;
    }
    header('Location: quanly_hopdong.php');
    exit();
}

?>

<form method="POST" action="" class="form_hopdong">
    <input type="hidden" name="action" value="add">
    <label>Sinh Viên:</label>
    <select name="MaSV" required class="form-control">
        <?php foreach ($sinhviens as $sinhvien) : ?>
            <option value="<?php echo $sinhvien['MaSV']; ?>"><?php echo $sinhvien['HoTen']; ?></option>
        <?php endforeach; ?>
    </select>
    <label class="">Phòng:</label>
    <select name="MaPhong" required class="form-control">
        <?php foreach ($phongs as $phong) : ?>
            <option value="<?php echo $phong['MaPhong']; ?>"><?php echo $phong['TenPhong']; ?></option>
        <?php endforeach; ?>
    </select><br>
    <label>Ngày Bắt Đầu:</label>
    <input class="form-control" type="date" name="NgayBatDau" required><br>
    <label>Ngày Kết Thúc:</label>
    <input class="form-control" type="date" name="NgayKetThuc" required><br>
    <label>Đặt Cọc:</label>
    <input class="form-control" type="number" name="DatCoc" required><br>
    <label>Tình Trạng:</label>
    <input class="form-control" type="text" name="TinhTrang" required><br>
    <button type="submit" class="btn btn-success">Thêm Hợp Đồng</button>
</form>
<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Hợp Đồng</h2>
    <form method="POST" action="" class="form_hopdong">
        <input type="hidden" name="action" value="add">
        <label>Sinh Viên:</label>
        <select name="MaSV" required class="form-control">
            <?php foreach ($sinhviens as $sinhvien) : ?>
                <option value="<?php echo $sinhvien['MaSV']; ?>"><?php echo $sinhvien['HoTen']; ?></option>
            <?php endforeach; ?>
        </select>
        <label class="">Phòng:</label>
        <select name="MaPhong" required class="form-control">
            <?php foreach ($phongs as $phong) : ?>
                <option value="<?php echo $phong['MaPhong']; ?>"><?php echo $phong['TenPhong']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Ngày Bắt Đầu:</label>
        <input class="form-control" type="date" name="NgayBatDau" required><br>
        <label>Ngày Kết Thúc:</label>
        <input class="form-control" type="date" name="NgayKetThuc" required><br>
        <label>Đặt Cọc:</label>
        <input class="form-control" type="number" name="DatCoc" required><br>
        <label>Tình Trạng:</label>
        <input class="form-control" type="text" name="TinhTrang" required><br>
        <button type="submit" class="btn btn-success">Thêm Hợp Đồng</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã HD</th>
            <th>Sinh Viên</th>
            <th>Phòng</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Đặt Cọc</th>
            <th>Tình Trạng</th>
            <th>Hạn Hợp Đồng</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($hopdongs as $hopdong) : ?>
            <tr>
                <td><?php echo $hopdong['MaHD']; ?></td>
                <td><?php echo $hopdong['TenSinhVien']; ?></td>
                <td><?php echo $hopdong['TenPhong']; ?></td>
                <td><?php echo $hopdong['NgayBatDau']; ?></td>
                <td><?php echo $hopdong['NgayKetThuc']; ?></td>
                <td><?php echo $hopdong['DatCoc']; ?></td>
                <td><?php echo $hopdong['TinhTrang']; ?></td>
                <td><?php echo $hopdong['HanHopDong']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaHD" value="<?php echo $hopdong['MaHD']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_hopdong.php" style="display:inline-block;">
                        <input type="hidden" name="MaHD" value="<?php echo $hopdong['MaHD']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                    <?php if ($hopdong['HanHopDong'] == 'Đã Hết Hạn') : ?>
                        <form method="POST" action="" style="display:inline-block;">
                            <input type="hidden" name="MaHD" value="<?php echo $hopdong['MaHD']; ?>">
                            <input type="hidden" name="action" value="renew">
                            <button type="submit" class="btn btn-primary">Gia Hạn</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>

</html>


<style>
    .form_hopdong {
        display: grid;
        grid-template-columns: (2, 1fr);
    }
</style>