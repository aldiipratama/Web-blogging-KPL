<?php

class Home extends Controller {
    public function index()
    {
        $data['judul'] = 'Beranda Berita Terbaru';
        $artikelModel = $this->model('Artikel_model');
        
        
        $all_articles = $artikelModel->getAllArtikelPublished(); 

        
        $data['main_article'] = null;
        $data['other_articles'] = [];

        if (!empty($all_articles)) {
            $data['main_article'] = array_shift($all_articles); 
            $data['other_articles'] = $all_articles; 
        }

        $this->view('templates/header', $data);
        $this->view('home/index', $data); 
        $this->view('templates/footer');
    }
}