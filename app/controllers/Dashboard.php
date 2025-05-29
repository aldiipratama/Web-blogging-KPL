<?php

class Dashboard extends Controller {
    public function __construct()
    {
        parent::__construct();
        
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Error', 'Anda harus login untuk mengakses dashboard.', 'danger');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Dashboard Penulis';
        $data['user'] = $this->model('User_model')->getUserById($_SESSION['user_id']);

        $artikelModel = $this->model('Artikel_model');
        $data['artikel_saya'] = $artikelModel->getArtikelByPenulisId($_SESSION['user_id']);

        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }

    
    public function comments()
    {
        $data['judul'] = 'Moderasi Komentar';
        $data['csrf_token'] = CSRF::generateToken();

        $komentarModel = $this->model('Komentar_model');
        
        $data['komentar'] = $komentarModel->getAllKomentar(); 

        $this->view('templates/header', $data);
        $this->view('dashboard/comments', $data); 
        $this->view('templates/footer');
    }

    
    public function approveComment($comment_id)
    {
        
        $comment_id = filter_var($comment_id, FILTER_VALIDATE_INT);
        if (!$comment_id) {
            Flasher::setFlash('Error', 'ID komentar tidak valid.', 'danger');
            header('Location: ' . BASEURL . '/dashboard/comments');
            exit;
        }

        $komentarModel = $this->model('Komentar_model');
        
        
        

        if ($komentarModel->updateKomentarStatus($comment_id, 'approved') > 0) {
            Flasher::setFlash('Berhasil', 'Komentar berhasil disetujui.', 'success');
            Log::userActivity($_SESSION['user_id'], $_SESSION['username'], "Approved comment ID: " . $comment_id);
        } else {
            Flasher::setFlash('Error', 'Gagal menyetujui komentar.', 'danger');
            Log::error("Failed to approve comment ID: " . $comment_id . " by user " . $_SESSION['user_id']);
        }
        header('Location: ' . BASEURL . '/dashboard/comments');
        exit;
    }

    
    public function rejectComment($comment_id)
    {
        
        $comment_id = filter_var($comment_id, FILTER_VALIDATE_INT);
        if (!$comment_id) {
            Flasher::setFlash('Error', 'ID komentar tidak valid.', 'danger');
            header('Location: ' . BASEURL . '/dashboard/comments');
            exit;
        }

        $komentarModel = $this->model('Komentar_model');
        

        if ($komentarModel->updateKomentarStatus($comment_id, 'rejected') > 0) {
            Flasher::setFlash('Berhasil', 'Komentar berhasil ditolak.', 'success');
            Log::userActivity($_SESSION['user_id'], $_SESSION['username'], "Rejected comment ID: " . $comment_id);
        } else {
            Flasher::setFlash('Error', 'Gagal menolak komentar.', 'danger');
            Log::error("Failed to reject comment ID: " . $comment_id . " by user " . $_SESSION['user_id']);
        }
        header('Location: ' . BASEURL . '/dashboard/comments');
        exit;
    }
}