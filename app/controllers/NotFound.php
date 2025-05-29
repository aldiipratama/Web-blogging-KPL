<?php

class NotFound extends Controller {
    public function index()
    {
        
        http_response_code(404);
        
        $data['judul'] = '404 - Halaman Tidak Ditemukan';
        $this->view('templates/header', $data);
        $this->view('404/index', $data); 
        $this->view('templates/footer');
    }
}