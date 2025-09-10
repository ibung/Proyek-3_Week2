<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('login_view');
    }

    public function process()
    {
        // 1. Aturan Validasi
        $rules = [
            'username' => 'required|alpha_numeric',
            'password' => 'required|min_length[5]'
        ];

        // 2. Jalankan Validasi
        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembali ke halaman login dengan pesan error
            return redirect()->to('/login')->withInput()->with('validation', $this->validator);
        }

        // 3. Jika Validasi Berhasil, Lanjutkan Proses Login
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'username' => $user['username'],
                    'isLoggedIn' => TRUE
                ]);
                return redirect()->to('/mahasiswa');
            }
        }
        
        $session->setFlashdata('msg', 'Username atau Password Salah');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}