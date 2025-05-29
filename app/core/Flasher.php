<?php

class Flasher {
    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        if (isset($_SESSION['flash'])) {
            echo '<div class="p-4 mb-4 text-sm text-' . $_SESSION['flash']['tipe'] . '-800 rounded-lg bg-' . $_SESSION['flash']['tipe'] . '-50 dark:bg-gray-800 dark:text-' . $_SESSION['flash']['tipe'] . '-400" role="alert">
                    <span class="font-medium">' . $_SESSION['flash']['pesan'] . '</span> ' . $_SESSION['flash']['aksi'] .
                 '</div>';
            unset($_SESSION['flash']);
        }
    }
}