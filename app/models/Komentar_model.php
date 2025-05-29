<?php

class Komentar_model {
    private $table = 'komentar';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    
    public function addKomentar($data)
    {
        $query = "INSERT INTO " . $this->table . " (artikel_id, nama_komentator, email_komentator, isi_komentar, status)
                  VALUES (:artikel_id, :nama_komentator, :email_komentator, :isi_komentar, :status)";
        $stmt = $this->db->prepare($query, [
            ':artikel_id' => $data['artikel_id'],
            ':nama_komentator' => $data['nama_komentator'],
            ':email_komentator' => $data['email_komentator'],
            ':isi_komentar' => $data['isi_komentar'],
            ':status' => 'pending'
        ]);
        $this->db->execute($stmt);
        $rowCount = $this->db->rowCount($stmt);
        $this->db->closeStmt($stmt);
        return $rowCount;
    }

    
    public function getApprovedKomentarByArtikelId($artikel_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE artikel_id = :artikel_id AND status = 'approved' ORDER BY tanggal_komentar DESC";
        $stmt = $this->db->prepare($query, [':artikel_id' => $artikel_id]);
        $this->db->execute($stmt);
        $results = $this->db->resultSet($stmt);
        $this->db->closeStmt($stmt);
        return $results;
    }

    
    public function getAllKomentar()
    {
        $query = "SELECT k.*, a.judul AS judul_artikel
                  FROM " . $this->table . " k
                  JOIN artikel a ON k.artikel_id = a.id
                  ORDER BY k.tanggal_komentar DESC";
        $stmt = $this->db->prepare($query);
        $this->db->execute($stmt);
        $results = $this->db->resultSet($stmt);
        $this->db->closeStmt($stmt);
        return $results;
    }

    
    public function updateKomentarStatus($id, $status)
    {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query, [
            ':status' => $status,
            ':id' => $id
        ]);
        $this->db->execute($stmt);
        $rowCount = $this->db->rowCount($stmt);
        $this->db->closeStmt($stmt);
        return $rowCount;
    }
}