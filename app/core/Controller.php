<?php

class Controller {
    
    public function __construct()
    {
        
        $this->validateCsrfToken();
    }

    protected function validateCsrfToken()
    {
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrf_token_field = CSRF::getTokenFieldName();
            $posted_token = $_POST[$csrf_token_field] ?? '';

            if (!CSRF::validateToken($posted_token)) {
                
                Log::warning("CSRF Token tidak valid untuk request POST dari IP: " . $_SERVER['REMOTE_ADDR'] . " | URL: " . $_SERVER['REQUEST_URI']);
                Flasher::setFlash('Error', 'Sesi Anda telah berakhir atau token CSRF tidak valid. Silakan coba lagi.', 'danger');
                
                
                if (isset($_SERVER['HTTP_REFERER'])) {
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                } else {
                    header('Location: ' . BASEURL); 
                }
                exit;
            }
        }
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model;
    }
}