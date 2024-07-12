<?php
class Phong
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM Phong');
        return $stmt->fetchAll();
    }

    public function getById($maPhong)
    {
        $stmt = $this->db->prepare('SELECT * FROM Phong WHERE MaPhong = ?');
        $stmt->execute([$maPhong]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO Phong (TenPhong, LoaiPhong, SoLuongNguoiHienTai, TinhTrang) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['TenPhong'],
            $data['LoaiPhong'],
            $data['SoLuongNguoiHienTai'],
            $data['TinhTrang']
        ]);
    }

    public function edit($data)
    {
        $sql = "UPDATE Phong SET TenPhong = ?, LoaiPhong = ?, SoLuongNguoiHienTai = ?, TinhTrang = ? WHERE MaPhong = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['TenPhong'],
            $data['LoaiPhong'],
            $data['SoLuongNguoiHienTai'],
            $data['TinhTrang'],
            $data['MaPhong']
        ]);
    }

    public function delete($maPhong)
    {
        $sql = "DELETE FROM Phong WHERE MaPhong = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maPhong]);
    }
}
