<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\konselingModel;
use App\Models\siswaModel;
use App\Models\konselorModel;
use DateTime;

class KonselingController extends BaseController
{
    protected $konselingModel;
    protected $siswaModel;
    protected $konselorModel;

    public function __construct()
    {
        $this->konselingModel = new konselingModel();
        $this->siswaModel = new siswaModel();
        $this->konselorModel = new konselorModel();
    }

    private function buildEditKonselingUrls(): array
    {
        $konseling = $this->konselingModel->select('id_konseling, slug')->findAll();
        $urlsToEditKonseling = [];

        foreach ($konseling as $knslng) {
            $url = build_query_url(site_url('/konseling/edit'), $this->request, $knslng['slug']);
            $urlsToEditKonseling[$knslng['id_konseling']] = $url;
        }

        return $urlsToEditKonseling;
    }

    private function setPaginationSession(int $currentPage, int $totalPages): void
    {
        $nextPage = intval($currentPage);
        $previousPage = intval($currentPage);

        //  Logic btn Next & Previous at the Pagination.
        if ($nextPage < $totalPages) ++$nextPage;
        if ($previousPage > 1) --$previousPage;

        session()->set('nextPageKonseling', $nextPage);
        session()->set('previousPageKonseling', $previousPage);
    }

    private function redirectToValidPage(string $queryParam): \CodeIgniter\HTTP\RedirectResponse
    {
        return redirect()->to(build_query_url(site_url('/konseling'), $this->request, null, [$queryParam]));
    }

    public function preparedData()
    {
        $keyword = $this->request->getGet('key');
        $kategori_status = $this->request->getGet('kategoriStatus') ?? '';
        $show = intval($this->request->getGet('show') ?? 10);
        $sort = $this->request->getGet('sort') ?? 'terbaru';
        $page = intval($this->request->getGet('page') ?? 1);

        $filteredData = $this->konselingModel->getFilteredData(
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
            'konseling' => $filteredData['query'],
            'itemStart' => $filteredData['itemStart'],
            'pager' => $this->konselingModel->pager,
            'totalKonseling' => $totalData,
            'validation' => \Config\Services::validation(),
            'keyword' => $keyword,
            'kategori_status' => $kategori_status,
            'show' => $show,
            'sort' => $sort,
            'urlsToEditKonseling' => $this->buildEditKonselingUrls(),
            'urlToAddForm' => build_query_url(site_url('/konseling/add'), $this->request),

            // To Print Data
            'columnNames' => $this->konselingModel->getColumnNames(),
            'records' => $this->konselingModel->getFilteredData(null, null, null, null, null, true)['query']->get()->getResultArray(),
            'title' => 'konseling',

            // For autocomplete input in form add & edit.
            'siswaList' => $this->siswaModel
                ->select('id_siswa, nama_siswa, kelas, jurusan')
                ->orderBy('kelas', 'ASC')
                ->orderBy('jurusan', 'ASC')
                ->findAll(),
            'konselorList' => $this->konselorModel
                ->select('id_konselor, nama_konselor')
                ->orderBy('nama_konselor', 'ASC')
                ->findAll(),
        ];
    }

    public function index()
    {

        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        return view('pages/konseling/data_konseling', $data);
    }

