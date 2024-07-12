<?php
class DangKyDichVu
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getById($maDKDV)
    {
        $stmt = $this->db->prepare('
            SELECT DangKyDichVu.*, SinhVien.HoTen AS TenSinhVien, DichVu.TenDV AS TenDichVu
            FROM DangKyDichVu
            JOIN SinhVien ON DangKyDichVu.MaSV = SinhVien.MaSV
            JOIN DichVu ON DangKyDichVu.MaDV = DichVu.MaDV
            WHERE MaDK = ?
        ');
        $stmt->execute([$maDKDV]);
        return $stmt->fetch();
    }
    public function getAll()
    {
        $stmt = $this->db->query('
            SELECT DangKyDichVu.*, SinhVien.HoTen AS TenSinhVien, DichVu.TenDV AS TenDichVu
            FROM DangKyDichVu
            JOIN SinhVien ON DangKyDichVu.MaSV = SinhVien.MaSV
            JOIN DichVu ON DangKyDichVu.MaDV = DichVu.MaDV
        ');
        return $stmt->fetchAll();
    }

    public function add($data)
    {
        $sql = "INSERT INTO DangKyDichVu (MaSV, MaDV, NgayBatDau, NgayKetThuc) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaSV'],
            $data['MaDV'],
            $data['NgayBatDau'],
            $data['NgayKetThuc']
        ]);
    }

    public function edit($data)
    {
        $sql = "UPDATE DangKyDichVu SET MaSV = ?, MaDV = ?, NgayBatDau = ?, NgayKetThuc = ? WHERE MaDKDV = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaSV'],
            $data['MaDV'],
            $data['NgayBatDau'],
            $data['NgayKetThuc'],
            $data['MaDKDV']
        ]);
    }

    public function delete($maDKDV)
    {
        $sql = "DELETE FROM DangKyDichVu WHERE MaDKDV = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maDKDV]);
    }

    public function getSinhViens()
    {
        $stmt = $this->db->query('SELECT * FROM SinhVien');
        return $stmt->fetchAll();
    }

    public function getDichVus()
    {
        $stmt = $this->db->query('SELECT * FROM DichVu');
        return $stmt->fetchAll();
    }
}
