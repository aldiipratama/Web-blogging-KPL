<?php

class Artikel extends Controller {
    public function __construct($method = null)
    {
        parent::__construct();
        
        $auth_required_methods = ['create', 'store', 'edit', 'update', 'pull', 'approveComment', 'rejectComment'];

        if (in_array($method, $auth_required_methods)) {
            if (!isset($_SESSION['user_id'])) {
                Flasher::setFlash('Error', 'Anda harus login untuk mengakses fitur ini.', 'danger');
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }
        }
    }

    public function index()
    {
        $data['judul'] = 'Arsip Berita & Artikel'; 
        $artikelModel = $this->model('Artikel_model');
        $data['artikel'] = $artikelModel->getAllArtikelPublished(); 

        $this->view('templates/header', $data);
        $this->view('artikel/index', $data); 
        $this->view('templates/footer');
    }

    
    public function create()
    {
        
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Error', 'Anda harus login untuk membuat artikel.', 'danger');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $data['judul'] = 'Buat Artikel Baru';
        $data['csrf_token'] = CSRF::generateToken();

        $this->view('templates/header', $data);
        $this->view('artikel/create', $data);
        $this->view('templates/footer');
    }

    
    public function store()
    {
        
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Error', 'Anda harus login untuk membuat artikel.', 'danger');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        
        $judul = filter_input(INPUT_POST, 'judul', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $isi_artikel = $_POST['isi_artikel'] ?? '';
        $gambar_url = filter_input(INPUT_POST, 'gambar_url', FILTER_SANITIZE_URL);
        $kata_kunci = filter_input(INPUT_POST, 'kata_kunci', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (empty($judul) || empty($isi_artikel)) {
            Flasher::setFlash('Error', 'Judul dan isi artikel tidak boleh kosong.', 'danger');
            header('Location: ' . BASEURL . '/artikel/create');
            exit;
        }

        $slug = $this->generateSlug($judul);

        $data = [
            'judul' => $judul,
            'slug' => $slug,
            'penulis_id' => $_SESSION['user_id'],
            'gambar_url' => $gambar_url,
            'isi_artikel' => $isi_artikel,
            'kata_kunci' => $kata_kunci,
            'status' => in_array($status, ['published', 'draft']) ? $status : 'draft'
        ];

        $artikelModel = $this->model('Artikel_model');
        if ($artikelModel->createArtikel($data) > 0) {
            Flasher::setFlash('Berhasil', 'Artikel berhasil dibuat!', 'success');
            Log::userActivity($_SESSION['user_id'], $_SESSION['username'], "Created new article: '" . $judul . "'");
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        } else {
            Flasher::setFlash('Error', 'Gagal membuat artikel.', 'danger');
            Log::error("Failed to create article by user " . $_SESSION['user_id'] . ": " . $judul);
            header('Location: ' . BASEURL . '/artikel/create');
            exit;
        }
    }

    
    public function edit($slug)
    {
        
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Error', 'Anda harus login untuk mengubah artikel.', 'danger');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        
        if (empty($slug)) {
            Flasher::setFlash('Error', 'Artikel tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $artikelModel = $this->model('Artikel_model');
        $artikel = $artikelModel->getArtikelBySlug($slug);

        
        if (!$artikel) {
            Flasher::setFlash('Error', 'Artikel tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        
        if ($artikel['penulis_id'] != $_SESSION['user_id']) {
            Flasher::setFlash('Error', 'Anda tidak memiliki izin untuk mengubah artikel ini.', 'danger');
            Log::warning("Unauthorized attempt to edit article ID: " . $artikel['id'] . " by user " . $_SESSION['user_id']);
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $data['judul'] = 'Ubah Artikel: ' . $artikel['judul'];
        $data['artikel'] = $artikel;
        $data['csrf_token'] = CSRF::generateToken();
        $data['riwayat_revisi'] = $artikelModel->getArtikelRevisi($artikel['id']);

        $this->view('templates/header', $data);
        $this->view('artikel/edit', $data);
        $this->view('templates/footer');
    }

    
    public function update()
    {
        
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Error', 'Anda harus login untuk mengubah artikel.', 'danger');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $judul = filter_input(INPUT_POST, 'judul', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $isi_artikel = $_POST['isi_artikel'] ?? '';
        $gambar_url = filter_input(INPUT_POST, 'gambar_url', FILTER_SANITIZE_URL);
        $kata_kunci = filter_input(INPUT_POST, 'kata_kunci', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$id || empty($judul) || empty($isi_artikel)) {
            Flasher::setFlash('Error', 'Data artikel tidak lengkap atau tidak valid.', 'danger');
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $artikelModel = $this->model('Artikel_model');
        $artikelLama = $artikelModel->getArtikelById($id);

        
        if (!$artikelLama) {
            Flasher::setFlash('Error', 'Artikel tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }
        if ($artikelLama['penulis_id'] != $_SESSION['user_id']) {
            Flasher::setFlash('Error', 'Anda tidak memiliki izin untuk mengubah artikel ini.', 'danger');
            Log::warning("Unauthorized attempt to update article ID: " . $id . " by user " . $_SESSION['user_id']);
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $data = [
            'judul' => $judul,
            'gambar_url' => $gambar_url,
            'isi_artikel' => $isi_artikel,
            'kata_kunci' => $kata_kunci,
            'status' => in_array($status, ['published', 'draft', 'pulled']) ? $status : 'draft'
        ];

        if ($judul !== $artikelLama['judul']) {
            $data['slug'] = $this->generateSlug($judul);
        } else {
            $data['slug'] = $artikelLama['slug'];
        }

        if ($artikelModel->updateArtikel($id, $data, $_SESSION['user_id']) > 0) {
            Flasher::setFlash('Berhasil', 'Artikel berhasil diubah dan riwayat revisi dicatat!', 'success');
            Log::userActivity($_SESSION['user_id'], $_SESSION['username'], "Updated article ID: " . $id . " ('" . $judul . "')");
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        } else {
            Flasher::setFlash('Info', 'Tidak ada perubahan pada artikel atau gagal mengupdate.', 'info');
            Log::info("No changes or failed update for article ID: " . $id . " by user " . $_SESSION['user_id']);
            header('Location: ' . BASEURL . '/artikel/edit/' . $artikelLama['slug']);
            exit;
        }
    }

    
    public function pull($id)
    {
        
        if (!isset($_SESSION['user_id'])) {
            Flasher::setFlash('Error', 'Anda harus login untuk menarik artikel.', 'danger');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        
        $id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$id) {
            Flasher::setFlash('Error', 'ID artikel tidak valid.', 'danger');
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $artikelModel = $this->model('Artikel_model');
        $artikel = $artikelModel->getArtikelById($id);

        
        if (!$artikel) {
            Flasher::setFlash('Error', 'Artikel tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }
        
        if ($artikel['penulis_id'] != $_SESSION['user_id']) {
            Flasher::setFlash('Error', 'Anda tidak memiliki izin untuk menarik artikel ini.', 'danger');
            Log::warning("Unauthorized attempt to pull article ID: " . $id . " by user " . $_SESSION['user_id']);
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        if ($artikelModel->pullArtikel($id, $_SESSION['user_id']) > 0) {
            Flasher::setFlash('Berhasil', 'Artikel berhasil ditarik dari publikasi!', 'success');
            Log::userActivity($_SESSION['user_id'], $_SESSION['username'], "Pulled article ID: " . $id . " ('" . $artikel['judul'] . "')");
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        } else {
            Flasher::setFlash('Error', 'Gagal menarik artikel.', 'danger');
            Log::error("Failed to pull article ID: " . $id . " by user " . $_SESSION['user_id']);
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }
    }

    
    public function detail($slug)
    {
        
        if (empty($slug)) {
            Flasher::setFlash('Error', 'Artikel tidak ditemukan.', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }

        $artikelModel = $this->model('Artikel_model');
        $komentarModel = $this->model('Komentar_model');

        $data['artikel'] = $artikelModel->getArtikelBySlug($slug);

        if (!$data['artikel'] || $data['artikel']['status'] !== 'published') {
            Flasher::setFlash('Error', 'Artikel tidak ditemukan atau tidak tersedia.', 'danger');
            header('Location: ' . BASEURL);
            exit;
        }

        $data['komentar'] = $komentarModel->getApprovedKomentarByArtikelId($data['artikel']['id']);
        $data['judul'] = $data['artikel']['judul'];
        $data['csrf_token'] = CSRF::generateToken();

        $this->view('templates/header', $data);
        $this->view('artikel/detail', $data);
        $this->view('templates/footer');
    }

    
    public function addKomentar()
    {
        $artikel_id = filter_input(INPUT_POST, 'artikel_id', FILTER_VALIDATE_INT);
        $nama_komentator = filter_input(INPUT_POST, 'nama_komentator', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email_komentator = filter_input(INPUT_POST, 'email_komentator', FILTER_SANITIZE_EMAIL);
        $isi_komentar = filter_input(INPUT_POST, 'isi_komentar', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if (!$artikel_id || empty($nama_komentator) || empty($isi_komentar)) {
            Flasher::setFlash('Error', 'Nama dan komentar tidak boleh kosong.', 'danger');
            header('Location: ' . BASEURL . '/artikel/detail/' . $_POST['artikel_slug']);
            exit;
        }

        if (!empty($email_komentator) && !filter_var($email_komentator, FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('Error', 'Format email tidak valid.', 'danger');
            header('Location: ' . BASEURL . '/artikel/detail/' . $_POST['artikel_slug']);
            exit;
        }

        $data = [
            'artikel_id' => $artikel_id,
            'nama_komentator' => $nama_komentator,
            'email_komentator' => $email_komentator,
            'isi_komentar' => $isi_komentar
        ];

        $komentarModel = $this->model('Komentar_model');
        if ($komentarModel->addKomentar($data) > 0) {
            Flasher::setFlash('Berhasil', 'Komentar Anda berhasil ditambahkan dan akan ditampilkan setelah disetujui.', 'success');
            Log::info("New comment added to article ID: " . $artikel_id . " by " . $nama_komentator);
        } else {
            Flasher::setFlash('Error', 'Gagal menambahkan komentar.', 'danger');
            Log::error("Failed to add comment to article ID: " . $artikel_id . " by " . $nama_komentator);
        }
        header('Location: ' . BASEURL . '/artikel/detail/' . $_POST['artikel_slug']);
        exit;
    }


    private function generateSlug($title)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        $artikelModel = $this->model('Artikel_model');
        $originalSlug = $slug;
        $i = 1;
        while ($artikelModel->getArtikelBySlug($slug)) {
            $slug = $originalSlug . '-' . $i;
            $i++;
        }
        return $slug;
    }
}