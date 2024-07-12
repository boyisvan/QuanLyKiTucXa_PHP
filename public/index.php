<?php
require_once 'header.php';
?>

<div class="container1">
    <h2>Trang Chủ Quản Lý Ký Túc Xá</h2>
    <div class="list">
        <a href="quanly_sinhvien.php" class="alert alert-primary"><i class="fas fa-users"></i>Quản Lý Sinh Viên</a>
        <a href="dangkidichvu.php" class="alert alert-info"><i class="fas fa-server"></i>Đăng ki dịch vụ</a>
        <a href="quanly_phong.php" class="alert alert-secondary"><i class="fas fa-home"></i>Quản Lý Phòng</a>
        <a href="quanly_hopdong.php " class="alert alert-success"><i class="fas fa-book"></i>Quản Lý Hợp Đồng</a>
        <a href="quanly_dichvu.php" class="alert alert-danger"><i class="fas fa-wrench"></i>Quản Lý Dịch Vụ</a>
        <a href="quanly_hoadon.php" class="alert alert-warning"><i class="fas fa-ticket-alt"></i>Quản Lý Hóa Đơn</a>
        <a href="quanly_nhanvien.php" class="alert alert-info"><i class="far fa-user"></i>Quản Lý Nhân Viên</a>
        <a href="quanly_thexe.php" class="alert alert-success"><i class="fas fa-car"></i>Quản Lý Thẻ Xe</a>
        <a href="quanly_taikhoan.php" class="alert alert-dark"><i class="fas fa-user-circle"></i>Quản Lý Tài Khoản</a>
        <a href="logout.php" class="btn "><i class="fas fa-sign-out-alt"></i> <label for="">Đăng Xuất</label></a>
    </div>
</div>
<?
require_once 'footer.php'
?>

<style>
    body {
        width: 100%;
        height: 100dvh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #fafafa;
    }

    i {
        margin-left: 2px;
    }

    label {
        margin-right: 3px;
    }
</style>