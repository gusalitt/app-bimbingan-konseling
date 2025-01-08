<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\konselorModel;

class KonselorController extends BaseController
{
    protected $konselorModel;

    public function __construct()
    {
        $this->konselorModel = new konselorModel();
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $sort = $this->request->getGet('sort') ?? 'id_konselor';
        $order = $this->request->getGet('order') ?? 'desc';

        // Build query URL.
        $konselor = $this->konselorModel->select('id_konselor, slug')->findAll();
        $urls = [];

        foreach ($konselor as $kslr) {
            $url = build_query_url(site_url('/konselor/edit'), $this->request, $kslr['slug']);
            $urls[$kslr['id_konselor']] = $url;
        }
        
        $konselor = $this->konselorModel->getFilteredData($keyword, $sort, $order);

        return [
            'konselor' => $konselor,
            'totalKonselor' => count($konselor),
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'urls' => $urls,
            'urlToAddForm' => build_query_url(site_url('/konselor/add'), $this->request),

            // To Print Data
            'columnNames' => $this->konselorModel->getColumnNames(),
            'records' => $this->konselorModel->findAll(),
            'title' => 'konselor'
        ];
    }

    public function index()
    {
        $order = $this->request->getGet('order') ?? 'desc';

        $data = $this->preparedData();
        $data['next_order'] = ($order === 'desc') ? 'asc' : 'desc';


        return view('pages/konselor/data_konselor', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();
        $data['kslr'] = $this->konselorModel->where('slug', $slug)->first();
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/konselor/update'), $this->request, $data['kslr']['id_konselor']);

        if (empty($data['kslr'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data konselor ' . $slug . ' tidak ada!');
        }

        return view('pages/konselor/data_konselor', $data);
    }

    public function fotoUpload($oldFoto = "-")
    {
        $imageFile = $this->request->getFile('fotoKonselor');

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move('uploads/img_konselor/', $newName);

            if (($oldFoto !== "-" && $oldFoto !== null) && file_exists('uploads/img_konselor/' . $oldFoto)) {
                unlink('uploads/img_konselor/' . $oldFoto);
            }

            return $newName;
        }

        return $oldFoto;
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $uniqueNama = 'is_unique[konselor.nama_konselor' . ($id ? ',id_konselor,' . $id : '') . ']';
        $uniqueNoTelp = 'is_unique[konselor.no_telp' . ($id ? ',id_konselor,' . $id : '') . ']';

        // Validation Data
        $validation = service('validation');
        $validation->setRules([
            'fotoKonselor' => [
                'rules' => 'is_image[fotoKonselor]|max_size[fotoKonselor,1024]|mime_in[fotoKonselor,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1 MB.',
                    'mime_in'  => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, atau PNG.',
                ]
            ],
            'namaKonselor' => [
                'rules' => 'required|' . $uniqueNama,
                'errors' => [
                    'required' => 'Nama konselor wajib diisi!',
                    'is_unique' => 'Nama konselor tersebut telah terdaftar!'
                ]
            ],
            'noTelp' => [
                'rules' => 'required|' . $uniqueNoTelp,
                'errors' => [
                    'required' => 'No telp wajib diisi!',
                    'is_unique' => 'No telp tersebut telah terdaftar!'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();

            session()->setFlashdata('modalType', $isUpdate ? 'edit' : 'add');

            $data[$isUpdate ? 'oldEditData' : 'oldAddData'] = $this->request->getPost();
            $data[$isUpdate ? 'ModalEditActive' : 'ModalAddActive'] = true;
            $data['urlToAddForm'] = build_query_url(site_url('/konselor/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/konselor/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['kslr'] = $this->konselorModel->where('id_konselor', $id)->first();
            }

            return view('pages/konselor/data_konselor', $data);
        }

        // Data Action
        $konselorData = [
            'slug' => url_title($this->request->getPost('namaKonselor'), "-", true),
            'foto' => ($isUpdate ? $this->fotoUpload($this->konselorModel->find($id)['foto']) : $this->fotoUpload()),
            'nama_konselor' => $this->request->getPost('namaKonselor'),
            'no_telp' => $this->request->getPost('noTelp'),
        ];

        $isSaved = $isUpdate
            ? $this->konselorModel->update($id, $konselorData)
            : $this->konselorModel->save($konselorData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data konselor berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Data konselor GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/konselor'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        $konselor = $this->konselorModel->find($id);
        if (!$konselor) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $fotoPath = 'uploads/img_konselor/' . $konselor['foto'];

        if ($this->konselorModel->delete($id)) {
            if ($konselor['foto'] && file_exists($fotoPath)) {
                unlink($fotoPath);
            }

            session()->setFlashdata('success', 'Data Konselor berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data Konselor GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/konselor'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}
