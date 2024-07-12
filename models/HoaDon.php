<?php
class HoaDon
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('
            SELECT HoaDon.*, Phong.TenPhong 
            FROM HoaDon 
            JOIN Phong ON HoaDon.MaPhong = Phong.MaPhong
        ');
        return $stmt->fetchAll();
    }

    public function getById($maHD)
    {
        $stmt = $this->db->prepare('SELECT * FROM HoaDon WHERE MaHD = ?');
        $stmt->execute([$maHD]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO HoaDon (MaPhong, NgayTao, TongTien) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaPhong'],
            $data['NgayTao'],
            $data['TongTien']
        ]);
    }

    public function edit($data)
    {
        $sql = "UPDATE HoaDon SET MaPhong = ?, NgayTao = ?, TongTien = ? WHERE MaHD = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaPhong'],
            $data['NgayTao'],
            $data['TongTien'],
            $data['MaHD']
        ]);
    }

    public function delete($maHD)
    {
        $sql = "DELETE FROM HoaDon WHERE MaHD = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maHD]);
    }

    public function getPhongs()
    {
        $stmt = $this->db->query('SELECT * FROM Phong');
        return $stmt->fetchAll();
    }
}
