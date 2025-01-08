<?php

use App\Models\adminModel;

if (!function_exists('getAdminProfileData')) {

    /**
     * Get the admin profile data from the session and database.
     *
     * @return array|redirect A profile data array with 'username' and 'email' if valid,
     *                         or a redirect to the login page if invalid or no session exists.
     */

    function getAdminProfileData()
    {
        $adminModel = new adminModel();

        $idAdmin = session()->get('adminId');
        if (!$idAdmin) return redirect()->to('/login');

        $adminData = $adminModel->find($idAdmin);
        if (
            $adminData &&
            $adminData['username'] === session()->get('usernameAdmin') &&
            $adminData['email'] === session()->get('emailAdmin')
        ) {
            return [
                'username' => $adminData['username'],
                'email' => $adminData['email'],
                'tglTerdaftar' => $adminData['tanggal_terdaftar'],
            ];
        } else {
            return redirect()->to('/login');
        }
    }
}
