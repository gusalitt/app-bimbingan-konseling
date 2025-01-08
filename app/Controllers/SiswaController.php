<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\siswaModel;
use App\Models\jurusanModel;

use function PHPUnit\Framework\fileExists;

class SiswaController extends BaseController
{
    protected $siswaModel;
    protected $jurusanModel;

    public function __construct()
    {
        $this->siswaModel = new siswaModel();
        $this->jurusanModel = new jurusanModel();
    }

    private function buildEditSiswaUrls(): array
    {
        $siswa = $this->siswaModel->select('id_siswa, slug')->findAll();
        $urlsToEditSiswa = [];

        foreach ($siswa as $ssw) {
            $url = build_query_url(site_url('/siswa/edit'), $this->request, $ssw['slug']);
            $urlsToEditSiswa[$ssw['id_siswa']] = $url;
        }

        return $urlsToEditSiswa;
    }

    private function setPaginationSession(int $currentPage, int $totalPages): void
    {
        $nextPage = intval($currentPage);
        $previousPage = intval($currentPage);

        //  Logic btn Next & Previous at the Pagination.
        if ($nextPage < $totalPages) ++$nextPage;
        if ($previousPage > 1) --$previousPage;

        session()->set('nextPageSiswa', $nextPage);
        session()->set('previousPageSiswa', $previousPage);
    }

    private function redirectToValidPage(string $queryParam): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to(build_query_url(site_url('/siswa'), $this->request, null, [$queryParam]));
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $kategori_jurusan = $this->request->getGet('kategori_jurusan') ?? '';
        $show = intval($this->request->getGet('show') ?? 10);
        $sort = $this->request->getGet('sort') ?? 'terbaru';
        $page = intval($this->request->getGet('page') ?? 1);

        $filteredData = $this->siswaModel->getFilteredData(
            $keyword,
            $kategori_jurusan,
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
            'siswa' => $filteredData['query'],
            'itemStart' => $filteredData['itemStart'],
            'pager' => $this->siswaModel->pager,
            'totalSiswa' => $totalData,
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'kategori_jurusan' => $kategori_jurusan,
            'show' => $show,
            'sort' => $sort,
            'urlsToEditSiswa' => $this->buildEditSiswaUrls(),
            'urlToAddForm' => build_query_url(site_url('/siswa/add'), $this->request),

            // To Print Data
            'columnNames' => $this->siswaModel->getColumnNames(),
            'records' => $this->siswaModel->findAll(),
            'title' => 'siswa',

            'jurusan' => $this->jurusanModel->select('nama_jurusan')->findAll(),
        ];
    }

    public function index()
    {

        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        return view('pages/siswa/data_siswa', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        $data['ssw'] = $this->siswaModel->where('slug', $slug)->first();
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/siswa/update'), $this->request, $data['ssw']['id_siswa']);

        if (empty($data['ssw'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa ' . $slug . ' tidak ada!');
        }

        return view('pages/siswa/data_siswa', $data);
    }

    public function fotoUpload($oldFoto = "-")
    {
        $imageFile = $this->request->getFile('fotoSiswa');

        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move('uploads/img_siswa/', $newName);

            if (($oldFoto !== "-" && $oldFoto !== null) && file_exists('uploads/img_siswa/' . $oldFoto)) {
                unlink('uploads/img_siswa/' . $oldFoto);
            }

            return $newName;
        }

        return $oldFoto;
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $uniqueSiswa = 'is_unique[siswa.nama_siswa' . ($id ? ',id_siswa,' . $id : '') . ']';
        $uniqueNisn = 'is_unique[siswa.nisn' . ($id ? ',id_siswa,' . $id : '') . ']';

        // Validation Data
        $validation = service('validation');
        $validation->setRules([
            'fotoSiswa' => [
                'rules' => 'is_image[fotoSiswa]|max_size[fotoSiswa,1024]|mime_in[fotoSiswa,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'File yang diunggah harus berupa gambar.',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1 MB.',
                    'mime_in'  => 'File yang diunggah harus berupa gambar dengan format JPG, JPEG, atau PNG.',
                ]
            ],
            'namaSiswa' => [
                'rules' => 'required|' . $uniqueSiswa,
                'errors' => [
                    'required' => 'Nama siswa wajib diisi!',
                    'is_unique' => 'Nama siswa tersebut telah terdaftar!'
                ]
            ],
            'nisn' => [
                'rules' => 'required|' . $uniqueNisn,
                'errors' => [
                    'required' => 'NISN wajib diisi!',
                    'is_unique' => 'NISN tersebut telah terdaftar!'
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kelas wajib diisi!',
                ]
            ],
            'jurusan' => [
                'rules' => 'required|findMajorByName[' . $this->request->getPost('jurusan') . ']',
                'errors' => [
                    'required' => 'Jurusan wajib diisi!',
                    'findMajorByName' => 'Jurusan tidak ditemukan. Silakan tambahkan jurusan terlebih dahulu'
                ]
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();
            if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
                return $data;
            }

            session()->setFlashdata('modalType', $isUpdate ? 'edit' : 'add');

            $data[$isUpdate ? 'oldEditData' : 'oldAddData'] = $this->request->getPost();
            $data[$isUpdate ? 'ModalEditActive' : 'ModalAddActive'] = true;
            $data['urlToAddForm'] = build_query_url(site_url('/siswa/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/siswa/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['ssw'] = $this->siswaModel->where('id_siswa', $id)->first();
            }

            return view('pages/siswa/data_siswa', $data);
        }

        // Data Action
        $siswaData = [
            'slug' => url_title($this->request->getPost('namaSiswa'), "-", true),
            'foto' => ($isUpdate ? $this->fotoUpload($this->siswaModel->find($id)['foto']) : $this->fotoUpload()),
            'nama_siswa' => $this->request->getPost('namaSiswa'),
            'nisn' => $this->request->getPost('nisn'),
            'kelas' => $this->request->getPost('kelas'),
            'jurusan' => $this->request->getPost('jurusan'),
        ];

        $isSaved = $isUpdate
            ? $this->siswaModel->update($id, $siswaData)
            : $this->siswaModel->save($siswaData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data siswa berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Data siswa GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/siswa'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        $siswa = $this->siswaModel->find($id);
        if (!$siswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $fotoPath = 'uploads/img_siswa/' . $siswa['foto'];

        if ($this->siswaModel->delete($id)) {
            if ($siswa['foto'] && file_exists($fotoPath)) {
                unlink($fotoPath);
            }

            session()->setFlashdata('success', 'Data siswa berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data siswa GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/siswa'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}
