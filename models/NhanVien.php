<?php
class NhanVien
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM NhanVien');
        return $stmt->fetchAll();
    }

    public function getById($maNV)
    {
        $stmt = $this->db->prepare('SELECT * FROM NhanVien WHERE MaNV = ?');
        $stmt->execute([$maNV]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO NhanVien (HoTen, ChucVu, SoDienThoai, Email, AnhNhanVien) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['HoTen'],
            $data['ChucVu'],
            $data['SoDienThoai'],
            $data['Email'],
            file_get_contents($_FILES['AnhNhanVien']['tmp_name'])
        ]);
    }

    public function edit($data)
    {
        if (!empty($_FILES['AnhNhanVien']['tmp_name'])) {
            $sql = "UPDATE NhanVien SET HoTen = ?, ChucVu = ?, SoDienThoai = ?, Email = ?, AnhNhanVien = ? WHERE MaNV = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['HoTen'],
                $data['ChucVu'],
                $data['SoDienThoai'],
                $data['Email'],
                file_get_contents($_FILES['AnhNhanVien']['tmp_name']),
                $data['MaNV']
            ]);
        } else {
            $sql = "UPDATE NhanVien SET HoTen = ?, ChucVu = ?, SoDienThoai = ?, Email = ? WHERE MaNV = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['HoTen'],
                $data['ChucVu'],
                $data['SoDienThoai'],
                $data['Email'],
                $data['MaNV']
            ]);
        }
    }

    public function delete($maNV)
    {
        $sql = "DELETE FROM NhanVien WHERE MaNV = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maNV]);
    }
}
