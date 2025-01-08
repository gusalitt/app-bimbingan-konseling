<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\adminModel;


class AuthController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    public function showLoginForm()
    {
        return view('pages/auth/login');
    }

    public function showDaftarForm()
    {
        return view('pages/auth/daftar');
    }

    public function  daftar()
    {
        // Validation input
        $validation = service('validation');
        $validation->setRules([
            'username' => [
                'rules' => 'required|min_length[3]|max_length[50]|is_unique[admin.username]',
                'errors' => [
                    'required' => 'Username tidak boleh kosong. Silakan isi username Anda.',
                    'min_length' => 'Username terlalu pendek. Minimal 3 karakter diperlukan.',
                    'max_length' => 'Username terlalu panjang. Maksimal 50 karakter diperbolehkan.',
                    'is_unique' => 'Username sudah terdaftar. Silakan pilih username yang lain.',
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[admin.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. Silakan masukkan email Anda.',
                    'valid_email' => 'Format email salah. Pastikan email yang Anda masukkan valid.',
                    'is_unique' => 'Email ini sudah terdaftar. Gunakan email lain atau login.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. Silakan buat password Anda.',
                    'min_length' => 'Password terlalu pendek. Minimal 6 karakter diperlukan.',
                ]
            ],
            'confirmPassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong.',
                    'matches' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/daftar')->withInput()->with('errors', $validation->getErrors());
        }

        $this->adminModel->save([
            'slug' => url_title($this->request->getPost('username'), '-', true),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'tanggal_terdaftar' => date('Y-m-d H:i:s'),
            'status' => 'aktif'
        ]);

        return redirect()->to('login')->with('success', 'Pendaftaran akun berhasil, silahkan login terlebih dahulu')->with('modalMessage', true);
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $rememberMe = $this->request->getPost('remember_me');

        // Validation input
        $validation = service('validation');
        $validation->setRules([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong. Silakan masukkan email Anda.',
                    'valid_email' => 'Format email salah. Pastikan email yang Anda masukkan valid.',
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong. Silakan buat password Anda.',
                    'min_length' => 'Password terlalu pendek. Minimal 6 karakter diperlukan.',
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->to('/login')->withInput()->with('errors', $validation->getErrors());
        }

        $admin = $this->adminModel->where('email', $email)->first();
        if ($admin && password_verify($password, $admin['password'])) {
            // Save login session
            session()->set([
                'isLoggedIn' => true,
                'adminId' => $admin['id_admin'],
                'usernameAdmin' => $admin['username'],
                'emailAdmin' => $admin['email'],
            ]);

            if ($rememberMe) {
                $this->generateCookies($admin['username'], $admin['id_admin']);
            }

            session()->setFlashdata('success', 'Login berhasil!');
            session()->setFlashdata('modalMessage', true);

            $_SERVER['REQUEST_URI'] = '/dashboard';
            $dashboardController = new \App\Controllers\HomeController();
            return $dashboardController->dashboard();
        } else {
            return redirect()->to('/login')->withInput()->with('error', 'Email atau password anda salah!')->with('modalMessage', true);
        }
    }

    public function generateCookies($username, $idAdmin)
    {
        $rememberToken = $this->generateRememberToken($username);
        $cookieTime = 60 * 60 * 24 * 30;

        // // Update remember token
        $this->adminModel->update($idAdmin, ['remember_token' => $rememberToken]);

        // // Set Cookies
        helper('cookie');
        set_cookie('remember_id', $idAdmin, $cookieTime);
        set_cookie('remember_token', $rememberToken, $cookieTime);
    }

    public function generateRememberToken($username)
    {
        $timeStamp = time();
        $randomBytes = bin2hex(random_bytes(16));

        return hash('sha512', $username . $randomBytes . $timeStamp);
    }

    public function logout()
    {
        $adminId = session()->get('adminId');
        if ($adminId) {
            $this->adminModel->update($adminId, ['remember_token' => null]);
        }

        session()->destroy();

        helper('cookie');
        $cookieTime = time() - (60 * 60 * 24 * 30);
        set_cookie('remember_id', '', $cookieTime);
        set_cookie('remember_token', '', $cookieTime);

        return view('pages/auth/login', ['fixUrl' => true]);
    }
}
