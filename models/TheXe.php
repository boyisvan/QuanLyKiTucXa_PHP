<?php
class TheXe
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('
            SELECT TheXe.*, SinhVien.HoTen AS TenSinhVien 
            FROM TheXe 
            JOIN SinhVien ON TheXe.MaSV = SinhVien.MaSV
        ');
        return $stmt->fetchAll();
    }

    public function getById($maThe)
    {
        $stmt = $this->db->prepare('SELECT * FROM TheXe WHERE MaThe = ?');
        $stmt->execute([$maThe]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO TheXe (MaSV, NgayBatDau, NgayKetThuc) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaSV'],
            $data['NgayBatDau'],
            $data['NgayKetThuc']
        ]);
    }

    public function edit($data)
    {
        $sql = "UPDATE TheXe SET MaSV = ?, NgayBatDau = ?, NgayKetThuc = ? WHERE MaThe = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaSV'],
            $data['NgayBatDau'],
            $data['NgayKetThuc'],
            $data['MaThe']
        ]);
    }

    public function delete($maThe)
    {
        $sql = "DELETE FROM TheXe WHERE MaThe = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maThe]);
    }

    public function getSinhViens()
    {
        $stmt = $this->db->query('SELECT * FROM SinhVien');
        return $stmt->fetchAll();
    }
}
