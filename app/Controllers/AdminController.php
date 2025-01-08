<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\adminModel;

class AdminController extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $sort = $this->request->getGet('sort') ?? 'id_admin';
        $order = $this->request->getGet('order') ?? 'desc';

        // Build query URL.
        $admin = $this->adminModel->select('id_admin, slug')->findAll();
        $urls = [];

        foreach ($admin as $admn) {
            $url = build_query_url(site_url('/admin/edit'), $this->request, $admn['slug']);
            $urls[$admn['id_admin']] = $url;
        }

        $admin = $this->adminModel->getFilteredData($keyword, $sort, $order);

        return [
            'admin' => $admin,
            'totalAdmin' => count($admin),
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'urls' => $urls,

            // To Print Data
            'columnNames' => $this->adminModel->getColumnNames(),
            'records' => $this->adminModel->findAll(),
            'title' => 'admin'
        ];
    }

    public function index()
    {
        $order = $this->request->getGet('order') ?? 'desc';

        $data = $this->preparedData();
        $data['next_order'] = ($order === 'desc') ? 'asc' : 'desc';


        return view('pages/admin/data_admin', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();
        $data['admn'] = $this->adminModel->where('slug', $slug)->first();
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/admin/update'), $this->request, $data['admn']['id_admin']);

        if (empty($data['admn'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data admin ' . $slug . ' tidak ada!');
        }

        return view('pages/admin/data_admin', $data);
    }

    public function save($id)
    {
        // Validation Data
        $validation = service('validation');
        $validation->setRules([
            'username' => [
                'rules' => "required|is_unique[admin.username,id_admin,{$id}]",
                'errors' => [
                    'required' => 'Username admin wajib diisi!',
                    'is_unique' => 'Username admin tersebut telah terdaftar!'
                ]
            ],
            'email' => [
                'rules' => "required|valid_email|is_unique[admin.email,id_admin,{$id}]",
                'errors' => [
                    'required' => 'Email harus diisi.',
                    'valid_email' => 'Email yang dimasukkan tidak valid.',
                    'is_unique' => 'Email tersebut telah terdaftar.'
                ]
            ],
            'status' => [
                'rules' => 'required|in_list[aktif,non-aktif]',
                'errors' => [
                    'required' => 'Status harus diisi.',
                    'in_list' => 'Status harus diisi dengan salah satu dari "aktif" atau "non-aktif".'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();

            $data['oldEditData'] = $this->request->getPost();
            $data['ModalEditActive'] = true;
            $data['urlToEditForm'] = build_query_url(site_url('/admin/update'), $this->request, $id);
            $data['admn'] = $this->adminModel->where('id_admin', $id)->first();

            return view('pages/admin/data_admin', $data);
        }

        // Data Action
        $adminData = [
            'slug' => url_title($this->request->getPost('username'), "-", true),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'status' => $this->request->getPost('status')
        ];

        $isSaved = $this->adminModel->update($id, $adminData);

         // Update session data if current admin updates his/her data
        $adminId = session()->get('adminId');
        if ($adminId) {
            if ($id === $adminId) {
                session()->set([
                    'usernameAdmin' => $adminData['username'],
                    'emailAdmin' => $adminData['email'],
                ]);
            }
        }

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data admin berhasil diedit!'
                : 'Data admin GAGAL diedit!'
        );

        $url = build_query_url(site_url('/admin'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        if (!$this->adminModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        if ($this->adminModel->delete($id)) {
            session()->setFlashdata('success', 'Data admin berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data admin GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/admin'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}
