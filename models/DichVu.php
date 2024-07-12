<?php
class DichVu
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM DichVu');
        return $stmt->fetchAll();
    }

    public function getById($maDV)
    {
        $stmt = $this->db->prepare('SELECT * FROM DichVu WHERE MaDV = ?');
        $stmt->execute([$maDV]);
        return $stmt->fetch();
    }

    public function add($data)
    {
        $sql = "INSERT INTO DichVu (TenDV) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['TenDV']]);
    }

    public function edit($data)
    {
        $sql = "UPDATE DichVu SET TenDV = ? WHERE MaDV = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$data['TenDV'], $data['MaDV']]);
    }

    public function delete($maDV)
    {
        $sql = "DELETE FROM DichVu WHERE MaDV = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$maDV]);
    }
}