    public function edit($slug)
    {
        $data = $this->preparedData();

        if ($data instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $data;
        }

        $data['knslng'] = $this->konselingModel->getDataByIdentifier('k.slug', $slug);
        $data['ModalEditActive'] = true;
        $data['urlToEditForm'] = build_query_url(site_url('/konseling/update'), $this->request, $data['knslng']['id_konseling']);

        if (empty($data['knslng'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data siswa ' . $slug . ' tidak ada!');
        }

        return view('pages/konseling/data_konseling', $data);
    }

    public function save($id = null)
    {
        $isUpdate = $id !== null;
        $siswa_id = intval($this->request->getPost('siswa_id'));
        $namaSiswa = trim(explode('(', $this->request->getPost('namaSiswa'))[0]);
        $namaKonselor = $this->request->getPost('namaKonselor');
        $konselor_id = intval($this->request->getPost('konselor_id'));
        $tanggal = $this->request->getPost('tanggal');

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
                    'isStudentIdAndNameValid' => 'Upss sepertinya ada kesalahan! Mohon coba lagi..',
                ]
            ],
            'namaKonselor' => [
                'rules' => "required|findKonselorByName[{$namaKonselor}]",
                'errors' => [
                    'required' => 'Nama konselor wajib diisi!',
                    'findKonselorByName' => 'Nama konselor tersebut tidak ditemukan dalam data konselor!'
                ]
            ],
            'konselor_id' => [
                'rules' => "required|isKonselorIdAndNameValid[{$konselor_id}{$namaKonselor}]",
                'errors' => [
                    'required' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                    'isKonselorIdAndNameValid' => 'Upss sepertinya ada kesalahan! Mohon coba lagi...',
                ]
            ],
            'tanggal' => [
                'rules' => "required|valid_date",
                'errors' => [
                    'required' => 'Tanggal konseling wajib diisi!',
                    'valid_date' => 'Harap masukkan tanggal yang valid.',
                ]
            ],
            'status' => [
                'rules' => 'required|in_list[Dijadwalkan,Selesai,Dibatalkan]',
                'errors' => [
                    'required' => 'Status wajib diisi!',
                    'in_list' => 'Status harus berisi salah satu dari: {param} ',
                ]
            ],

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            $data = $this->preparedData();

            session()->setFlashdata('modalType', $isUpdate ? 'edit' : 'add');

            $data[$isUpdate ? 'oldEditData' : 'oldAddData'] = $this->request->getPost();
            $data[$isUpdate ? 'ModalEditActive' : 'ModalAddActive'] = true;
            $data['urlToAddForm'] = build_query_url(site_url('/konseling/add'), $this->request);
            $data['urlToEditForm'] = build_query_url(site_url('/konseling/update'), $this->request, $isUpdate ? $id : null);

            if ($isUpdate) {
                $data['knslng'] = $this->konselingModel->getDataByIdentifier('k.id_konseling', $id);
            }

            return view('pages/konseling/data_konseling', $data);
        }

        // Data Action
        $konselingData = [
            'slug' => $isUpdate
                ?  $this->konselingModel->updateSlug($namaSiswa, $this->request->getPost('oldSlug'))
                : $this->konselingModel->generatedUniqueSlug($namaSiswa),
            'id_siswa' => (int) $siswa_id,
            'id_konselor' => (int) $konselor_id,
            'tanggal' => $tanggal,
            'permasalahan' => $this->request->getPost('permasalahan') ?: '-',
            'tindakan' => $this->request->getPost('tindakan') ?: '-',
            'catatan' => $this->request->getPost('catatan') ?: '-',
            'status' => $this->request->getPost('status'),
        ];

        // Update total counseling on counselor data
        if ($isUpdate) {
            $old_id_konselor = (int) $this->konselingModel->find($id)['id_konselor'];

            if ($old_id_konselor !== $konselingData['id_konselor']) {
                $this->konselingModel->updateTotalKonseling($konselingData['id_konselor']);
            }
        } else {
            $this->konselingModel->updateTotalKonseling($konselingData['id_konselor']);
        }

        $isSaved = $isUpdate
            ? $this->konselingModel->update($id, $konselingData)
            : $this->konselingModel->save($konselingData);

        session()->setFlashdata(
            $isSaved ? 'success' : 'error',
            $isSaved
                ? 'Data konseling berhasil ' . ($isUpdate ? 'diedit!' : 'ditambah!')
                : 'Data konseling GAGAL ' . ($isUpdate ? 'diedit!' : 'ditambah')
        );

        $url = build_query_url(site_url('/konseling'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }

    public function delete($id)
    {
        if (!$this->konselingModel->find($id)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        if ($this->konselingModel->delete($id)) {
            session()->setFlashdata('success', 'Data konseling berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Data konseling GAGAL dihapus!');
        }

        $url = build_query_url(site_url('/konseling'), $this->request);
        return redirect()->to($url)->with('modalMessage', true);
    }
}
