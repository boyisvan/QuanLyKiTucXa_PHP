<?php
class SinhVien
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM SinhVien');
        return $stmt->fetchAll();
    }

    public function getById($maSV)
    {
        $stmt = $this->db->prepare('SELECT * FROM SinhVien WHERE MaSV = ?');
        $stmt->execute([$maSV]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO SinhVien (HoTen, NgaySinh, GioiTinh, DiaChi, SoDienThoai, Email, AnhSinhVien) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['HoTen'],
            $data['NgaySinh'],
            $data['GioiTinh'],
            $data['DiaChi'],
            $data['SoDienThoai'],
            $data['Email'],
            file_get_contents($_FILES['AnhSinhVien']['tmp_name'])
        ]);
    }

    public function edit($data)
    {
        if (!empty($_FILES['AnhSinhVien']['tmp_name'])) {
            $sql = "UPDATE SinhVien SET HoTen = ?, NgaySinh = ?, GioiTinh = ?, DiaChi = ?, SoDienThoai = ?, Email = ?, AnhSinhVien = ? WHERE MaSV = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['HoTen'],
                $data['NgaySinh'],
                $data['GioiTinh'],
                $data['DiaChi'],
                $data['SoDienThoai'],
                $data['Email'],
                file_get_contents($_FILES['AnhSinhVien']['tmp_name']),
                $data['MaSV']
            ]);
        } else {
            $sql = "UPDATE SinhVien SET HoTen = ?, NgaySinh = ?, GioiTinh = ?, DiaChi = ?, SoDienThoai = ?, Email = ? WHERE MaSV = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['HoTen'],
                $data['NgaySinh'],
                $data['GioiTinh'],
                $data['DiaChi'],
                $data['SoDienThoai'],
                $data['Email'],
                $data['MaSV']
            ]);
        }
    }

    public function delete($maSV)
    {
        $sql = "DELETE FROM SinhVien WHERE MaSV = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maSV]);
    }
}
