<?php
require_once 'header.php';
require_once '../config/database.php';
require_once '../models/DichVu.php';

$model = new DichVu($pdo);
$dichvus = $model->getAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'add':
            $model->add($_POST);
            break;
        case 'edit':
            $model->edit($_POST);
            break;
        case 'delete':
            $model->delete($_POST['MaDV']);
            break;
    }
    header('Location: quanly_dichvu.php');
    exit();
}
?>
<div class="container2">
    <div class="back-button" onclick="window.history.back();">
        &#8592; Quay lại
    </div>
    <h2>Quản Lý Dịch Vụ</h2>
    <form method="POST" action="" class="form-add">
        <input type="hidden" name="action" value="add">
        <input type="text" class="form-control btn_span2" name="TenDV" placeholder="Tên Dịch Vụ" required>
        <button type="submit" class="btn btn-success">Thêm Dịch Vụ</button>
    </form>
    <br>
    <table class="table table-bordered table-hover text-center">
        <tr>
            <th>Mã DV</th>
            <th>Tên Dịch Vụ</th>
            <th>Hành Động</th>
        </tr>
        <?php foreach ($dichvus as $dichvu) : ?>
            <tr>
                <td><?php echo $dichvu['MaDV']; ?></td>
                <td><?php echo $dichvu['TenDV']; ?></td>
                <td>
                    <form method="POST" action="" style="display:inline-block;">
                        <input type="hidden" name="MaDV" value="<?php echo $dichvu['MaDV']; ?>">
                        <input type="hidden" name="action" value="delete">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                    <form method="GET" action="chitiet_dichvu.php" style="display:inline-block;">
                        <input type="hidden" name="MaDV" value="<?php echo $dichvu['MaDV']; ?>">
                        <button type="submit" class="btn btn-warning">Chi Tiết</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
<?php
require_once 'footer.php';
?>