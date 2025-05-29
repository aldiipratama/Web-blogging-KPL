<?php

class Artikel_model {
    private $table = 'artikel';
    private $table_revisi = 'artikel_revisi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    
    public function getAllArtikelPublished()
    {
        $query = "SELECT a.*, u.nama_lengkap AS nama_penulis
                  FROM " . $this->table . " a
                  JOIN users u ON a.penulis_id = u.id
                  WHERE a.status = 'published'
                  ORDER BY a.tanggal_publikasi DESC";
        $stmt = $this->db->prepare($query);
        $this->db->execute($stmt);
        $results = $this->db->resultSet($stmt);
        $this->db->closeStmt($stmt);
        return $results;
    }

    
    public function getArtikelBySlug($slug)
    {
        $query = "SELECT a.*, u.nama_lengkap AS nama_penulis
                  FROM " . $this->table . " a
                  JOIN users u ON a.penulis_id = u.id
                  WHERE a.slug = :slug";
        $stmt = $this->db->prepare($query, [':slug' => $slug]);
        $this->db->execute($stmt);
        $artikel = $this->db->single($stmt);
        $this->db->closeStmt($stmt);
        return $artikel;
    }

    
    public function createArtikel($data)
    {
        $query = "INSERT INTO " . $this->table . " (judul, slug, penulis_id, gambar_url, isi_artikel, kata_kunci, status)
                  VALUES (:judul, :slug, :penulis_id, :gambar_url, :isi_artikel, :kata_kunci, :status)";
        $stmt = $this->db->prepare($query, [
            ':judul' => $data['judul'],
            ':slug' => $data['slug'],
            ':penulis_id' => $data['penulis_id'],
            ':gambar_url' => $data['gambar_url'],
            ':isi_artikel' => $data['isi_artikel'],
            ':kata_kunci' => $data['kata_kunci'],
            ':status' => $data['status']
        ]);
        $this->db->execute($stmt);
        $rowCount = $this->db->rowCount($stmt);
        $this->db->closeStmt($stmt);
        return $rowCount;
    }

    
    public function updateArtikel($id, $data, $revisor_id)
    {
        
        $oldArtikel = $this->getArtikelById($id);
        if (!$oldArtikel) {
            return false; 
        }

        
        $query = "UPDATE " . $this->table . " SET
                    judul = :judul,
                    slug = :slug, -- Tambahkan slug jika berubah
                    gambar_url = :gambar_url,
                    isi_artikel = :isi_artikel,
                    kata_kunci = :kata_kunci,
                    status = :status,
                    tanggal_publikasi = :tanggal_publikasi
                  WHERE id = :id";
        $stmt = $this->db->prepare($query, [
            ':judul' => $data['judul'],
            ':slug' => $data['slug'],
            ':gambar_url' => $data['gambar_url'],
            ':isi_artikel' => $data['isi_artikel'],
            ':kata_kunci' => $data['kata_kunci'],
            ':status' => $data['status'],
            ':tanggal_publikasi' => $data['tanggal_publikasi'] ?? $oldArtikel['tanggal_publikasi'],
            ':id' => $id
        ]);
        $this->db->execute($stmt);
        $rowCount = $this->db->rowCount($stmt);
        $this->db->closeStmt($stmt);

        
        if ($rowCount > 0 && ($oldArtikel['judul'] != $data['judul'] || $oldArtikel['gambar_url'] != $data['gambar_url'] || $oldArtikel['isi_artikel'] != $data['isi_artikel'] || $oldArtikel['status'] != $data['status'])) {
            $perubahan = [];
            if ($oldArtikel['judul'] != $data['judul']) {
                $perubahan[] = "Judul diubah dari '" . $oldArtikel['judul'] . "' menjadi '" . $data['judul'] . "'";
            }
            if ($oldArtikel['gambar_url'] != $data['gambar_url']) {
                $perubahan[] = "URL gambar diubah dari '" . $oldArtikel['gambar_url'] . "' menjadi '" . $data['gambar_url'] . "'";
            }
            if ($oldArtikel['isi_artikel'] != $data['isi_artikel']) {
                $perubahan[] = "Isi artikel diubah.";
            }
            if ($oldArtikel['status'] != $data['status']) {
                $perubahan[] = "Status diubah dari '" . $oldArtikel['status'] . "' menjadi '" . $data['status'] . "'";
            }
            
            $this->logArtikelRevisi(
                $id,
                $oldArtikel['judul'],
                $oldArtikel['gambar_url'],
                $oldArtikel['isi_artikel'],
                implode("\n", $perubahan),
                $revisor_id
            );
        }

        return $rowCount;
    }

    
    public function pullArtikel($id, $revisor_id)
    {
        $oldArtikel = $this->getArtikelById($id);
        if (!$oldArtikel) {
            return false;
        }

        $query = "UPDATE " . $this->table . " SET status = 'pulled' WHERE id = :id";
        $stmt = $this->db->prepare($query, [':id' => $id]);
        $this->db->execute($stmt);
        $rowCount = $this->db->rowCount($stmt);
        $this->db->closeStmt($stmt);

        if ($rowCount > 0) {
            $this->logArtikelRevisi(
                $id,
                $oldArtikel['judul'],
                $oldArtikel['gambar_url'],
                $oldArtikel['isi_artikel'],
                "Artikel ditarik dari publikasi. Status sebelumnya: " . $oldArtikel['status'],
                $revisor_id
            );
        }
        return $rowCount;
    }

    
    public function getArtikelById($id)
    {
        $query = "SELECT a.*, u.nama_lengkap AS nama_penulis
                  FROM " . $this->table . " a
                  JOIN users u ON a.penulis_id = u.id
                  WHERE a.id = :id";
        $stmt = $this->db->prepare($query, [':id' => $id]);
        $this->db->execute($stmt);
        $artikel = $this->db->single($stmt);
        $this->db->closeStmt($stmt);
        return $artikel;
    }

    
    private function logArtikelRevisi($artikel_id, $judul_lama, $gambar_url_lama, $isi_artikel_lama, $perubahan, $revisor_id)
    {
        $query = "INSERT INTO " . $this->table_revisi . " (artikel_id, judul_lama, gambar_url_lama, isi_artikel_lama, perubahan, revisor_id)
                  VALUES (:artikel_id, :judul_lama, :gambar_url_lama, :isi_artikel_lama, :perubahan, :revisor_id)";
        $stmt = $this->db->prepare($query, [
            ':artikel_id' => $artikel_id,
            ':judul_lama' => $judul_lama,
            ':gambar_url_lama' => $gambar_url_lama,
            ':isi_artikel_lama' => $isi_artikel_lama,
            ':perubahan' => $perubahan,
            ':revisor_id' => $revisor_id
        ]);
        $this->db->execute($stmt);
        $this->db->closeStmt($stmt);
    }

    
    public function getArtikelRevisi($artikel_id)
    {
        $query = "SELECT ar.*, u.nama_lengkap AS nama_revisor
                  FROM " . $this->table_revisi . " ar
                  LEFT JOIN users u ON ar.revisor_id = u.id
                  WHERE ar.artikel_id = :artikel_id
                  ORDER BY ar.tanggal_revisi DESC";
        $stmt = $this->db->prepare($query, [':artikel_id' => $artikel_id]);
        $this->db->execute($stmt);
        $results = $this->db->resultSet($stmt);
        $this->db->closeStmt($stmt);
        return $results;
    }

    
    public function getArtikelByPenulisId($penulis_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE penulis_id = :penulis_id ORDER BY tanggal_publikasi DESC";
        $stmt = $this->db->prepare($query, [':penulis_id' => $penulis_id]);
        $this->db->execute($stmt);
        $results = $this->db->resultSet($stmt);
        $this->db->closeStmt($stmt);
        return $results;
    }
}