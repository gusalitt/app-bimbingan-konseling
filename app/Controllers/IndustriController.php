<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\industriModel;
use App\Models\siswaModel;

class IndustriController extends BaseController
{
    protected $industriModel;
    protected $siswaModel;

    public function __construct()
    {
        $this->industriModel = new industriModel();
        $this->siswaModel = new siswaModel();
    }

    private function buildEditIndustriUrls(): array
    {
        $industri = $this->industriModel->select('id_industri, slug')->findAll();
        $urlsToEditIndustri = [];

        foreach ($industri as $indstr) {
            $url = build_query_url(site_url('/industri/edit'), $this->request, $indstr['slug']);
            $urlsToEditIndustri[$indstr['id_industri']] = $url;
        }

        return $urlsToEditIndustri;
    }

    private function setPaginationSession(int $currentPage, int $totalPages): void
    {
        $nextPage = intval($currentPage);
        $previousPage = intval($currentPage);

        //  Logic btn Next & Previous at the Pagination.
        if ($nextPage < $totalPages) ++$nextPage;
        if ($previousPage > 1) --$previousPage;

        session()->set('nextPageIndustri', $nextPage);
        session()->set('previousPageIndustri', $previousPage);
    }

    private function redirectToValidPage(string $queryParam): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to(build_query_url(site_url('/industri'), $this->request, null, [$queryParam]));
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $kategori_status = $this->request->getGet('kategoriStatus') ?? '';
        $show = intval($this->request->getGet('show') ?? 10);
        $sort = $this->request->getGet('sort') ?? 'terbaru';
        $page = intval($this->request->getGet('page') ?? 1);

        $filteredData = $this->industriModel->getFilteredData(
                            $keyword,
                            $kategori_status,
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
            'industri' => $filteredData['query'],
            'itemStart' => $filteredData['itemStart'],
            'pager' => $this->industriModel->pager,
            'totalIndustri' => $totalData,
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'kategori_status' => $kategori_status,
            'show' => $show,
            'sort' => $sort,
            'urlsToEditIndustri' => $this->buildEditindustriUrls(),
            'urlToAddForm' => build_query_url(site_url('/industri/add'), $this->request),

            // To Print Data
            'columnNames' => $this->industriModel->getColumnNames(),
            'records' => $this->industriModel->getFilteredData(null, null, null, null, null, true)['query']->get()->getResultArray(),
            'title' => 'industri',

            'siswaList' => $this->siswaModel
                ->select('id_siswa, nama_siswa, kelas, jurusan')
                ->orderBy('kelas', 'ASC')
                ->orderBy('jurusan', 'ASC')
                ->findAll(),
        ];
    }

    public function index()
    {
        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        return view('pages/industri/data_industri', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        $data['indstr'] = $this->industriModel->getDataByIdentifier('slug', $slug);
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/industri/update'), $this->request, $data['indstr']['id_industri']);

        if (empty($data['indstr'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data industri ' . $slug . ' tidak ada!');
        }

        return view('pages/industri/data_industri', $data);
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $siswa_id = intval($this->request->getPost('siswa_id'));
        $namaSiswa = trim(explode('(', $this->request->getPost('namaSiswa'))[0]);

        // Validation Data
        $validation = service('validation');
        $validation->setRules([
            'namaSiswa' => [
                'rules' => "required|findStudentByName[{$namaSiswa}]",
                'errors' => [
                    'required' => 'Nama siswa wajib diisi!',
                    'findStudentByName' => 'Nama siswa tersebut tidak ditemukan dalam data siswa!'
                ]
            ],
            'siswa_id' => [
                'rules' => "required|isStudentIdAndNameValid[{$siswa_id}{$namaSiswa}]",
                'errors' => [
                    'required' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                    'isStudentIdAndNameValid' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                ]
            ],
            'tempat_industri' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat industri wajib diisi!',
                ]
            ],
            'tgl_mulai' => [
                'rules' => 'required|valid_date',
                'errors' => [
                    'required' => 'Tanggal mulai wajib diisi!',
                    'valid_date' => 'Harap masukkan tanggal yang valid.',
                ]
            ],
            'tgl_selesai' => [
                'rules' => "required|valid_date",
                'errors' => [
                    'required' => 'Tanggal selesai wajib diisi!',
                    'valid_date' => 'Harap masukkan tanggal yang valid.',
                ]
            ],
            'status' => [
                'rules' => 'required|in_list[aktif,non-aktif]',
                'errors' => [
                    'required' => 'Status wajib diisi!',
                    'in_list' => 'Status harus berisi salah satu dari: {param} ',
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
            $data['urlToAddForm'] = build_query_url(site_url('/industri/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/industri/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['indstr'] = $this->industriModel->getDataByIdentifier('id_industri', $id);
            }

            return view('pages/industri/data_industri', $data);
        }

        // Data Action
        $industriData = [
            'slug' => $isUpdate
                ?  $this->industriModel->updateSlug($namaSiswa, $this->request->getPost('oldSlug'))
                : $this->industriModel->generatedUniqueSlug($namaSiswa),
            'id_siswa' => $siswa_id,
            'tempat_industri' =>  $this->request->getPost('tempat_industri'),
            'tgl_mulai' => $this->request->getPost('tgl_mulai'),
            'tgl_selesai' => $this->request->getPost('tgl_selesai'),
            'status' => $this->request->getPost('status'),
        ];

        $isSaved = $isUpdate
            ? $this->industriModel->update($id, $industriData)
            : $this->industriModel->save($industriData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data industri berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Data industri GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/industri'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        if (!$this->industriModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        if ($this->industriModel->delete($id)) {
            session()->setFlashdata('success', 'Data industri berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data industri GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/industri'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}
