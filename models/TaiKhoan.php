<?php
class TaiKhoan
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM TaiKhoan');
        return $stmt->fetchAll();
    }

    public function getById($maTK)
    {
        $stmt = $this->db->prepare('SELECT * FROM TaiKhoan WHERE MaTK = ?');
        $stmt->execute([$maTK]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO TaiKhoan (TenDangNhap, MatKhau) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $data['TenDangNhap'],
            password_hash($data['MatKhau'], PASSWORD_BCRYPT)
        ]);
    }

    public function edit($data)
    {
        if (!empty($data['MatKhau'])) {
            $sql = "UPDATE TaiKhoan SET TenDangNhap = ?, MatKhau = ? WHERE MaTK = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['TenDangNhap'],
                password_hash($data['MatKhau'], PASSWORD_BCRYPT),
                $data['MaTK']
            ]);
        } else {
            $sql = "UPDATE TaiKhoan SET TenDangNhap = ? WHERE MaTK = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $data['TenDangNhap'],
                $data['MaTK']
            ]);
        }
    }

    public function delete($maTK)
    {
        $sql = "DELETE FROM TaiKhoan WHERE MaTK = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maTK]);
    }
}
