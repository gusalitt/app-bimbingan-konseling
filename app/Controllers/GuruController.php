<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\guruModel;

class GuruController extends BaseController
{
    protected $guruModel;

    public function __construct()
    {
        $this->guruModel = new guruModel();
        // $this->jurusanModel = new jurusanModel();
    }

    private function buildEditGuruUrls(): array
    {
        $guru = $this->guruModel->select('id_guru, slug')->findAll();
        $urlsToEditGuru = [];

        foreach ($guru as $gru) {
            $url = build_query_url(site_url('/guru/edit'), $this->request, $gru['slug']);
            $urlsToEditGuru[$gru['id_guru']] = $url;
        }

        return $urlsToEditGuru;
    }

    private function setPaginationSession(int $currentPage, int $totalPages): void
    {
        $nextPage = intval($currentPage);
        $previousPage = intval($currentPage);

        //  Logic btn Next & Previous at the Pagination.
        if ($nextPage < $totalPages) ++$nextPage;
        if ($previousPage > 1) --$previousPage;

        session()->set('nextPageGuru', $nextPage);
        session()->set('previousPageGuru', $previousPage);
    }

    private function redirectToValidPage(string $queryParam): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to(build_query_url(site_url('/guru'), $this->request, null, [$queryParam]));
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $kategori_mapel = $this->request->getGet('kategori_mapel') ?? '';
        $show = intval($this->request->getGet('show') ?? 10);
        $sort = $this->request->getGet('sort') ?? 'terbaru';
        $page = intval($this->request->getGet('page') ?? 1);

        $filteredData = $this->guruModel->getFilteredData(
            $keyword,
            $kategori_mapel,
            ($show == 0 ? 10 : $show),
            $sort,
            ($page == 0 ? 1 : $page)
        );

        $totalData = $filteredData['totalData'];
        $totalPages = $filteredData['totalPages'];

        // Validate the number of rows displayed.
        if ($show !== 10) {
            if ($show < 0 || $show > $totalData || !is_numeric($show)) {
                return $this->redirectToValidPage('show');
            }
        }

        // Next & Previous button logic in Pagination.
        $this->setPaginationSession($page, $totalPages);

        // Validate in Pagination.
        if ($page != 1) {
            if ($page < 0 || $page > $totalPages || !is_numeric($page)) {
                return $this->redirectToValidPage('page');
            }
        }

        return [
            'guru' => $filteredData['query'],
            'itemStart' => $filteredData['itemStart'],
            'pager' => $this->guruModel->pager,
            'totalGuru' => $totalData,
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'mapel' => $this->guruModel->getMataPelajaran(),
            'kategori_mapel' => $kategori_mapel,
            'show' => $show,
            'sort' => $sort,
            'urlsToEditGuru' => $this->buildEditGuruUrls(),
            'urlToAddForm' => build_query_url(site_url('/guru/add'), $this->request),

            // To Print Data
            'columnNames' => $this->guruModel->getColumnNames(),
            'records' => $this->guruModel->findAll(),
            'title' => 'guru',
        ];
    }

    public function index()
    {

        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        return view('pages/guru/data_guru', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        $data['gru'] = $this->guruModel->where('slug', $slug)->first();
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/guru/update'), $this->request, $data['gru']['id_guru']);

        if (empty($data['gru'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data guru ' . $slug . ' tidak ada!');
        }

        return view('pages/guru/data_guru', $data);
    }

    public function fotoUpload($oldFoto = "-")
    {
        $imageFile = $this->request->getFile('fotoGuru');

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move('uploads/img_guru/', $newName);

            if (($oldFoto !== "-" && $oldFoto !== null) && file_exists('uploads/img_guru/' . $oldFoto)) {
                unlink('uploads/img_guru/' . $oldFoto);
            }

            return $newName;
        }

        return $oldFoto;
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $uniqueGuru = 'is_unique[guru.nama_guru' . ($id ? ',id_guru,' . $id : '') . ']';

        // Validation Data
        $validation = service('validation');
        $validation->setRules([
            'fotoGuru' => [
                'rules' => 'is_image[fotoGuru]|max_size[fotoGuru,1024]|mime_in[fotoGuru,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1 MB.',
                    'mime_in'  => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, atau PNG.',
                ]
            ],
            'namaGuru' => [
                'rules' => 'required|' . $uniqueGuru,
                'errors' => [
                    'required' => 'Nama guru wajib diisi!',
                    'is_unique' => 'Nama guru tersebut telah terdaftar!'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();
            if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
                return $data;
            }

            session()->setFlashdata('modalType', $isUpdate ? 'edit' : 'add');

            $data[$isUpdate ? 'oldEditData' : 'oldAddData'] = $this->request->getPost();
            $data[$isUpdate ? 'ModalEditActive' : 'ModalAddActive'] = true;
            $data['urlToAddForm'] = build_query_url(site_url('/guru/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/guru/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['gru'] = $this->guruModel->where('id_guru', $id)->first();
            }

            return view('pages/guru/data_guru', $data);
        }

        // Data Action
        $guruData = [
            'slug' => url_title($this->request->getPost('namaGuru'), "-", true),
            'foto' => ($isUpdate ? $this->fotoUpload($this->guruModel->find($id)['foto']) : $this->fotoUpload()),
            'nama_guru' => $this->request->getPost('namaGuru'),
            'mata_pelajaran' => $this->request->getPost('mapel') ?: '-',
            'wali_kelas' => $this->request->getPost('waliKelas') ?: '-'
        ];

        $isSaved = $isUpdate
            ? $this->guruModel->update($id, $guruData)
            : $this->guruModel->save($guruData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data guru berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Data guru GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/guru'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        $guru = $this->guruModel->find($id);
        if (!$guru) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $fotoPath = 'uploads/img_guru/' . $guru['foto'];

        if ($this->guruModel->delete($id)) {
            if ($guru['foto'] && file_exists($fotoPath)) {
                unlink($fotoPath);
            }

            session()->setFlashdata('success', 'Data Guru berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data Guru GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/guru'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}
