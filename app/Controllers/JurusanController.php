<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\jurusanModel;


class JurusanController extends BaseController
{
    protected $jurusanModel;

    public function __construct()
    {
        $this->jurusanModel = new jurusanModel();
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $sort = $this->request->getGet('sort') ?? 'id_jurusan';
        $order = $this->request->getGet('order') ?? 'desc';

        // Build query URL.
        $jurusan = $this->jurusanModel->select('id_jurusan, slug')->findAll();
        $urls = [];

        foreach ($jurusan as $jrsn) {
            $url = build_query_url(site_url('/jurusan/edit'), $this->request, $jrsn['slug']);
            $urls[$jrsn['id_jurusan']] = $url;
        }
        
        $jurusan = $this->jurusanModel->getFilteredData($keyword, $sort, $order);

        return [
            'jurusan' => $jurusan,
            'totalJurusan' => count($jurusan),
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'urls' => $urls,
            'urlToAddForm' => build_query_url(site_url('/jurusan/add'), $this->request),

            // To Print Data
            'columnNames' => $this->jurusanModel->getColumnNames(),
            'records' => $this->jurusanModel->findAll(),
            'title' => 'jurusan'
        ];
    }

    public function index()
    {
        $order = $this->request->getGet('order') ?? 'desc';

        $data = $this->preparedData();
        $data['next_order'] = ($order === 'desc') ? 'asc' : 'desc';


        return view('pages/jurusan/data_jurusan', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();
        $data['jrsn'] = $this->jurusanModel->where('slug', $slug)->first();
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/jurusan/update'), $this->request, $data['jrsn']['id_jurusan']);

        if (empty($data['jrsn'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Jurusan ' . $slug . ' tidak ada!');
        }

        return view('pages/jurusan/data_jurusan', $data);
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $uniqueJurusan = 'is_unique[jurusan.nama_jurusan' . ($id ? ',id_jurusan,' . $id : '') . ']';

        // Validation Data
        $validation = service('validation');
        $validation->setRules([
            'jurusan' => [
                'rules' => 'required|' . $uniqueJurusan,
                'errors' => [
                    'required' => 'Jurusan wajib diisi!',
                    'is_unique' => 'Jurusan tersebut telah terdaftar!'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();

            session()->setFlashdata('modalType', $isUpdate ? 'edit' : 'add');

            $data[$isUpdate ? 'oldEditData' : 'oldAddData'] = $this->request->getPost();
            $data[$isUpdate ? 'ModalEditActive' : 'ModalAddActive'] = true;
            $data['urlToAddForm'] = build_query_url(site_url('/jurusan/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/jurusan/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['jrsn'] = $this->jurusanModel->where('id_jurusan', $id)->first();
            }

            return view('pages/jurusan/data_jurusan', $data);
        }

        // Data Action
        $jurusanrData = [
            'slug' => url_title($this->request->getPost('jurusan'), "-", true),
            'kelas' => $this->request->getPost('kelas'),
            'nama_jurusan' => $this->request->getPost('jurusan'),
            'deskripsi' => $this->request->getPost('deskripsi') ?: '-',
        ];

        $isSaved = $isUpdate
            ? $this->jurusanModel->update($id, $jurusanrData)
            : $this->jurusanModel->save($jurusanrData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data jurusan berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Data jurusan GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/jurusan'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        if (!$this->jurusanModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        if ($this->jurusanModel->delete($id)) {
            session()->setFlashdata('success', 'Data Jurusan berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data Jurusan GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/jurusan'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}
