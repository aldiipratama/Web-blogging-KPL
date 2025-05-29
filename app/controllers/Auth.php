<?php

class Auth extends Controller {
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $data['judul'] = 'Login Penulis';
        $data['csrf_token'] = CSRF::generateToken();

        $this->view('templates/header', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer');
    }

    public function processLogin()
    {
        $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';
        $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        $recaptcha_secret = RECAPTCHA_SECRET_KEY;
        $recaptcha_data = [
            'secret' => $recaptcha_secret,
            'response' => $recaptcha_response
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($recaptcha_data)
            ]
        ];
        $context  = stream_context_create($options);
        $recaptcha_result = file_get_contents($recaptcha_url, false, $context);
        $recaptcha_json = json_decode($recaptcha_result, true);

        if (!$recaptcha_json['success']) {
            Log::warning("CAPTCHA gagal saat login dari IP: " . $_SERVER['REMOTE_ADDR']);
            Flasher::setFlash('Error', 'Verifikasi CAPTCHA gagal. Silakan coba lagi.', 'danger');
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        // 3. Validasi Input Form (username, password)
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = $_POST['password'] ?? ''; // Jangan sanitize password sebelum hash dan verifikasi

        if (empty($username) || empty($password)) {
            Flasher::setFlash('Error', 'Username dan password tidak boleh kosong.', 'danger');
            Log::warning("Login attempt with empty username/password from IP: " . $_SERVER['REMOTE_ADDR']);
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

        $userModel = $this->model('User_model');
        $user = $userModel->getUserByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Login sukses
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                Flasher::setFlash('Berhasil', 'Selamat datang, ' . $user['nama_lengkap'] . '!', 'success');
                Log::userActivity($user['id'], $user['username'], "Logged in successfully.");
                header('Location: ' . BASEURL . '/dashboard'); // Redirect ke dashboard penulis
                exit;
            } else {
                // Password salah
                Flasher::setFlash('Error', 'Password salah.', 'danger');
                Log::warning("Failed login attempt for username: $username (wrong password) from IP: " . $_SERVER['REMOTE_ADDR']);
            }
        } else {
            // Username tidak ditemukan
            Flasher::setFlash('Error', 'Username tidak ditemukan.', 'danger');
            Log::warning("Failed login attempt for username: $username (username not found) from IP: " . $_SERVER['REMOTE_ADDR']);
        }

        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }

    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }

        $data['judul'] = 'Registrasi Penulis Baru';
        $data['csrf_token'] = CSRF::generateToken();

        $this->view('templates/header', $data);
        $this->view('auth/register', $data);
        $this->view('templates/footer');
    }

    public function processRegister()
    {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nama_lengkap = filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        if (empty($username) || empty($nama_lengkap) || empty($password) || empty($confirm_password)) {
            Flasher::setFlash('Error', 'Semua kolom harus diisi.', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }

        if (strlen($username) < 4 || strlen($username) > 50) {
            Flasher::setFlash('Error', 'Username minimal 4 karakter dan maksimal 50 karakter.', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }

        if ($password !== $confirm_password) {
            Flasher::setFlash('Error', 'Konfirmasi password tidak cocok.', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }

        if (strlen($password) < 6) {
            Flasher::setFlash('Error', 'Password minimal 6 karakter.', 'danger');
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }

        $userModel = $this->model('User_model');

        if ($userModel->getUserByUsername($username)) {
            Flasher::setFlash('Error', 'Username sudah terdaftar. Silakan pilih username lain.', 'danger');
            Log::warning("Registration attempt with existing username: " . $username);
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'username' => $username,
            'password' => $hashed_password,
            'nama_lengkap' => $nama_lengkap
        ];

        $registerResult = $userModel->registerUser($data);

        if ($registerResult > 0) {
            Flasher::setFlash('Berhasil', 'Registrasi berhasil. Silakan login.', 'success');
            Log::userActivity(null, $username, "User registered successfully.");
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        } elseif ($registerResult === -1) {
            Flasher::setFlash('Error', 'Username sudah terdaftar. Silakan pilih username lain.', 'danger');
            Log::warning("Registration failed due to duplicate username (detected by DB error): " . $username);
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        } else {
            Flasher::setFlash('Error', 'Registrasi gagal. Coba lagi.', 'danger');
            Log::error("Failed to register user: $username (unexpected result: " . $registerResult . ")");
            header('Location: ' . BASEURL . '/auth/register');
            exit;
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user_id'])) {
            Log::userActivity($_SESSION['user_id'], $_SESSION['username'], "Logged out.");
        }
        session_unset();
        session_destroy();
        session_start();
        Flasher::setFlash('Berhasil', 'Anda telah logout.', 'info');
        header('Location: ' . BASEURL . '/auth/login');
        exit;
    }
}