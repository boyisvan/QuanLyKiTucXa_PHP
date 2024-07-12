<?php
class HopDong
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('
        SELECT HopDong.*, SinhVien.HoTen AS TenSinhVien, Phong.TenPhong AS TenPhong,
        CASE
            WHEN HopDong.NgayKetThuc > NOW() THEN "Còn Hạn"
            ELSE "Đã Hết Hạn"
        END AS HanHopDong
        FROM HopDong 
        JOIN SinhVien ON HopDong.MaSV = SinhVien.MaSV 
        JOIN Phong ON HopDong.MaPhong = Phong.MaPhong
    ');
        return $stmt->fetchAll();
    }


    public function getById($maHD)
    {
        $stmt = $this->db->prepare('SELECT * FROM HopDong WHERE MaHD = ?');
        $stmt->execute([$maHD]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO HopDong (MaSV, MaPhong, NgayBatDau, NgayKetThuc, DatCoc, TinhTrang) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaSV'],
            $data['MaPhong'],
            $data['NgayBatDau'],
            $data['NgayKetThuc'],
            $data['DatCoc'],
            $data['TinhTrang']
        ]);
    }

    public function edit($data)
    {
        $sql = "UPDATE HopDong SET MaSV = ?, MaPhong = ?, NgayBatDau = ?, NgayKetThuc = ?, DatCoc = ?, TinhTrang = ? WHERE MaHD = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['MaSV'],
            $data['MaPhong'],
            $data['NgayBatDau'],
            $data['NgayKetThuc'],
            $data['DatCoc'],
            $data['TinhTrang'],
            $data['MaHD']
        ]);
    }

    public function delete($maHD)
    {
        $sql = "DELETE FROM HopDong WHERE MaHD = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maHD]);
    }

    public function getSinhViens()
    {
        $stmt = $this->db->query('SELECT * FROM SinhVien');
        return $stmt->fetchAll();
    }

    public function getPhongs()
    {
        $stmt = $this->db->query('SELECT * FROM Phong');
        return $stmt->fetchAll();
    }
}
